<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function does_user_exist($email=NULL)
    {
        $this->db->where('usr_email', $email);
        $query = $this->db->get('users');
        return $query;
    }
}
