<div class='container orderList jdPlanta'>
  <button class='btn btn-primary' id='showStatistics' data-toggle='modal' data-target='#statistics'>Mostrar Estadisticas</button>
  <br>
  <br>  
  <?php
    $af =& get_instance();
    $af->load->library('admin_functions');
    $orderArray = $af->admin_functions->showData('orderp');
    $length = count($orderArray);
    $noOrders = TRUE;
    if($length!=0){
      for($i=0;$i<$length;$i++){
        //La recepcionista solo puede ver las ordenes por revisar
        if($orderArray[$i]['status'] == 'Por revision'){
          $noOrders = FALSE;
  ?>
      <div id="<?php echo 'order'.$i?>" class='order col-lg-4'>
        <form method='POST' class='form-horizontal'>
          
          <!-ID DE LA ORDEN->
          <label>Order Id: <b class='orderInfo'><?php echo $orderArray[$i]['orderp_id']?></b></label>
          <br><small> Se le asigna automaticamente al registrar la orden.</small>
          <br><label>Status: <b class='orderInfo'>Por revision</b></label>

          <!-Cliente->
          <div>
            <label>Cliente:
              <b class='orderInfo'>
                <?php 
                  $clientName = $af->admin_functions->retrieveInfoOrders('client', 'client_name', 'client_id', $orderArray[$i]['client_id']);
                  echo $clientName[0]['client_name'] 
                ?>
              </b>
            </label> 
          </div>
          
          <!-Lista de producctos->
          <h3>PRODUCTOS</h3>
          <div id="<?php echo 'selectProductOrder'.$i ?>" class='pl'>
          <?php
            //Busco todos los ID relacionados con el id del cliente en la tabla product_client
            $productClientArray = $af->admin_functions->retrieveInfoOrders('product_client', 'product_id', 'client_id', $orderArray[$i]['client_id']);
            //Busco el id y la cantidad de los productos de la orden en product_order
            $productOrderArray = $af->admin_functions->retrieveInfoOrders('product_order', '*', 'orderp_id', $orderArray[$i]['orderp_id']);  
            //Muestro todos los productos del cliente
            for($j=0;$j<count($productClientArray);$j++){
              $proceed = true;
              //Busco el nombre del producto segun su ID en la tabla de productos
              $productName = $af->admin_functions->retrieveInfoOrders('product', '*', 'product_id', $productClientArray[$j]['product_id']);
              //Muestro los productos
              for($k=0;$k<count($productOrderArray);$k++){
                //Si el status del producto es igual a No Disponible, hara que la variable dispon sea disabled, desactivando todos los campos del producto.
                $dispon = '';
                if($productName[0]['status']=='No Disponible'){
                  $dispon = 'disabled';
                }
                //Si el id del producto del cliente coinciden con el id del producto registrado en la orden, lo marco como checked
                if($productClientArray[$j]['product_id'] == $productOrderArray[$k]['product_id']){
          ?>
                  <div>
                    <label style='width:50%;'><input type='checkbox' name='productSelect' product_id="<?php echo $productClientArray[$j]['product_id']?>" class='disponible' checked > 
                      <?php echo $productName[0]['product_name']?>
                    </label>
                    <small> cant: </small>
                    <input type='number' id="<?php echo 'qProduct'.$productClientArray[$j]['product_id']?>" 
                      placeholder='0000000' min='0' max ='9999999' size='7'  style='width:80px;' class='productQty' value="<?php echo $productOrderArray[$k]['quantity']?>" >
                    <small> Und. </small>
                  </div>
          <?php
                  $proceed = false; //<-- E indico que no vuelva a imprimir este producto
                }
              }
              if($proceed){ //<-- Si el producto no cumple para pasar por el if, igual se imprime pero sin el checked
              
          ?>
                <div>
                  <label style='width:50%;'><input type='checkbox' name='productSelect' product_id="<?php echo $productClientArray[$j]['product_id']?>" 
                    <?php echo $dispon ?>> 
                    <?php echo $productName[0]['product_name']?>
                  </label>
                  <small> cant: </small>
                  <input type='number' id="<?php echo 'qProduct'.$productClientArray[$j]['product_id']?>" 
                  placeholder='0000000' min='0' max ='9999999' size='7'  style='width:80px;' class='productQty' <?php echo $dispon ?>>
                  <small> Und. </small>
                </div>
          <?php
              }
            }
          ?>
          </div>
                      
          <button type='submit' 
                  id='orderEdit'
                  order_id="<?php echo $orderArray[$i]['orderp_id'] ?>"
                  client_id="<?php echo $orderArray[$i]['client_id'] ?>"
                  order-number="<?php echo $i?>"
                  class='btn btn-success pull-right jdoButtons'>Enviar a Produccion</button>
           <button type='submit' 
                  id='orderDelete'
                  order_id="<?php echo $orderArray[$i]['orderp_id'] ?>"
                  order-number="<?php echo $i?>"
                  class='btn btn-danger pull-right jdoButtons'>Eliminar</button>
        </form>
      </div>
      
      
  <?php
        }
      }
      if($noOrders){
        echo "<h1>No hay ordenes registradas</h1>";
      }
    }
    else{
      echo "<h1>No hay ordenes registradas</h1>";
    } 
  ?>
</div>
