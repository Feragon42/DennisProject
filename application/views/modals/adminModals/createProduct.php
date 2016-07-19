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
                  <option value='Solido'>Solido</option>
                  <option value='Liquido'>Liquido</option>
                </select>
                
                <br>
                
                <label for='inputStatusProduct'>Estado de articulo: </label>
                <select class='form-control' style='width:40%;' id='inputStatusProduct'>
                  <option value='Disponible'>Disponible</option>
                  <option value='No Disponible'>No Disponible</option>
                </select>
                
                <br>
                
                <label for='inputSupplierProduct'>Proveedor*: </label>
                <input type='text' class='form-control' id='inputSupplierProduct' placeholder='Ejm: Jabonera Maracay'>
                <small>*Si no tiene, coloque N/A</small><br>
                
                
              </div>
    
              <br>
              <button class='btn btn-primary btn-group-xs' id='productCreation'>Crear Articulo</button>      
            </form>
          </div>
        </div>
      </div>
    </div>