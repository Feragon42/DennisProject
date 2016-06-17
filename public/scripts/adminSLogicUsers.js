/*---------------Utility Functions-------------*/

function passMatch () {
  var p = $('#inputPassword').val();
  var p2 = $('#reInputPassword').val();
  var match = false;
  if(p==p2){
    var match = true;
  }
  return match;
}

function inputBlank (zone) {
  var blank = false;
  if($('#'+zone+' input').val()==''){
    blank = true;
  }
  return blank;
}

/*---------------- Create User-----------------*/

$('#passGenerator').on('click', function(evt){
  evt.preventDefault(); //Para evitar que se envie el form
  
  //Algoritmo para crear la contrasena 
  var pass = '';
  var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  
  for(var i=0; i<8; i++)
    pass += possible.charAt(Math.floor(Math.random()*possible.length));
  
  $('#inputPassword').attr('type', 'text');
  $('#inputPassword').val(pass);
  $('#reInputPassword').val(pass);
});

$('#userCreation').on('click', function(evt){
  if(passMatch()){ //Revisar si las contrasenas coinciden
    if(inputBlank('createUser')===false){ //Revisar si no hay campos vacios
      $.ajax({
        type: "POST",
        url: "pages/createUser",
        data: {
          username: $('#inputUser').val(),
          name: $('#inputName').val(),
          email: $('#inputEmail').val(),
          password: $('#inputPassword').val(),
          userType: $('#inputUserType').val()
        },
        dataType: "text",
        cache:false,
        success: 
          function (){alert('Usuario creado satisfactoriamente')}
      });
    }
    else{
      evt.preventDefault();
      alert('No deje campos vacios');
    } 
  }
  else {
    evt.preventDefault();
    alert('Las contrasenas no coinciden');
    
  }  
});

/*------------------Edit User-----------------*/

$('.names').on('click', function(){
  var nameID = $(this).attr('open_id');
  $('#'+nameID).slideToggle(200);
});

$('#editUser #userEdit').on('click', function(evt){
  var n=$(this).attr('user_number'); //Se obtiene el numero del perfil que se esta editando
  var idN = $(this).attr('user_id'); //Se obtiene el id del usuario que se va a editar
  if($('#inputPassword'+n).val()==$('#reInputPassword'+n).val()){ //Verifico si las contrasenas coinciden
    if($('#user'+n+' input').val()!=''){ //Verifico si no hay campos vacios
      $.ajax({
        type: "POST",
        url: "pages/editUser",
        data: {
          user_id: idN,
          username: $('#user'+n+' #inputUser'+n).val(),
          name: $('#user'+n+' #inputName'+n).val(),
          email: $('#user'+n+' #inputEmail'+n).val(),
          password: $('#user'+n+' #inputPassword'+n).val(),
          userType: $('#user'+n+' #inputUserType'+n).val()
        },
        dataType: "text",
        cache:false,
        success: 
          function (){alert('Usuario editado satisfactoriamente')}
      });
    }
    else{
      evt.preventDefault();
      alert('No deje campos vacios');
    }
  }
  else{
    evt.preventDefault();
    alert('Las contrasenas no coinciden');
  }
});

/*-----------------Delete User----------------*/

$('#deleteUser .names').on('click', function(){
  var nameID = $(this).attr('open_id');
  $('#deleteUser #'+nameID).slideToggle(200);
});

$('#deleteUser #userDelete').on('click', function(){
  var n=$(this).attr('user_number');
  $.ajax({
    type: "POST",
    url: "pages/deleteUser",
    data: {
      username: $('#deleteUser #username'+n).text()
    },
    dataType: "text",
    cache:false,
    success:
      function(){alert('Usuario eliminado satisfactoriamente')}
  });
});