<div style='position: absolute; text-align: center; top: 30%; left:40%;'>
  <h1> Redireccionando </h1><br>
  <h3>Por favor, espere.</h3>
</div>
<?php
  $pg = new Pages();
  $data = array(
    'username' => $_POST['inputUser'], 
    'password' => $_POST['inputPass']);
  $pg->redirectPage($data, $pg->exLogin($data));
?>