<?php
  class Admin_querys extends CI_Model{
    public function extractLength($table){ //Funcion para obtener cuantos registros existen una tabla.
      $this->db->select($table.'_id');
      $this->db->from($table);
      $query = $this->db->get();
      foreach($query->result_array() as $lenght){}
      return $lenght;
    }
    
    public function extractInfo($maxId, $table){ //Funcion para obtener la informacion de cada registro de una tabla.
      $iaLength = 0; //InfoArray Length, para que solo se almacenen los que tienen resultado.
      $infoArray=[[]];
      for($i=0;$i<$maxId[$table.'_id'];$i++){  
        $this->db->select('*');
        $this->db->from($table);
        $n = $i+1;
        $this->db->where($table."_id = ".$n);
        $query = $this->db->get();
        if($query->num_rows()==1){
          foreach($query->result_array() as $infoArray[$iaLength]){};
          $iaLength++;
        }
      }   
      return $infoArray;   
    }
    
    //------------------------------------------Funciones para cargar usuarios------------------------------------------//

    public function userCreation($data){ //Funcion para crear un usuario, llamada en Page.php con la el ajax enviado en adminSLogic.js
      $this->db->insert('user', $data);
    }
    
    public function userEdition($data){ //Funcion para editar un usuario, llamada en Page.php con la el ajax enviado en adminSLogic.js
      $this->db->where('user_id', $data['user_id']);
      $this->db->update('user', $data);
    }
    
    public function userDeleting($data){ //Funcion para eliminar un usuario, llamada en Page.php con la el ajax enviado en adminSLogic.js
      $query="UPDATE user 
          SET status = 'Inactivo'
          WHERE username = '".$data['username']."';";
      $this->db->query($query);

    }
    
    //------------------------------------------Funciones para cargar clientes------------------------------------------//
    
    public function clientCreation($data){ //Funcion para crear un cliente, llamada en Page.php con la el ajax enviado en adminSLogic.js
      
      //Se usa el query largo, en lugar del simplificado, para poder hacer uso del array enviado en el ajax para guardar tambien los productos.
      $query = "INSERT INTO client(client_name, client_direction, client_telph, client_email) 
                VALUES ('".$data['client_name']."', '".$data['client_direction']."', '".$data['client_telph']."', '".$data['client_email']."');";
      $this->db->query($query);
      
      //Luego, se obtiene el id del cliente que se acaba de crear.
      $this->db->select('client_id');
      $this->db->from('client');
      $this->db->where('client_name', $data['client_name']);
      $result = $this->db->get();
      $newClientID = $result->row();
      
      //Para finalmente guardar en la base de datos todos los productos seleccionados
      foreach ($data['client_product'] as $productID) {
        $queryProduct = "INSERT INTO product_client(client_id, product_id) VALUES ('".$newClientID->client_id."', '".$productID."');";
        $this->db->query($queryProduct);
      }

    }
    
    public function clientEdition($data){ //Funcion para editar un cliente, llamada en Page.php con la el ajax enviado en adminSLogic.js
      //Se usa el query largo, en lugar del simplificado, para poder hacer uso del array enviado en el ajax para guardar tambien los productos.
      $query="UPDATE client 
              SET client_name = '".$data['client_name']."', 
                  client_direction = '".$data['client_direction']."', 
                  client_telph = '".$data['client_telph']."', 
                  client_email = '".$data['client_email']."' 
              WHERE client_id = '".$data['client_id']."';";
      $this->db->query($query);
      
      //Y para guardar los nuevos productos Primero se borran todos los productos que respondan al id del cliente.
      $queryDeleteProduct ="DELETE FROM product_client WHERE client_id = '".$data['client_id']."';";
      $this->db->query($queryDeleteProduct);
      
      //Para luego agregar los nuevos.
      foreach ($data['client_product'] as $productID) {        
        $queryProduct = "INSERT INTO product_client(client_id, product_id) VALUES ('".$data['client_id']."', '".$productID."');";
        $this->db->query($queryProduct);
      }
      
    }
    
    public function clientDeleting($data){ //Funcion para editar un cliente, llamada en Page.php con la el ajax enviado en adminSLogic.js
      //Se obtiene el ID del cliente que se desea eliminar
      $this->db->select('client_id');
      $this->db->from('client');
      $this->db->where('client_name', $data['client_name']);
      $result = $this->db->get();
      $client_id = $result->row();
      
      //Se borra el cliente
      $this->db->where('client_id', $client_id->client_id);
      $this->db->delete('client', $data);
      
      //Y todos los productos que tenia ofrecidos
      $queryDeleteProduct ="DELETE FROM product_client WHERE client_id = '".$client_id->client_id."';";
      $this->db->query($queryDeleteProduct);
    }
    
    //------------------------------------------Funciones para cargar Productos------------------------------------------//
    
    public function productCreation($data){ //Funcion para crear un producto, llamada en Page.php con la el ajax enviado en adminSLogic.js
      $this->db->insert('product', $data);
    }
    
    public function productEdition($data){ //Funcion para editar un producto, llamada en Page.php con la el ajax enviado en adminSLogic.js
      $this->db->where('product_id', $data['product_id']);
      $this->db->update('product', $data);
    }
    
    public function productDeleting($data){ //Funcion para editar un producto, llamada en Page.php con la el ajax enviado en adminSLogic.js
      //Se obtiene el ID del producto que se desea eliminar
      $this->db->select('product_id');
      $this->db->from('product');
      $this->db->where('product_name', $data['product_name']);
      $result = $this->db->get();
      $product_id = $result->row();
      
      //Se borra el producto
      $this->db->where('product_id', $product_id->product_id);
      $this->db->delete('product', $data);
      
      //Y todos los clientes que tenia ofrecidos
      $queryDeleteProduct ="DELETE FROM product_client WHERE product_id = '".$product_id->product_id."';";
      $this->db->query($queryDeleteProduct);
    }
    
    //------------------------------------------Funciones para cargar Ordenes------------------------------------------//
    
    //Funcion para obtener los productos enlazados con el cliente seleccionado en todos los modals de ordenes.
    public function takeAllProductForClient ($data){
      //Obtener el id de los productos por el id del cliente en la tabla product_client
      $infoArray = [[]];
      $i= 0;
      
      $this->db->select('product_id');
      $this->db->from('product_client');
      $this->db->where('client_id', $data['client_id']);
      $result = $this->db->get();
      
      foreach($result->result_array() as $product_id){
        //Con el id del producto, seleccionamos los datos del producto de la tabla product. Esto se repite tantos productos tenga.
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('product_id', $product_id['product_id']);
        $productResult = $this->db->get();
        foreach($productResult->result_array() as $infoArray[$i]){}
        $i++;
      };
      
      return $infoArray;
    }
    
    public function retrieveInfo($table, $select, $whereQuery1, $whereQuery2){
      $this->db->select($select);
      $this->db->from($table);
      $this->db->where($whereQuery1, $whereQuery2);
      $result = $this->db->get();
      
      return $result->result_array();
    }
    
    public function orderCreation($data){ //Funcion para crear una Orden, llamada en Page.php con la el ajax enviado en adminSLogic.js
      //Se usa el query largo, en lugar del simplificado, para poder hacer uso del array enviado en el ajax para guardar tambien los productos.
      $query = "INSERT INTO orderp(client_id, status) 
                VALUES ('".$data['client_id']."', '".$data['status']."');";
      $this->db->query($query);
      
      //Luego, se obtiene el id de la orden que se acaba de crear.
      $newOrderID = $this->db->insert_id();
      
      //Para finalmente guardar en la base de datos todos los productos seleccionados
      $i = 0;
      foreach ($data['product_order'] as $productID) {
        $queryProduct = "INSERT INTO product_order(orderp_id, product_id, quantity) 
                         VALUES ('".$newOrderID."', '".$productID."', '".$data['product_order_qty'][$i]."');";
        $this->db->query($queryProduct);
        $i++;
      }
    }
    
    public function orderEdition($data){ //Funcion para editar un producto, llamada en Page.php con la el ajax enviado en adminSLogic.js
      //Se usa el query largo, en lugar del simplificado, para poder hacer uso del array enviado en el ajax para guardar tambien los productos.
      $query="UPDATE orderp 
              SET client_id = '".$data['client_id']."', 
                  status = '".$data['status']."'
              WHERE orderp_id = '".$data['order_id']."';";
      $this->db->query($query);
      
      //Y para guardar los nuevos productos Primero se borran todos los productos que respondan al id de la orden en product_order.
      $queryDeleteProduct ="DELETE FROM product_order WHERE orderp_id = '".$data['order_id']."';";
      $this->db->query($queryDeleteProduct);
      
      //Para luego agregar los nuevos.
      $i = 0;
      foreach ($data['product_order'] as $productID) {        
        $queryProduct = "INSERT INTO product_order(orderp_id, product_id, quantity) 
                        VALUES ('".$data['order_id']."', '".$productID."', '".$data['product_order_qty'][$i]."');";
        $this->db->query($queryProduct);
        $i++;
      }
    }
    
    public function orderDeleting($data){ //Funcion para editar un producto, llamada en Page.php con la el ajax enviado en adminSLogic.js
      
      //Se borra la orden
      $query ="DELETE FROM orderp WHERE orderp_id = '".$data['order_id']."';";
      $this->db->query($query);
      
      //Y todos los productos que tenia ofrecidos
      $queryDeleteProduct ="DELETE FROM product_order WHERE orderp_id = '".$data['order_id']."';";
      $this->db->query($queryDeleteProduct);
    }
    
    public function orderComplete($data){ //Funcion para editar un producto, llamada en Page.php con la el ajax enviado en adminSLogic.js
      //Se usa el query largo, en lugar del simplificado, para poder hacer uso del array enviado en el ajax para guardar tambien los productos.
      $query="UPDATE orderp 
              SET status = '".$data['status']."'
              WHERE orderp_id = '".$data['order_id']."';";
      $this->db->query($query);
      
    }
    
    
   //--------------------------------------------------Funciones para Estadisticas-------------------------------------------------//
    
    public function orderNumbers(){//Funcion para obtener el numero de ordenes detallado
      $query="SELECT status, COUNT(*) FROM orderp GROUP BY status";
      $infoArray = $this->db->query($query);
      return $infoArray;
    }
    
    public function productNumbers(){//Function para obtener el numero de productos detallado
      $query="SELECT product_id, sum(quantity) as suma FROM product_order GROUP BY product_id";
      $infoArray=$this->db->query($query);
      return $infoArray;
    }
    
   //----------------------------------------------Funciones para la TIMELINE------------------------------------------------------//
    
    public function storeTimeLine($data){
      $query="INSERT INTO timeline (date, username, action, object_id)
              VALUES (CURRENT_TIMESTAMP(),
                      '".$data['username']."',
                      '".$data['action']."',
                      '".$data['object_id']."');";
      $this->db->query($query);
    }
    
    public function extractTimeline(){
      $query = "SELECT * FROM timeline ORDER BY date DESC";
      $infoArray = $this->db->query($query);
      return $infoArray;
    }
    
    public function updateOrderTimeline(){
      $query = "SELECT * FROM orderp";
      $orderArray = $this->db->query($query);
      
      foreach($orderArray->result_array() as $order){
        $query = "INSERT INTO orders_timeline (mod_date, order_id, order_status) 
                  VALUES (NOW(), '".$order['orderp_id']."', '".$order['status']."')";
        $this->db->query($query);
      };
    }
    
    public function showOrderList($data){
      $query = "SELECT order_status, COUNT(*) FROM orders_timeline WHERE mod_date='".$data['date']."' GROUP BY order_status";
      $orderArray = $this->db->query($query);
      if($orderArra)
        $iaLength=0;
        foreach($orderArray->result_array() as $infoArray[$iaLength]){
          $iaLength++;
        };
        echo json_encode($infoArray);
     
      
      
    }
  }
?>