    <div class='modal fade' id='editClient'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button class='close' type='button' data-dismiss='modal' &times>X</button>
            <h2 class='modal-title'>Editar Cliente</h2>
          </div>
          <div class='modal-body'>
            <p>Haga click en el cliente que desee editar y reingrese la informacion solicitada.</p><br>
            <?php
              $af =& get_instance();
              $af->load->library('admin_functions');
              $clientArray = $af->admin_functions->showData('client');
              $length = count($clientArray);
              if($length!=0){
                for($i=0;$i<$length;$i++){
            ?>
                  <div class='clients' open_id="<?php echo 'client'.$i ?>">
                    <h3><?php echo $clientArray[$i]['client_name'] ?></h3>
                  </div>
                  <div id="<?php echo 'client'.$i ?>" style='display:none;'>
                    
                    <!-Aqui comienza el formulario de edicion->
                    <form method='POST' class='form-horizontal'>
                      
                      <!-Nombre de Cliente->
                      <div class='form-group'>
                        <label class='control-label col-xs-4'>Nombre del Cliente:</label>
                        <div class='control-label col-xs-8'>
                          <input type='name' class='form-control' id="<?php echo 'inputNameClient'.$i ?>" placeholder='<?php echo $clientArray[$i]['client_name'] ?>'>
                        </div>
                      </div>
                      
                      <!-Direccion de Cliente->
                      <div class='form-group'>
                        <label class='control-label col-xs-4'>Direccion del Cliente:</label>
                        <div class='control-label col-xs-8'>
                          <input type='text' class='form-control' id="<?php echo 'inputDirection'.$i ?>" placeholder='<?php echo $clientArray[$i]['client_direction'] ?>'>
                        </div>
                      </div>
                      
                      <!-Telefono de Cliente-><!-Revisar el type del input para telefonos->
                      <div class='form-group'>
                        <label class='control-label col-xs-4'>Telefono del Cliente:</label>
                        <div class='control-label col-xs-8'>
                          <input type='text' class='form-control' id="<?php echo 'inputTelph'.$i ?>" placeholder='<?php echo $clientArray[$i]['client_telph'] ?>'>
                        </div>
                      </div>
                      
                      <!-Email de Cliente->
                      <div class='form-group'>
                        <label class='control-label col-xs-4'>Correo del Cliente:</label>
                        <div class='control-label col-xs-8'>
                          <input type='email' class='form-control' id="<?php echo 'inputEmailClient'.$i ?>" placeholder='<?php echo $clientArray[$i]['client_email'] ?>'>
                        </div>
                      </div>
                      
                      <!-Productos del Cliente->
                      <label>Productos que se le ofrecen al cliente:</label><br>
                      <?php
                        $productArray = $af->admin_functions->showData('product');
                        $lengthP = count($productArray);
                        if($lengthP!=0){
                          for($j=0;$j<$lengthP;$j++){
                      ?>
                          <label><input type='checkbox' name='productSelect<?php echo $i ?>' value="<?php echo $productArray[$j]['product_id'] ?>"><?php echo $productArray[$j]['product_name'] ?></label><br>
                      <?php
                          }
                        }
                        else{
                          echo "<h3>No hay productos que ofrecer</h3>";
                        }
                      ?>
                      
                      <!-Boton para enviar->
                      <br>
                        <button class='btn btn-primary btn-group-xs' id='clientEdit' client_number="<?php echo $i ?>" client_id="<?php echo $clientArray[$i]['client_id'] ?>">Editar Cliente</button>
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