<?php
  
  class User_database extends CI_Model {
    
    //Leer la  data usando el username y pass
    public function login($data){
      
      $condition = "username = '" . $data['username'] . "' AND  password = '" . $data['password'] . "'";
      $this->db->select('*');
      $this->db->from('user');
      $this->db->where($condition);
      $this->db->limit(1);
      $query = $this->db->get();
      
      if($query->num_rows()==1){
        return TRUE;
      }
      else{
        return FALSE;
      }

    }
    
    public function extractUserInfo($data){
      $condition = "username = '" . $data['username'] . "'";
      $this->db->select('*');
      $this->db->from('user');
      $this->db->where($condition);
      $this->db->limit(1);
      $query = $this->db->get();
      foreach($query->result_array() as $qarray){}
      return $qarray;
    }
    
  }

?>