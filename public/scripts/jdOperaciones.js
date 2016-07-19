//Edit order
$('.jdPlanta #orderEdit').on('click', function(evt){
  var n = $(this).attr('order-number')
  var arrayProduct = [];
  var arrayQty = [];
  $('.jdPlanta #selectProductOrder'+n+' input[name="productSelect"]:checked').each(function(){
    var p_id = $(this).attr('product_id');
    arrayProduct.push(p_id);
    var p_qty = $(".jdPlanta #selectProductOrder"+n+" #qProduct"+p_id).val();
    arrayQty.push(p_qty);
    console.log('Tenemos '+p_qty+' de '+p_id)
  })
  
  $.ajax({ // AJAX para editar la orden en la tabla order.
    type: "POST",
    url: "pages/editOrder",
    data: {
      order_id: $(this).attr('order_id'),
      client_id: $(this).attr('client_id'),
      status: 'Revisado',
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
            action: 'aprobó la orden',
            object_id: $('.jdPlanta #orderEdit').attr('order_id')
          },
          dataType: "text",
          cache:false,
        })
      }
  });
});

//Delete order
$('.jdPlanta #orderDelete').on('click', function(){
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
        alert('Orden eliminada satisfactoriamente')
        $.ajax({
          type: "POST",
          url: "pages/timeline",
          data: {
            username: $('#actualUsername').text(),
            action: 'eliminó la orden',
            object_id: $('.jdPlanta #orderDelete').attr('order_id')
          },
          dataType: "text",
          cache:false,
        })
      }
  });
});