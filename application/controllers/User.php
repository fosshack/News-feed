<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

 	function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $this->load->model('User_model', '', True);
        $this->load->model('Data_model', '', True);
        $this->load->helper('security');
    }


	public function login()
	{
        $this->load->view('walkover');
		$this->load->view('user/login');
		
	}

    public function register()
    {
        $this->load->view('walkover');
        $this->load->view('user/register');
    }
    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center" role="alert" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> Logged Out Successfully!</div>');
        redirect('user/login', 'refresh');
    }
}
