
<div class='container orderList jdOperaciones'>  
  <?php
    $af =& get_instance();
    $af->load->library('admin_functions');
    $orderArray = $af->admin_functions->showData('orderp');
    $length = count($orderArray);
    $noOrders = TRUE;
    if($length!=0){
      for($i=0;$i<$length;$i++){
        //La recepcionista solo puede ver las ordenes por revisar
        if($orderArray[$i]['status'] == 'Revisado' || $orderArray[$i]['status'] == 'En Produccion'){
          $noOrders = FALSE;
  ?>
      <div id="<?php echo 'order'.$i?>" class='order col-lg-4'>
        <form method='POST' class='form-horizontal'>
          
          <!-ID DE LA ORDEN->
          <label>Order Id: <b class='orderInfo'><?php echo $orderArray[$i]['orderp_id']?></b></label>
          <br><small> Se le asigna automaticamente al registrar la orden.</small>
          <br><label>Status: <b class='orderInfo'><?php echo $orderArray[$i]['status']?></b></label>

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
          <ul id="<?php echo 'selectProductOrder'.$i ?>" class='pl'>
          <?php
            //Busco el id y la cantidad de los productos de la orden en product_order
            $productOrderArray = $af->admin_functions->retrieveInfoOrders('product_order', '*', 'orderp_id', $orderArray[$i]['orderp_id']);  
            for($j=0;$j<count($productOrderArray);$j++){
              //Busco el nombre del producto segun su ID en la tabla de productos
              $productName = $af->admin_functions->retrieveInfoOrders('product', 'product_name', 'product_id', $productOrderArray[$j]['product_id']);
          ?>
                <li>
                  <div>
                    <label class='productID' product_id="<?php echo $productOrderArray[$j]['product_id']?>">
                      <?php echo $productName[0]['product_name']?>
                    </label>
                    <small> cant: </small>
                    <label id="<?php echo 'qProduct'.$productOrderArray[$j]['product_id']?>" product_quantity="<?php echo $productOrderArray[$j]['quantity']?>">
                      <?php echo $productOrderArray[$j]['quantity']?>
                    </label>
                  </div>
                </li>  
          <?php
                }
          ?>
          </ul>

          <button class='btn btn-succes printOrder' order-number="<?php echo $i?>">
            <span class="glyphicon glyphicon-print"></span>     
          </button>
          
          <!-Botones de Finalizar o Pasar a produccion->
          <?php
            if($orderArray[$i]['status'] == 'En Produccion'){
          ?>
            <button id='orderDelete'
                  order_id="<?php echo $orderArray[$i]['orderp_id'] ?>"
                  order-number="<?php echo $i?>" 
                  class='btn btn-danger pull-right jdoButtons'>Finalizar Orden</button>   
                  
          <?php
            }
            else{
          ?>
            <button id='orderEdit'
                  order_id="<?php echo $orderArray[$i]['orderp_id'] ?>"
                  client_id="<?php echo $orderArray[$i]['client_id'] ?>"
                  order-number="<?php echo $i?>" 
                  class='btn btn-primary pull-right jdoButtons'>Pasar a Produccion</button>      
          <?php
            }
          ?>
          
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