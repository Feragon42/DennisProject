    <div class='modal fade' id='createUser'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button class='close' type='button' data-dismiss='modal' &times>X</button>
            <h2 class='modal-title'>Crear Usuario</h2>
          </div>
          <div class='modal-body'>
            <form method='POST' class='form-horizontal' action='#'>
              <p>Ingrese los datos solicitados a continuacion</p><br><br><br>
              
              <div class='form-group'>
                <label for='inputUser' class="control-label col-xs-4">Nombre de usuario: </label>
                <div class='control-label col-xs-8'>
                  <input type='text' class='form-control' id='inputUser' placeholder='Ejem: adminDennys'>
                </div>
              </div>
              
              <div class='form-group'>
                <label for='inputUser' class="control-label col-xs-4">Nombre Completo: </label>
                <div class='control-label col-xs-8'>
                  <input type='text' class='form-control' id='inputName' placeholder='Ejem: Dennys Perez'>
                </div>
              </div>
              
              <div class='form-group'>
                <label for='inputEmail' class="control-label col-xs-4">Correo del usuario: </label>
                <div class='control-label col-xs-8'>
                  <input type='email' class='form-control' id='inputEmail' placeholder='Correo del Usuario'>
                </div>
              </div>
              
              <div class='form-group'>
                <label for='inputPassword' class="control-label col-xs-4">Contraseña: </label>
                <div class='control-label col-xs-8'>
                  <input type='password' class='form-control' id='inputPassword' placeholder='Contraseña'>
                </div>
              </div>
              
              <div class='form-group'>
                <label for='reInputPassword' class="control-label col-xs-4">Confirmar Contraseña: </label>
                <div class='control-label col-xs-8'>
                  <input type='password' class='form-control' id='reInputPassword' placeholder='Contraseña'>
                </div>
              </div>
              
              <div class='form-group'>
                <label for='inputUserType' class="control-label col-xs-4">Tipo de usuario: </label>
                <div class='control-label col-xs-4'>
                  <select class='form-control' id='inputUserType'>
                    <option value='Administrador'>Administrador</option>
                    <option value='Recepcionista'>Recepcionista</option>
                    <option value='Jefe de Operaciones'>Jefe de Operaciones</option>
                    <option value='Jefe de Planta'>Jefe de Planta</option>
                  </select>
                </div>
              </div>
              
              <br>
              <button class='btn btn-warning btn-group-xs' id='passGenerator'>Generar Contrasena *</button>
              <button class='btn btn-primary btn-group-xs' id='userCreation'>Crear Usuario</button>
              <p><small>* La contrasena sera generada con caracteres alfanumericos al azar.</small></p>           
            </form>
          </div>
        </div>
      </div>
    </div>