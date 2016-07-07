    <div class='modal fade' id='statistics'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button class='close' type='button' data-dismiss='modal' &times>X</button>
            <!-Header para la version impresa->
            <div class='printHeader'  >
              <img src='public/images/logo.png'><br>
            </div>
            <h2 class='modal-title'>Estadisticas de Ventas</h2>
          </div>
          <div class='modal-body'>
            <?php
              $af =& get_instance();
              $af->load->library('admin_functions');
            ?>     
            
            <h2>Ordenes</h2>
            <label> A continuacion se presentaran el listado de ordenes que se han registrado</label><br>
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