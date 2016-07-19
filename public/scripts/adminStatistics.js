$("#printStatistics").click(function() {
    $("#statistics").printThis({
        debug: false,
        importCSS: false,
        importStyle: true,
        //Enrutamiento online
        //loadCSS: "public/stylesheets/printStyle.css",
        loadCSS: "dennys/public/stylesheets/printStyle.css",
        pageTitle: "Reporte Estadistico"
    });
});


$("#printTimeline").click(function() {
    $("#timeline").printThis({
        debug: false,
        importCSS: true,
        importStyle: true,
        //Enrutamiento online
        //loadCSS: "public/stylesheets/printStyle.css",
        loadCSS: "dennys/public/stylesheets/printStyle.css",
        pageTitle: "Reporte de Actividades"
    });
});


$('#testDay').click(function(){
    $.ajax({
      type: "POST",
      url: "pages/updateOrderTimeline",
      dataType: "text",
      cache:false,
      success: 
        function(){
          alert('Base de Datos actualizada');
        }
    });
});

$('#filtrar').click(function(){
    $('#orderListPerDay').slideToggle(200);
    
    var dateStr = $('#year').val() +'-'+ $('#month').val() +'-'+ $('#day').val();
    console.log(dateStr);
    
    $.ajax({
        type:"POST",
        url: "pages/showOrderList",
        data: {
            date : dateStr
        },
        dataType: "json",
        cache: false
            
    }).done(function(data){
       
       function show (array){
           var str = '<ul>';
           for(i=0; i<array.length; i++){
               str = str + '<li><label>' + array[i]['order_status'] + ' : ' + array[i]['COUNT(*)'] + '</label></li>';
           }
           str = str + '</ul>';
           return str;
       }
          
       $('#orderListPerDay').html(function(){
           return show(data);   
       });
       
       $('#orderListPerDay').slideToggle(200);
    }).fail(function(err){
       $('#orderListPerDay').html(function(){
           return '<h2>No hay coincidencias <br><small>Por favor, vuelva a intentarlo con otra fecha</small></h2>'
        });
       $('#orderListPerDay').slideToggle(200);
    });
        
    
    
});