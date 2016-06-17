    <div class='modal fade' id='createOrder'>  
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button class='close' type='button' data-dismiss='modal' &times>X</button>
            <h2 class='modal-title'>Crear Orden de Produccion</h2>
          </div>
          <div class='modal-body'>
            <form method='POST' class='form-horizontal'>
              <p>Ingrese los datos solicitados a continuacion</p><br>
              <label>Cliente: </label>
              <select class='form-control' id='clientSelect' onchange='showProducts("createOrder")'>
                <option disabled selected>Selecciona un cliente</option>
              <?php
                $af =& get_instance();
                $af->load->library('admin_functions');
                $clientArray = $af->admin_functions->showData('client');
                $length = count($clientArray);
                if($length!=0){
                  for($i=0;$i<$length;$i++){
              ?>
                    <option client_id="<?php echo $clientArray[$i]['client_id']?>"><?php echo $clientArray[$i]['client_name']?></option>
              <?php
                  }
                }
                else {
                  echo '<h3>No hay clientes registrados</h3>';
                }
              ?>
              </select>
              
              <div class='listOfProduct'>
                <p>No hay productos</p>
              </div>  

              <br>
              <button class='btn btn-primary' id='orderCreation' disabled>Crear Orden</button>
            </form>
          </div>
        </div>
      </div>
    </div>