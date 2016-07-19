
//Funcion para activar todos los campos de la orden para poder editarla.
$('.enableButtons').on('click', function(evt){
  evt.preventDefault();
  var orderNumber = $(this).attr('order-number');
  
  $('#order'+orderNumber+' .editButtons').css('display', 'block');
  $(this).css('display', 'none');
  $('#order'+orderNumber+' input[name="productSelect"] ').attr('disabled', false);
  $('#order'+orderNumber+' .productQty').attr('disabled', false);
})

//Edit order
$('.recepcionista #orderEdit').on('click', function(evt){
  var n = $(this).attr('order-number')
  var arrayProduct = [];
  var arrayQty = [];
  $('.recepcionista #selectProductOrder'+n+' input[name="productSelect"]:checked').each(function(){
    var p_id = $(this).attr('product_id');
    arrayProduct.push(p_id);
    var p_qty = $(".recepcionista #selectProductOrder"+n+" #qProduct"+p_id).val();
    arrayQty.push(p_qty);
  })
  
  $.ajax({ // AJAX para editar la orden en la tabla order.
    type: "POST",
    url: "pages/editOrder",
    data: {
      order_id: $(this).attr('order_id'),
      client_id: $(this).attr('client_id'),
      status: 'Por revision',
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
            object_id: $('.recepcionista #orderEdit').attr('order_id')
          },
          dataType: "text",
          cache:false,
        })
      }
  });
});

//Delete order
$('.recepcionista #orderDelete').on('click', function(){
  var n=$(this).attr('order-number');
  $.ajax({
    type: "POST",
    url: "pages/deleteOrder",
    data: {
      order_id: $(this).attr('order_id')
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
            object_id: $('.recepcionista #orderDelete').attr('order_id')
          },
          dataType: "text",
          cache:false,
        })
      }
  });
});