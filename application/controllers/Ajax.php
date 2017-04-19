<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

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

	public function index()
	{
		$this->load->view('head_tag');
		$this->load->view('home/index');
		$this->load->view('scripts');
	}

    public function fetchData()
    {
        $config = array();
        $config["base_url"] = base_url() . "home";
        $config["total_rows"] = $this->Datamodel->record_count();
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;               
        $config['full_tag_open'] = '<ul class="pagination ">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["news"] = $this->Datamodel->
        fetch_news($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
    }


    public function search()
    {
        $this->load->view('session_check');
        if($this->input->get())
        {

            $value = $this->input->get('query');

            $word1 = 'who knows';
            $word2 = 'from';
            $word3 = 'interested in';


            preg_match("/interested in(.*)/", $value, $results);
            if(!empty($results[1]))
                $hobbies[] = $results[1];
            preg_match("/interested in(.*) from/", $value, $results);
            if(!empty($results[1]))
                $hobbies[] = $results[1];
    
            preg_match("/interested in(.*) who/", $value, $results);
            if(!empty($results[1]))
                $hobbies[] = $results[1];
                 


            preg_match("/from(.*)/", $value, $results);
            if(!empty($results[1]))
                $from[] = $results[1];
            preg_match("/from (.*) who knows/", $value, $results);
            if(!empty($results[1]))
                $from[] = $results[1];
            preg_match("/from (.*) interested in/", $value, $results);
            if(!empty($results[1]))
                $from[] = $results[1];

            
            preg_match("/who knows(.*)/", $value, $results);
            if(!empty($results[1]))
                $knows[] = $results[1];
            preg_match("/who knows (.*) from/", $value, $results);
            if(!empty($results[1]))
                $knows[] = $results[1];
            preg_match("/who knows (.*) interested in/", $value, $results);
            if(!empty($results[1]))
                $knows[] = $results[1];


            $from = !empty($from)?$this->_correctval($from):'';
            $knows = !empty($knows)?$this->_correctval($knows):'';
            $hobbies = !empty($hobbies)?$this->_correctval($hobbies):'';

            $data['users'] = $this->User_model->intersectQuery($from,$knows,$hobbies);

            $p_arr = (array)$data['users'];

            print_r($p_arr);

        }

    }



	public function register()
	{
		if ($this->input->is_ajax_request())
        {
            
            $this->form_validation->set_rules('full_name', 'Full name', 'required');            
            $this->form_validation->set_rules('username', 'Username', 'alpha_numeric|required|is_unique[tbl_users.username]|min_length[3]|max_length[12]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('cnf_password', 'Retyped Password', 'trim|required|matches[password]');
            $this->form_validation->set_rules('user_email', 'Email', 'required|valid_email|is_unique[tbl_users.user_email]');
            
            if ($this->form_validation->run() == False)
            {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => validation_errors()
                ));
                
            }
            else
            {
                $full_name = $this->input->post('full_name');
                $username   = $this->input->post('username');
                $user_email      = $this->input->post('user_email');
                $password   = $this->input->post('password');
                
                
                $data_array = array(
                    'full_name' => $full_name,
                    'username' => $username,
                    'user_email' => $user_email,
                    'password' => md5($password)
                );
                
                
                $id = $this->User_model->addUser($data_array);
                
                $data['id'] = $id;
                
                if ($id)
                {
                    $sess_array = array();
                    
                    $sess_array = array(
                        'id' => $id,
                        'username' => $username
                    );
                    
                    $this->session->set_userdata('logged_in', $sess_array);
                    echo json_encode(array(
                        'status' => 'ok',
                        'details' => $sess_array
                    ));
                }
            }
            
        }
	}

   public function login()
    {
        if ($this->input->is_ajax_request())
        {            
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
            
            if ($this->form_validation->run() == False)
            {
                echo json_encode(array(
                        'status' => 'fail',
                        'message' => validation_errors()
                    ));
            }
            else
            {
                echo json_encode(array(
                        'status' => 'ok'
                    ));
            }
        }
    }

   
    function check_database($password)
    {
        $username = $this->input->post('username');
        
        $result = $this->User_model->login($username, $password);
        
        if ($result)
        {
            $sess_array = array();
            foreach ($result as $row)
            {
                $sess_array = array(
                    'uid' => $row->uid,
                    'username' => $row->username,
                    'admin' => $row->is_admin,
                    'avatar' =>$row->avatar
                );
                $this->session->set_userdata('logged_in', $sess_array);   
             
            }
            return True;
        }
        else
        {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return False;
        }
    }

    public function vote($p)
    {
        if ($this->input->is_ajax_request())
        {
            $uid = $this->session->userdata('logged_in')['uid'];
            $id = NULL;
            if($p == "up")
            {
                $object_id = $this->input->post('object_id');
                 $data_array = array(
                    'object_id' => $object_id,
                    'uid' => $uid,
                    'vote_value' => '1'
                );                
                
                $id = $this->User_model->vote($data_array);
            }
            else if($p == "down")
            {
                $object_id = $this->input->post('object_id');
                 $data_array = array(
                    'object_id' => $object_id,
                    'uid' => $uid,
                    'vote_value' => '2'
                );                
                
                $id = $this->User_model->vote($data_array);
            }
            else{
                echo json_encode(array(
                        'status' => 'fail',
                        'message' => 'Something Went Wrong!!'
                    ));
            }

            if($id){
                echo json_encode(array(
                        'status' => 'ok'
                    ));
             
            }
            else
            {
                echo json_encode(array(
                        'status' => 'fail',
                        'message' => 'Something Went Wrong!!'
                    ));
            }
        }
    
    }
}
