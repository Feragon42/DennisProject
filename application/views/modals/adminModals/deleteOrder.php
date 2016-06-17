    <div class='modal fade' id='deleteOrder'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button class='close' type='button' data-dismiss='modal' &times>X</button>
            <h2 class='modal-title'>Borrar Orden</h2>
          </div>
          <div class='modal-body'>
            <p>Haga click en la orden que desee eliminar.</p><br>
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
                  
                  <div id="<?php echo 'order'.$i ?>" style='display:none;' class='text-center'> 
                    <label>Seguro que desea elimar la orden numero <label id="<?php echo 'orderID'.$i ?>" style='color:blue;'><?php echo $orderArray[$i]['orderp_id'] ?></label></label>
                    <br><br>
                    <form method='POST'>
                      <button class='btn btn-danger' type='submit' id='orderDelete' order_number="<?php echo $i ?>">Si</button>
                      <br><br>
                    </form>
                    
                  </div>
                  
                  <hr>
            <?php
                }
              }
              else{
                echo "<h1>No hay usuarios registrados</h1>";
              }
            ?>
          </div>
        </div>
      </div>
    </div>