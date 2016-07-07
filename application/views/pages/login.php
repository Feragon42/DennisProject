  <div id='section'>
    <form id='logIn' action='redirect' method='POST'>
      <img id='iconoLogin' src='public/images/login.ico'>
      <h4>Ingrese sus datos para continuar</h4>
      <div class='form-group'>
        <div class='input'>
          <label for='inputUser'>Nombre de usuario</label>
          <input type='text' class='form-control' name='inputUser' placeholder='Nombre de Usuario'>
          <span class='glyphicon glyphicon-user inputLogIcon'>
        </div>
      </div>
      <div class='form-group'>
        <div class='input'>
          <label for='inputPass'>Contraseña</label>
          <input type='password' class='form-control' name='inputPass' placeholder='Contraseña'>
          <span class='glyphicon glyphicon-asterisk inputLogIcon'>
        </div>
      <br>
      <button type='submit' class='btn btn-primary' id='loginBTN'>Ingresar</button>
    </form>
  </div>