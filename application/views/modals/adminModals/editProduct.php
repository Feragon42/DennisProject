    <div class='modal fade' id='editProduct'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button class='close' type='button' data-dismiss='modal' &times>X</button>
            <h2 class='modal-title'>Editar Articulos</h2>
          </div>
          <div class='modal-body'>
            <p>Haga click en el articulo que desee editar y reingrese la informacion solicitada.</p><br>
            <?php
              $af =& get_instance();
              $af->load->library('admin_functions');
              $productArray = $af->admin_functions->showData('product');
              $length = count($productArray);
              if($length!=0){
                for($i=0;$i<$length;$i++){
            ?>
                  <div class='products' open_id="<?php echo 'product'.$i ?>">
                    <h3><?php echo $productArray[$i]['product_name'] ?></h3>
                  </div>
                  <div id="<?php echo 'product'.$i ?>" style='display:none;'>
                    
                    <!-Aqui comienza el formulario de edicion->
                    <form method='POST' class='form-horizontal'>
                      
                      <!-Nombre de Producto>
                      <label>Nombre del Producto:</label>
                      <input type='name' class='form-control' id="<?php echo 'inputNameProduct'.$i ?>" placeholder='<?php echo $productArray[$i]['product_name'] ?>'>
                      <br>
                      
                      <!-Tipo de Producto>
                      <label for='inputUserType'>Tipo de articulo: </label>
                      <select class='form-control' style='width:40%;' id="<?php echo 'inputTypeProduct'.$i ?>">
                        <option value='Liquido'>Liquido</option>
                        <option value='Solido'>Solido</option>
                      </select>
                      <br>
           
                      
                      <!-Clientes para  el producto->
                      <label>Clientes a los que se le ofrece el producto:</label><br>
                      <?php
                        $clientArray = $af->admin_functions->showData('client');
                        $lengthP = count($clientArray);
                        if($lengthP!=0){
                          for($j=0;$j<$lengthP;$j++){
                      ?>
                          <label><input type='checkbox' name='clientSelect<?php echo $i ?>' value="<?php echo $clientArray[$j]['client_id'] ?>"><?php echo $clientArray[$j]['client_name'] ?></label><br>
                      <?php
                          }
                        }
                        else{
                          echo "<h3>No hay productos que ofrecer</h3>";
                        }
                      ?>
                      
                      <!-Boton para enviar->
                      <br>
                        <button class='btn btn-primary btn-group-xs' id='productEdit' product_number="<?php echo $i ?>" product_id="<?php echo $productArray[$i]['product_id'] ?>">Editar Producto</button>
                    </form>                      
                  </div>
                  <hr> 
            <?php
                }
              }
              else{
                echo "<h1>No hay clinetes registrados</h1>";
              } 
            ?>
          </div>
        </div>
      </div>
    </div>