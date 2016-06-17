    <div class='modal fade' id='createClient'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button class='close' type='button' data-dismiss='modal' &times>X</button>
            <h2 class='modal-title'>Crear Cliente</h2>
          </div>
          <div class='modal-body'>
            <form method='POST' class='form-horizontal'>
              <p>Ingrese los datos solicitados a continuacion</p><br>
              <div>
                <!-Nombre de Cliente->
                <div class='form-group'>
                  <label class='control-label col-xs-4'>Nombre del Cliente:</label>
                  <div class='control-label col-xs-8'>
                    <input type='name' class='form-control' id="inputNameClient" placeholder='Ejm: Hotel Hesperia'>
                  </div>
                </div>
                
                <!-Direccion de Cliente->
                <div class='form-group'>
                  <label class='control-label col-xs-4'>Direccion del Cliente:</label>
                  <div class='control-label col-xs-8'>
                    <input type='text' class='form-control' id="inputDirection" placeholder='Ejm: Calle 133 Urb. Prebo, Valencia edo. Carabobo'>
                  </div>
                </div>
                
                <!-Telefono de Cliente-><!-Revisar el type del input para telefonos->
                <div class='form-group'>
                  <label class='control-label col-xs-4'>Telefono del Cliente:</label>
                  <div class='control-label col-xs-8'>
                    <input type='text' class='form-control' id="inputTelph" placeholder='Ejm: 02418952255'>
                  </div>
                </div>
                
                <!-Email de Cliente->
                <div class='form-group'>
                  <label class='control-label col-xs-4'>Correo del Cliente:</label>
                  <div class='control-label col-xs-8'>
                    <input type='email' class='form-control' id="inputEmailClient" placeholder='Ejm: contacto@hesperia.com'>
                  </div>
                </div>
                
                <!-Productos del Cliente->
                <label>Productos que se le ofrecen al cliente:</label><br>
                <?php
                  $af =& get_instance();
                  $af->load->library('admin_functions');
                  $productArray = $af->admin_functions->showData('product');
                  $lengthP = count($productArray);
                  if($lengthP!=0){
                    for($j=0;$j<$lengthP;$j++){
                ?>
                    <label><input type='checkbox' name='productSelect' value="<?php echo $productArray[$j]['product_id'] ?>"> <?php echo $productArray[$j]['product_name'] ?></label><br>
                <?php
                    }
                  }
                  else{
                    echo "<h3>No hay productos que ofrecer</h3>";
                  }
                ?>
              </div>
    
              <br>
              <button class='btn btn-primary btn-group-xs' id='clientCreation'>Crear Cliente</button>      
            </form>
          </div>
        </div>
      </div>
    </div>