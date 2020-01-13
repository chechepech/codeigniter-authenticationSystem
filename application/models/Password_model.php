<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Password_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
         $this->load->database();
    }

    public function does_code_match($code=NULL, $email=NULL)
    {
        $query = "SELECT COUNT(*) AS `count` FROM `users` WHERE `usr_pwd_change_code` = ? AND `usr_email` = ? ";
        $res = $this->db->query($query, array($code, $email));
        foreach ($res->result() as $row) {
            $count = $row->count;
        }
        if ($count == 1) {
            return true;
        } else {
            return false;
        }
    }
}
