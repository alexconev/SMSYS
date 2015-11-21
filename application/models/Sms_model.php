<?php
class Sms_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

	public function get_inbox($nPerPage = 14){
        
        $page = $this->uri->segment(3) == 'page' ? $this->uri->segment(4) : 1 ;

        $query = $this->db->select('IFNULL(phonebook.Name, sms_inbox.Sender) AS Sender, sms_inbox.ID, sms_inbox.Content, sms_inbox.Date')
                          ->from('sms_inbox')
                          ->join('phonebook', 'phonebook.Phone LIKE CONCAT("%",SUBSTR(sms_inbox.Sender,5,9))', 'left')
                          ->limit($nPerPage, ($page-1)*$nPerPage)
                          ->order_by('sms_inbox.Date', "DESC")->get();
        return $query->result_array();
	}   

    public function get_inbox_cnt(){
        $query = $this->db->select('count(ID) as cnt')->get('sms_inbox');
        $res = $query->row_array();
        return (int)$res['cnt'];
    }       

    public function get_outbox($nPerPage = 14){

        $page = $this->uri->segment(3) == 'page' ? $this->uri->segment(4) : 1 ;

        $query = $this->db->select('IFNULL(phonebook.Name, sms_outbox.Recipient) AS Recipient, sms_outbox.ID, sms_outbox.Content, sms_outbox.Date')
                          ->from('sms_outbox')
                          ->join('phonebook', 'phonebook.Phone LIKE CONCAT("%",SUBSTR(sms_outbox.Recipient,5,9))', 'left')
                          ->order_by('sms_outbox.Date', "DESC")
                          ->limit($nPerPage, ($page-1)*$nPerPage)
                          ->order_by('sms_outbox.Date', "DESC")->get();
        return $query->result_array();
    }  

    public function get_outbox_cnt(){
        $query = $this->db->select('count(ID) as cnt')->get('sms_outbox');
        $res = $query->row_array();
        return (int)$res['cnt'];
    }            
}