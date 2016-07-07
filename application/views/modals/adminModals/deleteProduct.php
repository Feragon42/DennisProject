    <div class='modal fade' id='deleteProduct'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button class='close' type='button' data-dismiss='modal' &times>X</button>
            <h2 class='modal-title'>Borrar Producto</h2>
          </div>
          <div class='modal-body'>
            <p>Haga click en el producto que desee eliminar. Si lo que prefiere es indicar que no esta disponible, por favor indiquelo en EDITAR PRODUCTO</p><br>
            <?php
              $af =& get_instance();
              $af->load->library('admin_functions');
              $productArray = $af->admin_functions->showData('product');
              $length = count($productArray);
              if($length!=0){
                for($i=0;$i<$length;$i++){
                ?>
                  <div class='products' open_id="<?php echo 'product'.$i ?>">
                    <h3>
                      <?php echo $productArray[$i]['product_name']; ?>
                    </h3>    
                  </div>
                  
                  <div id="<?php echo 'product'.$i ?>" style='display:none;' class='text-center'>
                    
                    <label>Seguro que desea elimar al producto <label id="<?php echo 'productName'.$i ?>" style='color:blue;'><?php echo $productArray[$i]['product_name']; ?></label>?</label>
                    <br><br>
                    <form method='POST'>
                      <button class='btn btn-danger' type='submit' id='productDelete' product_number="<?php echo $i ?>">Si</button>
                      <br><br>
                    </form>
                    
                  </div>
                  
                  <hr>
            <?php
                }
              }
              else{
                echo "<h1>No hay usuarios registrados</h1>";
              }
            ?>
          </div>
        </div>
      </div>
    </div>