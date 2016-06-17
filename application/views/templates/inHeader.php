 <?php 
  $pg = new Pages();
  $dUser = $pg->takeSessionInfo();
  echo "<h2> Bienvenido/a ".$dUser['name']." </h2>";
 ?>
 
 <form action='redirectout'>
  <button class='btn btn-danger' type='submit'>Logout</button>
 </form>
 
