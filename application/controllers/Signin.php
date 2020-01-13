<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends MY_Controller {
  function __construct() {
    parent::__construct();    
  }

  public function index() {
    if ($this->session->userdata('logged_in') == TRUE) {
      if ($this->session->userdata('usr_access_level') == 1) {
        redirect('users');
      } else {
        redirect('me');
      }  
    } else {
      // Set validation rules for view filters
      $this->form_validation->set_rules('usr_email', $this->lang->line('signin_email'), 'required|valid_email|min_length[5]|max_length[100]');
      $this->form_validation->set_rules('usr_password', $this->lang->line('signin_password'), 'required|min_length[5]|max_length[20]');

      if ($this->form_validation->run() == FALSE) {
        $this->load->view('common/login_header');
        $this->load->view('users/signin');
        $this->load->view('common/footer');   
      } else {
        $usr_email = $this->input->post('usr_email');
        $password = $this->input->post('usr_password');

        $this->load->model('Signin_model');
        $query = $this->Signin_model->does_user_exist($usr_email);

        if ($query->num_rows() == 1) { // One matching row found
          foreach ($query->result() as $row) {
            // Call Encrypt library
            $this->load->library('encryption');

            // Generate hash from a their password
            $hash = $password;

            if ($row->usr_is_active != 0) { // See if the user is active or not
              // Compare the generated hash with that in the database
              if ($hash != $this->encryption->decrypt($row->usr_hash)) {
                // Didn't match so send back to login
                $data['login_fail'] = true;
                $this->load->view('common/login_header');
                $this->load->view('users/signin', $data);
                $this->load->view('common/footer'); 
              } else {
                $data = array(
                    'usr_id' => $row->usr_id,
                    'acc_id' => $row->acc_id,
                    'usr_email' => $row->usr_email,
                    'usr_access_level' => $row->usr_access_level,
                    'logged_in' => TRUE
                );

                // Save data to session
                $this->session->set_userdata($data);

                if ($data['usr_access_level'] == 2) {
                  redirect('me');
                } elseif ($data['usr_access_level'] == 1) {
                  redirect('users');
                } else {
                  redirect('me');
                }
              }
            } else {
              // User currently inactive
              redirect('signin');
            }
          }
        } 
      }
    }
  }

  public function signout() {
    $this->session->sess_destroy();
    redirect ('signin');
  }  
}