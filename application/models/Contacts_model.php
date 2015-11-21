<?php
class Contacts_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

	public function get_contacts($nPerPage = 14){
        
        $page = $this->uri->segment(3) == 'page' ? $this->uri->segment(4) : 1 ;

        $query = $this->db->select('phonebook.*, IFNULL(groups.Title, \'No Group\') as `Group`')
                          ->from('phonebook')
                          ->join('groups', 'groups.id = phonebook.GroupID', 'left')
                          ->limit($nPerPage, ($page-1)*$nPerPage)
                          ->order_by('Name ASC')->get();
        return $query->result_array();
	}       

    public function get_contacts_cnt(){
        $query = $this->db->select('count(ID) as cnt')->get('phonebook');
        $res = $query->row_array();
        return (int)$res['cnt'];
    }     

    public function get_groups($nPerPage = 14){
        
        $page = $this->uri->segment(3) == 'page' ? $this->uri->segment(4) : 1 ;

        $query = $this->db->limit($nPerPage, ($page-1)*$nPerPage)->get('groups');
        return $query->result_array();
    }       

    public function get_groups_cnt(){
        $query = $this->db->select('count(ID) as cnt')->get('groups');
        $res = $query->row_array();
        return (int)$res['cnt'];
    }    
}