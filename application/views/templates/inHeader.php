 <?php 
  $pg = new Pages();
  $dUser = $pg->takeSessionInfo();
  echo "<h2> Bienvenido/a <label id='actualUsername'>".$dUser['name']."</label></h2>";
 ?>
 
 <form action='redirectout'>
  <button class='btn btn-danger' type='submit'>Logout</button>
 </form>
 
