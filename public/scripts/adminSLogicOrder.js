function showProducts(modal){
  ci = $('#'+modal+' #clientSelect option:selected').attr('client_id')
  $.ajax({
    type: 'POST',
    data: {
      client_id : ci
    },
    url: 'pages/showProductOrder',
    dataType: 'text',
    cache: false
  }).done(function(data){ //Cuando el require se cumple, se hace hace lo sigueinte.  
    var productArray = jQuery.parseJSON ( data ); //Se convierte el json recibido en un array asociativo
    var i = 0; 
    $('#'+modal+' .listOfProduct').empty(); //Se vacia el area donde se mostraran los productos, por si no es la primera vez que se clickeo un cliente
    $('#'+modal+' .listOfProduct').append('<h3> Lista de Productos a ofrecer </h3>');
    $.each(productArray, function(field){ //Y, por cada producto en el array, se muestran los datos siguiente.
      var dispon = '';
      if(productArray[i]['status']=='No Disponible'){
        dispon = 'disabled';
      }
      console.log(dispon)
      $('#'+modal+' .listOfProduct').append(
          "<div class='col-xs-12>",
            "<div class='col-xs-6>",
              "<label><input type='checkbox' name='productSelect' product_id="+productArray[i]['product_id']+" "+dispon+"> "+productArray[i]['product_name']+"</label>",
            "</div>",
            "<div class='col-xs-6>",
              "<small> cant: </small>",
              "<input type='number' id='qProduct"+productArray[i]['product_id']+"' placeholder='0000000' min='0' max ='9999999' size='7' class='productQty' style='width:100px;' "+dispon+"> <small>Und.</small>",
              "<br>",
            "</div>",
          "</div>"); 
      i++;
    });
   
    $('#'+modal+' .listOfProduct').css('display', 'block'); //Se hace visible la lista de productos
    $('#'+modal+' #orderCreation').prop('disabled', false); //Se activa el boton de Crear orden
  });
}

/*---------------- Create Order-----------------*/


$('#createOrder #orderCreation').on('click', function(evt){
  var arrayProduct = [];
  var arrayQty = [];
  var orderStatus = 'Por revision';
  
  $('#createOrder input[name="productSelect"]:checked').each(function(){
    var p_id = $(this).attr('product_id');
    arrayProduct.push(p_id);
    var p_qty = $("#createOrder #qProduct"+p_id).val();
    arrayQty.push(p_qty);
  })
  
  $.ajax({ // AJAX para guardar la orden en la tabla order.
    type: "POST",
    url: "pages/createOrder",
    data: {
      client_id: $('#createOrder #clientSelect option:selected').attr('client_id'),
      status: orderStatus,
      product_order: arrayProduct,
      product_order_qty: arrayQty
    },
    dataType: "text",
    cache:false,
    success: 
      function (){
        alert('Orden creada satisfactoriamente'); location.reload();
        $.ajax({
          type: "POST",
          url: "pages/timeline",
          data: {
            username: $('#actualUsername').text(),
            action: 'creó una orden nueva',
            object_id: ''
          },
          dataType: "text",
          cache:false,
        })
      }
  });
});

/*------------------Edit order-----------------*/

$('#editOrder .orders').on('click', function(){
  var orderID = $(this).attr('open_id');
  $('#editOrder #'+orderID).slideToggle(200);
});



$('#editOrder #orderEdit').on('click', function(evt){
  var n = $(this).attr('order_number')
  var arrayProduct = [];
  var arrayQty = [];
  $('#editOrder #selectProductOrder'+n+' input[name="productSelect"]:checked').each(function(){
    var p_id = $(this).attr('product_id');
    arrayProduct.push(p_id);
    var p_qty = $("#editOrder #selectProductOrder"+n+" #qProduct"+p_id).val();
    arrayQty.push(p_qty);
  })
  
  $.ajax({ // AJAX para editar la orden en la tabla order.
    type: "POST",
    url: "pages/editOrder",
    data: {
      order_id: $(this).attr('order_id'),
      client_id: $(this).attr('client_id'),
      status: $('#editOrder #inputOrderStatus'+n).val(),
      product_order: arrayProduct,
      product_order_qty: arrayQty
    },
    dataType: "text",
    cache:false,
    success: 
      function (){
        alert('Orden editada satisfactoriamente');
        $.ajax({
          type: "POST",
          url: "pages/timeline",
          data: {
            username: $('#actualUsername').text(),
            action: 'editó la orden',
            object_id: $('#editOrder #orderEdit').attr('order_id')
          },
          dataType: "text",
          cache:false,
        })
      }
  });
  
  
});


/*-----------------Delete product----------------*/

$('#deleteOrder .orders').on('click', function(){
  var orderID = $(this).attr('open_id');
  $('#deleteOrder #'+orderID).slideToggle(200);
});

$('#deleteOrder #orderDelete').on('click', function(){
  var n=$(this).attr('order_number');
  console.log('Orden ID: '+$('#deleteOrder #orderID'+n).text())
  $.ajax({
    type: "POST",
    url: "pages/deleteOrder",
    data: {
      order_id: $('#deleteOrder #orderID'+n).text()
    },
    dataType: "text",
    cache:false,
    success:
      function(){
        alert('Orden eliminada satisfactoriamente');
         $.ajax({
          type: "POST",
          url: "pages/timeline",
          data: {
            username: $('#actualUsername').text(),
            action: 'eliminó la orden',
            object_id: $('#deleteOrder #orderID'+n).text()
          },
          dataType: "text",
          cache:false,
        })
      }
  });
});