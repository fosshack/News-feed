<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

 	function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->view('session_check');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $this->load->model('User_model', '', True);
        $this->load->model('Data_model', '', True);
        $this->load->helper('security');
    }


	public function index()
	{
        redirect('home/news');
	}

    public function search()
    {
        if($this->input->get())
        {
            $query = $this->input->get('q');
            $data['news_data'] = $this->Data_model->searchNews($query);

            foreach ($data['news_data'] as $key => $value) {
               $data['news_data'][$key]['up_vote'] = $this->_getupvotes($value['object_id']);
               $data['news_data'][$key]['down_vote'] = $this->_getdownvotes($value['object_id']);
            }

            usort($data['news_data'], function ($a, $b) { return $b['up_vote'] - $a['up_vote']; });


            $data['search_term'] = htmlspecialchars($query);
            $this->load->view('header');
            $this->load->view('home/search',$data);
            $this->load->view('footer');
        }
    }
    public function upvoted()
    {

            $data['news_data'] = $this->Data_model->userUpvotes();



            foreach ($data['news_data'] as $key => $value) {
               $data['news_data'][$key]['up_vote'] = $this->_getupvotes($value['object_id']);
               $data['news_data'][$key]['down_vote'] = $this->_getdownvotes($value['object_id']);
            }

            usort($data['news_data'], function ($a, $b) { return $b['up_vote'] - $a['up_vote']; });


            $this->load->view('header');
            $this->load->view('home/upvoted',$data);
            $this->load->view('footer');
        
    }

    public function news()
    {

        $config = array();
        $config["base_url"] = base_url() . "home/news";
        $config["total_rows"] = $this->Data_model->record_count();
        //print_r($config["total_rows"]);
        $config["per_page"] = 7;
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
        $data["news_data"] = $this->Data_model->
        fetch_news($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        foreach ($data['news_data'] as $key => $value) {
           $data['news_data'][$key]['up_vote'] = $this->_getupvotes($value['object_id']);
           $data['news_data'][$key]['down_vote'] = $this->_getdownvotes($value['object_id']);
        }
        usort($data['news_data'], function ($a, $b) { return $b['up_vote'] - $a['up_vote']; });


        $this->load->view('header');
        $this->load->view('home/index',$data);
        $this->load->view('footer');

    }

    private function _getupvotes($id)
    {
        $this->db->from('tbl_votes');
        $this->db->where('object_id',$id);
        $this->db->where('vote_value',"1");
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _getdownvotes($id)
    {
        $this->db->from('tbl_votes');
        $this->db->where('object_id',$id);
        $this->db->where('vote_value',"2");
        $query = $this->db->get();
        return $query->num_rows();
    }
}
