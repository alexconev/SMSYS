<?php
class Sms_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

	public function get_inbox($nPerPage = 14){
        
        $page = $this->uri->segment(3) == 'page' ? $this->uri->segment(4) : 1 ;

        $query = $this->db->limit($nPerPage, ($page-1)*$nPerPage)->get('sms_inbox');
        return $query->result_array();
	}   

    public function get_inbox_cnt(){
        $query = $this->db->select('count(ID) as cnt')->get('sms_inbox');
        $res = $query->row_array();
        return (int)$res['cnt'];
    }       

    public function get_outbox($nPerPage = 14){

        $page = $this->uri->segment(3) == 'page' ? $this->uri->segment(4) : 1 ;

        $query = $this->db->limit($nPerPage, ($page-1)*$nPerPage)->get('sms_outbox');
        return $query->result_array();
    }  

    public function get_outbox_cnt(){
        $query = $this->db->select('count(ID) as cnt')->get('sms_outbox');
        $res = $query->row_array();
        return (int)$res['cnt'];
    }            
}