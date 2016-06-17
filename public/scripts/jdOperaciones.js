//Edit order
$('.jdOperaciones #orderEdit').on('click', function(evt){
  var n = $(this).attr('order-number')
  var arrayProduct = [];
  var arrayQty = [];
  $('.jdOperaciones #selectProductOrder'+n+' .productID').each(function(){
    var p_id = $(this).attr('product_id');
    arrayProduct.push(p_id);
    var p_qty = $(".jdOperaciones #selectProductOrder"+n+" #qProduct"+p_id).attr('product_quantity');
    arrayQty.push(p_qty);
  })
  
  $.ajax({ // AJAX para editar la orden en la tabla order.
    type: "POST",
    url: "pages/editOrder",
    data: {
      order_id: $(this).attr('order_id'),
      client_id: $(this).attr('client_id'),
      status: 'En Produccion',
      product_order: arrayProduct,
      product_order_qty: arrayQty
    },
    dataType: "text",
    cache:false,
    success: 
      function (){alert('Orden editada satisfactoriamente')}
  });
});

//Delete Order
$('.jdOperaciones #orderDelete').on('click', function(){
  $.ajax({
    type: "POST",
    url: "pages/deleteOrder",
    data: {
      order_id: $(this).attr('order_id')
    },
    dataType: "text",
    cache:false,
    success:
      function(){alert('Orden eliminada satisfactoriamente')}
  });
});

//Print Order 
$(".jdOperaciones .printOrder").click(function(evt) {
    evt.preventDefault();
    var n = $(this).attr('order-number');
    $(".jdOperaciones #order"+n).printThis({
        debug: false
    });
});

