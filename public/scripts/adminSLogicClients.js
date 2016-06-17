/*---------------- Create Client-----------------*/
$('#createClient #clientCreation').on('click', function(evt){
  if(inputBlank('createClient')===false){ //Revisar si no hay campos vacios, funcion alojada en scripts/adminSLogicUsers.js
    
    var arrayProduct = [];
    $('#createClient input[name="productSelect"]:checked').each(function(){
      arrayProduct.push(this.value);
    })
    
    $.ajax({ // AJAX para guardar la informacion del cliente en la tabla client.
      type: "POST",
      url: "pages/createClient",
      data: {
        client_name: $('#inputNameClient').val(),
        client_direction: $('#inputDirection').val(),
        client_telph: $('#inputTelph').val(),
        client_email: $('#inputEmailClient').val(),
        client_product: arrayProduct
      },
      dataType: "text",
      cache:false,
      success: 
        function (){alert('Cliente creado satisfactoriamente')}
    });
  }
  else{
    evt.preventDefault();
    alert('No deje campos vacios');
  }
  
  
});

/*------------------Edit Client-----------------*/

$('.clients').on('click', function(){
  var clientID = $(this).attr('open_id');
  $('#'+clientID).slideToggle(200);
});


$('#editClient #clientEdit').on('click', function(evt){
  var n=$(this).attr('client_number'); //Se obtiene el numero del perfil que se esta editando
  var idN = $(this).attr('client_id'); //Se obtiene el id del cliente que se va a editar
  
  var arrayProduct = [];
  $('#editClient input[name="productSelect'+n+'"]:checked').each(function(){
    arrayProduct.push(this.value);
  })
  
  if($('#client'+n+' input').val()!=''){ //Revisar si no hay campos vacios, funcion alojada en scripts/adminSLogicUsers.js
    $.ajax({ // AJAX para guardar la informacion del cliente en la tabla client.
      type: "POST",
      url: "pages/editClient",
      data: {
        client_id: idN,
        client_name: $('#client'+n+' #inputNameClient'+n).val(),
        client_direction: $('#client'+n+' #inputDirection'+n).val(),
        client_telph: $('#client'+n+' #inputTelph'+n).val(),
        client_email: $('#client'+n+' #inputEmailClient'+n).val(),
        client_product: arrayProduct
      },
      dataType: "text",
      cache:false,
      success: 
        function (){alert('Cliente editado satisfactoriamente')}
    });
  }
  else{
    evt.preventDefault();
    alert('No deje campos vacios');
  } 
});

/*-----------------Delete Client----------------*/

$('#deleteClient .clients').on('click', function(){
  var clientID = $(this).attr('open_id');
  $('#deleteClient #'+clientID).slideToggle(200);
});

$('#deleteClient #clientDelete').on('click', function(){
  var n=$(this).attr('client_number');
  $.ajax({
    type: "POST",
    url: "pages/deleteClient",
    data: {
      client_name: $('#deleteClient #clientName'+n).text()
    },
    dataType: "text",
    cache:false,
    success:
      function(){alert('Cliente eliminado satisfactoriamente')}
  });
});