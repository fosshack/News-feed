<?php
Class User_model extends CI_Model
{
    function login($username, $password)
    {
        $this->db->select('uid, username, password,is_admin,avatar');
        $this->db->from('tbl_users');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() == 1)
            return $query->result();
        
        return False;
    }
    
    function addUser($data)
    {
        $this->db->insert('tbl_users', $data);
        return $this->db->insert_id();
    }

    function vote($data)
    {
        $this->db->insert('tbl_votes', $data);
        return $this->db->insert_id();
    }

    function getUserDataById($userId)
    {
        $this->db->where('uid', $userId);
        $query = $this->db->get('tbl_users');
        return $query->result_array();
    }
    
  
    function searchUsers($data)
    {
        $this->db->like('first_name', $data);
        $this->db->or_like('last_name', $data);
        $this->db->or_like('full_name', $data);
        $this->db->or_like('username', $data);
        $query = $this->db->get('tbl_users');
        return $query->result();
    }


    function getAllUsers()
    {
        $query = $this->db->get('tbl_users');
        return $query->result();
    }
    
    function getuid($username)
    {
        return $this->db->select('uid')->get_where('tbl_users', array('username' => $username))->row()->uid;
    } 

    function intersectQuery($from,$knows,$hobbies)
    {
        if(strlen($from) != 0)
        {
            $this->db->like('places',$from);
        }

        if(strlen($knows) != 0)
        {
            $k_nows = explode(" ", trim($knows));
            if(is_array($k_nows)){
                foreach ($k_nows as $key => $value) {
                    $this->db->or_like('places', $value);
                    $this->db->or_like('medical', $value);
                    $this->db->or_like('orgs', $value);
                    $this->db->or_like('skills', $value);
                    $this->db->or_like('political', $value);
                    $this->db->or_like('business', $value);
                }
            }
        }
        if(strlen($hobbies) != 0)
        {
            $hob_ies = explode(" ", trim($hobbies));
            if(is_array($hob_ies)){
                foreach ($hob_ies as $key => $value) {
                    $this->db->or_like('hobbies', $value);
                }
            }
        }

        $this->db->from('tbl_rdata');
        $this->db->join('tbl_users', 'tbl_rdata.uid = tbl_users.uid');      
        $query = $this->db->get();
        //return $hob_ies;
        return $query->result();
    }

    function getuserDetails($data)
    {
        $this->db->where('username', $data);
        $query = $this->db->get('tbl_users');
        return $query->result();
    }

    function updateProfile($p, $data)
    {
        $this->db->where('uid',$p);
        $q = $this->db->get('tbl_rdata');
        if ( $q->num_rows() > 0 ) 
        {
            $this->db->where('uid', $p);
            return $this->db->update('tbl_rdata', $data);
        }
        else{
            $data['uid'] = $p;
            $this->db->insert('tbl_rdata', $data);
            return $this->db->insert_id();
        }
    }

    function getProfileData($p)
    {
        $this->db->where('uid', $p);
        $query = $this->db->get('tbl_rdata');
        return $query->result();

    }
}
