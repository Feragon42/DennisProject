    <div class='modal fade' id='statistics'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button class='close' type='button' data-dismiss='modal' &times>X</button>
            <!-Header para la version impresa->
            <div class='printHeader'  >
              <img src='dennys/public/images/logo.png'><br><br><br>
            </div>
            <h2 class='modal-title'>Estadisticas de Ventas</h2>
          </div>
          <div class='modal-body'>
            <?php
              $af =& get_instance();
              $af->load->library('admin_functions');
            ?>     
            
            <h2>Ordenes</h2>
            <label> Selecciona una fecha para filtrar los resultados</label>
            <br>
            
            <label>Dia</label>
            <select id='day'>
              <?php
                for($i=1; $i<=31; $i++){
                  echo '<option value='.sprintf("%'.02d\n", $i).'>'.sprintf("%'.02d\n", $i).'</option>';
                }
              ?>
            </select>
            <label>Mes</label>
            <select id='month'>
              <?php
                for($i=1; $i<=12; $i++){
                  echo '<option value='.sprintf("%'.02d\n", $i).'>'.sprintf("%'.02d\n", $i).'</option>';
                }
              ?>
            </select>
            <label>Año</label>
            <select id='year'>
              <?php
                for($i=10; $i<=20; $i++){
                  echo '<option value=20'.$i.'>20'.$i.'</option>';
                }
              ?>
            </select>   
            <button class='btn btn-warning' id='filtrar'>Filtrar</button><br>
            
            <div id='orderListPerDay'>
              <div id='standarScreen'>
                <label> Al dia de hoy hay:</label><br>
                <?php
                  $orderStatsArray = $af->admin_functions->orderNumbers();
                  $orderQty = 0;
                  echo '<ul>';
                  foreach($orderStatsArray->result_array() as $stats){
                    echo '<li><label>'.$stats['status'].': '.$stats['COUNT(*)'].' <small>orden/es</small></label></li>';
                    $orderQty += $stats['COUNT(*)'];
                  }
                  echo '</ul>';
                  echo '<label>Se han realizado un total de '.$orderQty.' ordenes.</label>';
                ?>
              </div>
            </div>
            
           <h2> Productos </h2>
           <label> A continuacion se mostrara un listado de los productos ofrecidos y cuantos se han vendidos de cada uno</label><br>
           <?php
             $productStatsArray = $af->admin_functions->productNumbers();
             $productQty=0;
             echo '<ul>';
             foreach($productStatsArray->result_array() as $stats){
               $productName = $af->admin_functions->retrieveInfoOrders('product', 'product_name', 'product_id', $stats['product_id']);
               echo '<li><label>'.$productName[0]['product_name'].': '.$stats['suma'].' <small>unidades</small></label></li>';
               $productQty += $stats['suma'];
             }
             echo '</ul>';
             echo '<label>Se han vendido un total de '.$productQty.' de unidades.</label>';
           ?>
           
            <br>
            <br>
              
            <button class='btn btn-succes' id='printStatistics'>
              Imprimir
              <span class="glyphicon glyphicon-print"></span>     
            </button>
          </div>
        </div>
      </div>
    </div>