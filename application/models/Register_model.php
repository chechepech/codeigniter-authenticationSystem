<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model {
  function __construct() {
    parent::__construct();
     $this->load->database();
  }
  
  public function register_user($data = NULL) {
    if ($this->db->insert('users', $data)) {
      return true;
    } else {
      return false;
    }
  }
}