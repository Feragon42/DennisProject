    <div class='modal fade' id='timeline'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
            <button class='close' type='button' data-dismiss='modal' &times>X</button>
            <!-Header para la version impresa->
            <div class='printHeader'  >
              <img src='dennys/public/images/logo.png'><br><br><br>
            </div>
            <h2 class='modal-title'>Resumen Actividades de Usuarios</h2>
          </div>
          <div class='modal-body'>
            <label>A continuacion se encuentran todas las acciones realizadas en el sistema</label><br><br>
            <?php
              $af =& get_instance();
              $af->load->library('admin_functions');
              $timeLine = $af->admin_functions->showTimeline();
              foreach($timeLine->result_array() as $tl){
            ?>
                <p style='font-weight:bold;'>
                  <label><?php echo $tl['date'] ?> | </label> 
                  <label style='width:25%'><font color='blue'><?php echo $tl['username'] ?></font></label>
                  <label style='width:35%'><?php echo $tl['action'] ?></label>
                  <label><font color='red'><?php echo $tl['object_id'] ?></font></label>
                </p>
            
            <?php
                }
            ?>     
            
            <br>
              
            <button class='btn btn-succes' id='printTimeline'>
              Imprimir
              <span class="glyphicon glyphicon-print"></span>     
            </button>
          </div>
        </div>
      </div>
    </div>