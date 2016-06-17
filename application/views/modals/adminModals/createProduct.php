    <div class='modal fade' id='createProduct'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button class='close' type='button' data-dismiss='modal' &times>X</button>
            <h2 class='modal-title'>Crear Articulo</h2>
          </div>
          <div class='modal-body'>
            <form method='POST' class='form-horizontal'>
              <p>Ingrese los datos solicitados a continuacion</p><br>
              <div>
                
                <label for='inputUser'>Nombre del Articulo: </label>
                <input type='text' class='form-control' id='inputNameProduct' placeholder='Ejm: Jabon de Manos'><br>
                
                <label for='inputUserType'>Tipo de articulo: </label>
                <select class='form-control' style='width:40%;' id='inputTypeProduct'>
                  <option value='Liquido'>Liquido</option>
                  <option value='Solido'>Solido</option>
                </select>
                
                <br>
                <!-Clientes para  el producto->
                <label>Clientes a los que se le ofrece el producto:</label><br>
                <?php
                  $af =& get_instance();
                  $af->load->library('admin_functions');
                  $clientArray = $af->admin_functions->showData('client');
                  $lengthP = count($clientArray);
                  if($lengthP!=0){
                    for($j=0;$j<$lengthP;$j++){
                ?>
                    <label><input type='checkbox' name='clientSelect' value="<?php echo $clientArray[$j]['client_id'] ?>"><?php echo $clientArray[$j]['client_name'] ?></label><br>
                <?php
                    }
                  }
                  else{
                    echo "<h3>No hay productos que ofrecer</h3>";
                  }
                ?>
              </div>
    
              <br>
              <button class='btn btn-primary btn-group-xs' id='productCreation'>Crear Articulo</button>      
            </form>
          </div>
        </div>
      </div>
    </div>