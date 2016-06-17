<?php
  class Admin_functions{
    
    public function showData($table){
      $t =& get_instance();
      $t->load->model('admin_querys');
      $infoArray = $t->admin_querys->extractInfo($t->admin_querys->extractLength($table), $table);
      return $infoArray;
    }
    
    public function takeTableLength($table){
      $t =& get_instance();
      $t->load->model('admin_querys');
      $l = $t->admin_querys->extractLength($table);
      return $l;
    }
    
    /*----------------------------Funciones para completar la informacion de las ordenes----------------------------------*/
    public function retrieveInfoOrders ($table, $select, $whereQuery1, $whereQuery2){ //SELECT $select FROM $table WHERE $whereQuery1 = $whereQuery2
      $t =& get_instance();
      $t->load->model('admin_querys');
      $info = $t->admin_querys->retrieveInfo($table, $select, $whereQuery1, $whereQuery2);
      return $info;
    }
  }
?>