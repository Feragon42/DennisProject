    <div class='modal fade' id='deleteUser'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button class='close' type='button' data-dismiss='modal' &times>X</button>
            <h2 class='modal-title'>Borrar Usuario</h2>
          </div>
          <div class='modal-body'>
            <p>Haga click en el usuario que desee eliminar.</p><br>
            <?php
              $af =& get_instance();
              $af->load->library('admin_functions');
              $userArray = $af->admin_functions->showData('user');
              $length = count($userArray);
              if($length!=0){
                for($i=0;$i<$length;$i++){
                ?>
                  <div class='names' open_id="<?php echo 'user'.$i ?>">
                    <h3>
                      <?php echo $userArray[$i]['name']; ?>
                    </h3>
                    <small>
                      <?php echo $userArray[$i]['userType']; ?>
                    </small>       
                  </div>
                  
                  <div id="<?php echo 'user'.$i ?>" style='display:none;' class='text-center'>
                    
                    <label>Seguro que desea elimar al usuario <label id="<?php echo 'username'.$i ?>" style='color:blue;'><?php echo $userArray[$i]['username']; ?></label></label>
                    <br>
                    <small>Este usuario es <?php echo $userArray[$i]['userType']; ?>, puede contactarlo por el correo <?php echo $userArray[$i]['email']; ?>.</small>
                    <br><br>
                    <form method='POST'>
                      <button class='btn btn-danger' type='submit' id='userDelete' user_number="<?php echo $i ?>">Si</button>
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