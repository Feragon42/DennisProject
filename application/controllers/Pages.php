<?php
  class Pages extends CI_Controller{
    
    public function view ($page='login'){ //Funcion para cargar y redireccionar paginas.
      if( ! file_exists(APPPATH.'views/pages/'.$page.'.php')){
        show_404();
      }
      
      //Seleccion de titulo:
      if($page=='login'){
        $data['title'] = 'Inicio';
      }
      if($page=='admin'){
        $data['title'] = 'Panel de Administrador';
      }
      if($page=='recepcionista'){
        $data['title'] = 'Panel de Creacion de Ordenes';
      }
      if($page=='jdPlanta'){
        $data['title'] = 'Panel de Jefe de Planta';     
      }
      if($page=='jdOperaciones'){
        $data['title'] = 'Panel de Jefe de Operaciones';     
      }
      if($page=='redirect'){
        $data['title'] = 'Redireccionando';
      }
      if($page=='redirectout'){
        $data['title'] = 'Cerrando Sesion';
      }
      
      //Cargar pagina:
      $this->load->helper('url'); //Se carga el ayudante para poder usar el redireccionamiento.     
      $this->load->view('templates/header', $data); //Se carga el header (Logo de indotel). 
      if($page=='login'){ //Se carga el menu con los datos de login, pero solo si es la pagina de login.
        $this->load->view('templates/tempMenu', $data); 
      }
      if($page!='login' && $page!='redirect' && $page!='redirectout'){ //Se carga la etiqueta donde saluda al usuario, solo si es una pagina de usuario.
        $this->load->view('templates/inHeader', $data);

      }
      $this->load->view('pages/'.$page, $data); //Se carga la pagina como tal, obtenida por la variable $page que se pasa al usar la funcion.
      if($page=='recepcionista'){ //Se cargan los diferentes modelos, dependiendo del usuario que ingrese.
        $this->load->view('modals/adminModals/createOrder', $data);
      }
      $this->load->view('modals/adminModals/statistics', $data);
      if($page=='admin'){
        $this->load->view('modals/adminModals/createUser', $data);
        $this->load->view('modals/adminModals/createClient', $data);
        $this->load->view('modals/adminModals/editUser', $data);
        $this->load->view('modals/adminModals/editClient', $data);
        $this->load->view('modals/adminModals/deleteUser', $data);
        $this->load->view('modals/adminModals/deleteClient', $data);
        $this->load->view('modals/adminModals/createProduct', $data);
        $this->load->view('modals/adminModals/createOrder', $data);
        $this->load->view('modals/adminModals/editProduct', $data);
        $this->load->view('modals/adminModals/editOrder', $data);
        $this->load->view('modals/adminModals/deleteProduct', $data);
        $this->load->view('modals/adminModals/deleteOrder', $data);
        
      }  
      $this->load->view('templates/footer', $data); //Se carga el footer, independientemente del usuario.
    }
    
    public function exLogin ($data){ //Funcion que ejecuta el metodo login() alojado en el model/User_Database.
      $this->load->model('user_database');
      return $this->user_database->login($data);
    }
    
    public function redirectPage ($data, $loginData){ //Funcion que redirecciona a cada pagina dependiendo del usuario registrado.
      $this->load->helper('url'); //Se carga el ayudante para las redirecciones.
      $this->load->library('session'); //Se carga la libreria de las sesiones.
      if($loginData == TRUE){ //Se ve si se realizo un login correcto (Usuario y contrasena coinciden).
        $x = $this->user_database->extractUserInfo($data); //Se usa el metodo de model/user_database para extraer la informacion de usuario de la base de datos.
        if($x['status']=='Activo'){//Se comprueba si el usuario esta activo
          if($x['userType']=='Administrador'){ //Se redirecciona a la pagina correspondiente segun el usuario registrado.
            echo "<script> window.location.href='".base_url()."admin' </script>";
          }
          if($x['userType']=='Recepcionista'){
            echo "<script> window.location.href='".base_url()."recepcionista' </script>";
          }
          if($x['userType']=='Jefe de Planta'){
            echo "<script> window.location.href='".base_url()."jdPlanta' </script>";
          }
          if($x['userType']=='Jefe de Operaciones'){
            echo "<script> window.location.href='".base_url()."jdOperaciones' </script>";
          }
          $this->session->set_userdata($x); //Se crea la sesion con la informacion extraida de la base de datos.
        }
        else{
          echo "<script> alert ('El Usuario esta inactivo. Contacte con administrador') 
            window.location.href='".base_url()."'
          </script>";
        }
      }
      else{ //Muestra un aviso de error si no hay un login, y se redirecciona a la pagina de login.
        echo "<script> alert ('Error al iniciar sesion') 
          window.location.href='".base_url()."'
        </script>";
      }

    }
    
    public function logout(){ //Funcion que destruye el array asociativo de la sesion (Cierra la sesion), y redirecciona a login.
      $this->load->library('session');
      $this->session->sess_destroy();
      echo "<script> window.location.href='".base_url()."' </script>";
    }
    
    public function takeSessionInfo (){ //Funcion que extrae los datos alojados en el array asociativo de la sesion. Utilizada en inHeader.
      $CI =& get_instance();
      $CI->load->library('session');
      $uData = $CI->session->all_userdata();
      if($uData['user_id']==''){
        echo "<script> alert ('Error. No hay ninguna sesion abierta.') 
          window.location.href='".base_url()."'
        </script>";
      }
      return $uData;
    }
    
    //------------------------------------------Funciones para cargar usuarios------------------------------------------//
    
    public function createUser (){ //Llamado a la funcion para crear un usuario desde admin, alojada en admin_querys.php
      $this->load->model('admin_querys');
      $this->admin_querys->userCreation($_POST);
    }
    
    public function editUser (){ //Llamado a la funcion para editar un usuario desde admin, alojada en admin_querys.php
      $this->load->model('admin_querys');
      $this->admin_querys->userEdition($_POST);
    }
    
    public function deleteUser (){ //Llamado a la funcion para eliminar un usuario desde admin, alojada en admin_querys.php
      $this->load->model('admin_querys');
      $this->admin_querys->userDeleting($_POST);
    }
    
    //------------------------------------------Funciones para cargar clientes------------------------------------------//
    
    public function createClient (){ //Llamado a la funcion para crear un cliente desde admin, alojada en admin_querys.php
      $this->load->model('admin_querys');
      $this->admin_querys->clientCreation($_POST);
    }
    
    public function editClient (){ //Llamado a la funcion para crear un cliente desde admin, alojada en admin_querys.php
      $this->load->model('admin_querys');
      $this->admin_querys->clientEdition($_POST);
    }
    
    public function deleteClient (){ //Llamado a la funcion para eliminar un cliente desde admin, alojada en admin_querys.php
      $this->load->model('admin_querys');
      $this->admin_querys->clientDeleting($_POST);
    }
    
    //------------------------------------------Funciones para cargar Productos------------------------------------------//
    
    public function createProduct (){ //Llamado a la funcion para crear un prodductp desde admin, alojada en admin_querys.php
      $this->load->model('admin_querys');
      $this->admin_querys->productCreation($_POST);
    }
    
    public function editProduct (){ //Llamado a la funcion para crear un prodductp desde admin, alojada en admin_querys.php
      $this->load->model('admin_querys');
      $this->admin_querys->productEdition($_POST);
    }
    
    public function deleteProduct (){ //Llamado a la funcion para eliminar un producto desde admin, alojada en admin_querys.php
      $this->load->model('admin_querys');
      $this->admin_querys->productDeleting($_POST);
    }
    
    //------------------------------------------Funciones para cargar Ordenes--------------------------------------------//
    
    public function createOrder (){ //Llamado a la funcion para crear una orden desde admin, alojada en admin_querys.php
      $this->load->model('admin_querys');
      $this->admin_querys->orderCreation($_POST);
    }
    
    public function editOrder (){ //Llamado a la funcion para crear una orden desde admin, alojada en admin_querys.php
      $this->load->model('admin_querys');
      $this->admin_querys->orderEdition($_POST);
    }
    
    public function deleteOrder (){ //Llamado a la funcion para eliminar una orden desde admin, alojada en admin_querys.php
      $this->load->model('admin_querys');
      $this->admin_querys->orderDeleting($_POST);
    }
    
    public function completeOrder (){ //Llamado a la funcion para eliminar una orden desde admin, alojada en admin_querys.php
      $this->load->model('admin_querys');
      $this->admin_querys->orderComplete($_POST);
    }
    
    public function showProductOrder (){ //Funcion para obtener los productos emparejados con el cliente respectivo
      $this->load->model('admin_querys');
      header('Content-Type: application/json');
      echo json_encode($this->admin_querys->takeAllProductForClient($_POST), JSON_FORCE_OBJECT);
    }
  }
?>