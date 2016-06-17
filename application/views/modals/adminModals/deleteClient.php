    <div class='modal fade' id='deleteClient'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button class='close' type='button' data-dismiss='modal' &times>X</button>
            <h2 class='modal-title'>Borrar Cliente</h2>
          </div>
          <div class='modal-body'>
            <p>Haga click en el cliente que desee eliminar.</p><br>
            <?php
              $af =& get_instance();
              $af->load->library('admin_functions');
              $clientArray = $af->admin_functions->showData('client');
              $length = count($clientArray);
              if($length!=0){
                for($i=0;$i<$length;$i++){
                ?>
                  <div class='clients' open_id="<?php echo 'client'.$i ?>">
                    <h3>
                      <?php echo $clientArray[$i]['client_name']; ?>
                    </h3>    
                  </div>
                  
                  <div id="<?php echo 'client'.$i ?>" style='display:none;' class='text-center'>
                    
                    <label>Seguro que desea elimar al cliente <label id="<?php echo 'clientName'.$i ?>" style='color:blue;'><?php echo $clientArray[$i]['client_name']; ?></label>?</label>
                    <br><br>
                    <form method='POST'>
                      <button class='btn btn-danger' type='submit' id='clientDelete' client_number="<?php echo $i ?>">Si</button>
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