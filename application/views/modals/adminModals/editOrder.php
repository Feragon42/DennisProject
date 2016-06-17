    <div class='modal fade' id='editOrder'>  
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button class='close' type='button' data-dismiss='modal' &times>X</button>
            <h2 class='modal-title'>Editar Orden de Produccion</h2>
          </div>
          <div class='modal-body'>
              <p>Haga click en la orden que desee editar y reingrese la informacion solicitada.</p><br>
            <?php
              $af =& get_instance();
              $af->load->library('admin_functions');
              $orderArray = $af->admin_functions->showData('orderp');
              $length = count($orderArray);
              if($length!=0){
                for($i=0;$i<$length;$i++){
            ?>
                  <div class='orders' open_id="<?php echo 'order'.$i ?>">
                    <h3><small>Cliente:</small> <?php 
                                  $clientName = $af->admin_functions->retrieveInfoOrders('client', 'client_name', 'client_id', $orderArray[$i]['client_id']);
                                  echo $clientName[0]['client_name'] ?></h3>
                    <p>Orden ID: <?php echo $orderArray[$i]['orderp_id'] ?></p>
                  </div>
                  <div id="<?php echo 'order'.$i ?>" style='display:none;'> 
                    
                    <!-Aqui comienza el formulario de edicion->
                    <form method='POST' class='form-horizontal'>
                      
                      <!-Status de la orden->
                      <label>Status de la Orden: </label><br>
                      <select class='form-control' id="<?php echo 'inputOrderStatus'.$i ?>">
                        <?php $orderStatusArray = ['Por Revisar', 'Revisado', 'En Produccion'];
                          for($j=0;$j<count($orderStatusArray);$j++){
                        ?>
                        <option value="<?php echo $orderStatusArray[$j] ?>" <?php if($orderStatusArray[$j]==$orderArray[$i]['status']){echo 'selected';}?>>
                          <?php echo $orderStatusArray[$j] ?>
                        </option>
                        <?php
                          }
                        ?>
                      </select><br>
                      
                      <!-Lista de Productos del cliente->
                      <div id="<?php echo 'selectProductOrder'.$i ?>">
                      <?php
                        $productClientArray = $af->admin_functions->retrieveInfoOrders('product_client', 'product_id', 'client_id', $orderArray[$i]['client_id']);
                        $productOrderArray = $af->admin_functions->retrieveInfoOrders('product_order', '*', 'orderp_id', $orderArray[$i]['orderp_id']);  
                        for($j=0;$j<count($productClientArray);$j++){
                          $proceed = true;
                          $productName = $af->admin_functions->retrieveInfoOrders('product', 'product_name', 'product_id', $productClientArray[$j]['product_id']);
                          for($k=0;$k<count($productOrderArray);$k++){
                            if($productClientArray[$j]['product_id'] == $productOrderArray[$k]['product_id']){
                      ?>
                              <div>
                                <label><input type='checkbox' name='productSelect' product_id="<?php echo $productClientArray[$j]['product_id']?>" checked> 
                                  <?php echo $productName[0]['product_name']?>
                                </label>
                                <small> cant: </small>
                                <input type='number' id="<?php echo 'qProduct'.$productClientArray[$j]['product_id']?>" 
                                  placeholder='000' min='0' max ='999' class='productQty' value="<?php echo $productOrderArray[$k]['quantity']?>" >
                              </div>
                      <?php
                              $proceed = false;
                            }
                          }
                          if($proceed){
                          
                      ?>
                            <div>
                              <label><input type='checkbox' name='productSelect' product_id="<?php echo $productClientArray[$j]['product_id']?>"> 
                                <?php echo $productName[0]['product_name']?>
                              </label>
                              <small> cant: </small>
                              <input type='number' id="<?php echo 'qProduct'.$productClientArray[$j]['product_id']?>" placeholder='000' min='0' max ='999' class='productQty'>
                            </div>
                      <?php
                          }
                        }
                      ?>
                      </div>

                      <!-Boton para enviar->
                      <br>
                        <button class='btn btn-primary btn-group-xs' id='orderEdit' 
                        order_number="<?php echo $i ?>" 
                        order_id="<?php echo $orderArray[$i]['orderp_id'] ?>"
                        client_id="<?php echo $orderArray[$i]['client_id'] ?>">Editar Order</button>
                    </form>                      
                  </div>
                  <hr> 
            <?php
                }
              }
              else{
                echo "<h1>No hay clinetes registrados</h1>";
              } 
            ?>
          </div>
        </div>
      </div>
    </div>