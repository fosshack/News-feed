<?php
Class Data_model extends CI_Model
{

    public function fetch_news($limit, $start) 
    {
        $this->db->limit($limit, $start);
        $this->db->from("tbl_news");
        $query = $this->db->get();
        return $query->result_array();
    }

    function record_count() {
        return $this->db->count_all('tbl_news');
    }

    function searchNews($q) {
        
        $this->db->like('message', $q);
        $this->db->or_like('description', $q);
        $this->db->from('tbl_news');
        $query = $this->db->get();
        return $query->result_array();
        
    }

    function userUpvotes() {
        
        $uid = $this->session->userdata('logged_in')['uid'];
        $this->db->from('tbl_votes');
        $this->db->where('uid',$uid);
        $this->db->join('tbl_news', 'tbl_news.object_id = tbl_votes.object_id');      
        $query = $this->db->get();

        return $query->result_array();

        
    }

}
