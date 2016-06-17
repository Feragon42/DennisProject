/*---------------- Create product-----------------*/
$('#productCreation').on('click', function(evt){
  if(inputBlank('createProduct')===false){ //Revisar si no hay campos vacios, funcion alojada en scripts/adminSLogicUsers.js
    var arrayClient = [];
    $('#createProduct input[name="clientSelect"]:checked').each(function(){
      arrayClient.push(this.value);
    })
    
    $.ajax({ // AJAX para guardar la informacion del cliente en la tabla client.
      type: "POST",
      url: "pages/createProduct",
      data: {
        product_name: $('#inputNameProduct').val(),
        product_type: $('#inputTypeProduct').val(),
        product_client: arrayClient
      },
      dataType: "text",
      cache:false,
      success: 
        function (){alert('Producto creado satisfactoriamente')}
    });
  }
  else{
    evt.preventDefault();
    alert('No deje campos vacios');
  } 
});

/*------------------Edit product-----------------*/

$('#editProduct .products').on('click', function(){
  var productID = $(this).attr('open_id');
  $('#editProduct #'+productID).slideToggle(200);
});



$('#editProduct #productEdit').on('click', function(evt){
  var n=$(this).attr('product_number'); //Se obtiene el numero del perfil que se esta editando
  var idN = $(this).attr('product_id'); //Se obtiene el id del producto que se va a editar
  var arrayClient = [];
  $('#editProduct input[name="clientSelect'+n+'"]:checked').each(function(){
    arrayClient.push(this.value);
  })
    
  if($('#product'+n+' input').val()!=''){ //Revisar si no hay campos vacios, funcion alojada en scripts/adminSLogicUsers.js
    $.ajax({ // AJAX para guardar la informacion del producto en la tabla client.
      type: "POST",
      url: "pages/editProduct",
      data: {
        product_id: idN,
        product_name: $('#product'+n+' #inputNameProduct'+n).val(),
        product_type: $('#product'+n+' #inputTypeProduct'+n).val(),
        product_client: arrayClient
      },
      dataType: "text",
      cache:false,
      success: 
        function (){alert('Producto editado satisfactoriamente')}
    });
  }
  else{
    evt.preventDefault();
    alert('No deje campos vacios');
  } 
});


/*-----------------Delete product----------------*/

$('#deleteProduct .products').on('click', function(){
  var productID = $(this).attr('open_id');
  $('#deleteProduct #'+productID).slideToggle(200);
});

$('#deleteProduct #productDelete').on('click', function(){
  var n=$(this).attr('product_number');
  console.log(n)
  $.ajax({
    type: "POST",
    url: "pages/deleteProduct",
    data: {
      product_name: $('#deleteProduct #productName'+n).text()
    },
    dataType: "text",
    cache:false,
    success:
      function(){alert('Producto eliminado satisfactoriamente')}
  });
});