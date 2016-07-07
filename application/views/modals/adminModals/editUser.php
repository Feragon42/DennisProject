    <div class='modal fade' id='editUser'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button class='close' type='button' data-dismiss='modal' &times>X</button>
            <h2 class='modal-title'>Editar Usuario</h2>
          </div>
          <div class='modal-body'>
            <p>Haga click en el usuario que desee editar y reingrese la informacion solicitada.</p><br>
            <?php
              $af =& get_instance();
              $af->load->library('admin_functions');
              $userArray = $af->admin_functions->showData('user');
              $length = count($userArray);
              if($length!=0){
                for($i=0;$i<$length;$i++){
                  ?>
                  <div class='names' open_id="<?php echo 'user'.$i ?>">
                    <h3><?php echo $userArray[$i]['name'] ?></h3>
                  </div>
                  <div id="<?php echo 'user'.$i ?>" style='display:none;'>
                    
                    <!-Aqui comienza el formulario de edicion.->
                    <form method='POST' class='form-horizontal'>
                        
                      <!-Nombre de usuario->
                      <div class='form-group'>
                        <label class='control-label col-xs-4'>Nombre de Usuario:</label>
                        <div class='control-label col-xs-8'>
                          <input type='name' class='form-control' id="<?php echo 'inputUser'.$i ?>" value='<?php echo $userArray[$i]['username'] ?>'>
                        </div>
                      </div>
                        
                      <!-Nombre de usuario->
                      <div class='form-group'>
                        <label class='control-label col-xs-4'>Nombre Completo:</label>
                        <div class='control-label col-xs-8'>
                          <input type='text' class='form-control' id="<?php echo 'inputName'.$i ?>" value='<?php echo $userArray[$i]['name'] ?>'>
                        </div>
                      </div>
                        
                      <!-Correo del usuario->
                      <div class='form-group'>
                        <label class='control-label col-xs-4'>Correo de Usuario:</label>
                        <div class='control-label col-xs-8'>
                          <input type='email' class='form-control' id="<?php echo 'inputEmail'.$i ?>" value='<?php echo $userArray[$i]['email'] ?>'>
                        </div>
                      </div>
                        
                      <!-Contrasena->
                      <div class='form-group'>
                        <label class='control-label col-xs-4'>Contrasena:</label>
                        <div class='control-label col-xs-8'>
                          <input type='password' id="<?php echo 'inputPassword'.$i ?>" class='form-control'>
                        </div>
                      </div>
                        
                      <!-Reingrese Contrasena->
                      <div class='form-group'>
                        <label class='control-label col-xs-4'>Reingrese Contrasena:</label>
                        <div class='control-label col-xs-8'>
                          <input type='password' id="<?php echo 'reInputPassword'.$i ?>" class='form-control'>
                        </div>
                      </div>
                            
                      <!-Tipo de Usuario->
                      <div class='form-group'>
                        <label class='control-label col-xs-4'>Tipo de Usuario:</label>
                        <div class='control-label col-xs-4'>
                          <select class='form-control' id="<?php echo 'inputUserType'.$i ?>">
                            <?php $userTypeArray = ['Administrador', 'Recepcionista', 'Jefe de Operaciones', 'Jefe de Planta'];
                              for($j=0;$j<count($userTypeArray);$j++){
                            ?>
                            <option value="<?php echo $userTypeArray[$j] ?>" <?php if($userTypeArray[$j]==$userArray[$i]['userType']){echo 'selected';}?>>
                              <?php echo $userTypeArray[$j] ?>
                            </option>
                            <?php
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      
                      <!-Status->
                      <div class='form-group'>
                        <label class='control-label col-xs-4'>Estado:</label>
                        <div class='control-label col-xs-4'>
                          <select class='form-control' id="<?php echo 'inputUserStatus'.$i ?>">
                            <?php $userStatusArray = ['Activo', 'Inactivo'];
                              for($j=0;$j<count($userStatusArray);$j++){
                            ?>
                            <option value="<?php echo $userStatusArray[$j] ?>" <?php if($userStatusArray[$j]==$userArray[$i]['status']){echo 'selected';}?>>
                              <?php echo $userStatusArray[$j] ?>
                            </option>
                            <?php
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                        
                      <!-Boton para enviar->
                      <br>
                        <button class='btn btn-primary btn-group-xs' id='userEdit' user_number="<?php echo $i ?>" user_id="<?php echo $userArray[$i]['user_id'] ?>">Guardar Cambios</button>
                    </form>                      
                  </div>
                  <hr> 
          <?php }
              }
              else{
                echo "<h1>No hay usuarios registrados</h1>";
              }
            ?>
          </div>
        </div>
      </div>
    </div>