<?php
class Sys_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

	public function get_inbox(){
        $query = $this->db->get('sms_inbox');
        return $query->result_array();
	}   

    public function get_outbox(){
        $query = $this->db->get('sms_outbox');
        return $query->result_array();
    }     
}