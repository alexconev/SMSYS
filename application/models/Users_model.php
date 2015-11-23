<?php
class Users_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

  	public function get_users($nPerPage = 14){
          
          $page = $this->uri->segment(3) == 'page' ? $this->uri->segment(4) : 1 ;

          $query = $this->db->limit($nPerPage, ($page-1)*$nPerPage)
                            ->order_by('Name Asc, Family Asc')->get('users');
          return $query->result_array();
  	}   

    public function get_users_cnt(){
        $query = $this->db->select('count(ID) as cnt')->get('users');
        $res = $query->row_array();
        return (int)$res['cnt'];
    }                  
}