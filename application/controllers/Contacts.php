<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

	private $nPerPage = 14;

	public function __construct(){
        parent::__construct();
        $this->load->model('contacts_model');
        $this->load->helper(array('form', 'url'));
    }

    public function getPaging($nCnt, $strBaseUrl){
    	$nSpread = 2;

        $page = $this->uri->segment(3) == 'page' ? $this->uri->segment(4) : 1 ;

        $htmlPaging = '';
        if($nCnt > $this->nPerPage){
	        $htmlPaging = '<div class="paging">';
	        if($page != 1)$htmlPaging .= '<a href="'.$strBaseUrl.'1"><<</a>';
	    	for($i = $page-$nSpread; $i <= $page+$nSpread; $i++){
	    		if( $i > 0 && $i <= ceil($nCnt/$this->nPerPage) ){
	    			if($i != $page) $htmlPaging .= '<a href="'.$strBaseUrl.$i.'">'.$i.'</a>';
	    			else $htmlPaging .= '<span>'.$i.'</span>';
	    		}
	    	}
	    	if($page != ceil($nCnt / $this->nPerPage)) $htmlPaging .= '<a href="'.$strBaseUrl.ceil($nCnt / $this->nPerPage).'">>></a>';
	    	$htmlPaging .= '</div>';
	    }
    	return $htmlPaging;
    }

	public function phonebook(){
		$head['Title'] = 'Номера';
		$head['Description'] = 'Номера :: SMSYS';

		$data['contacts'] = $this->contacts_model->get_contacts($this->nPerPage);
		$data['paging'] = $this->getPaging($this->contacts_model->get_contacts_cnt(), base_url().'contacts/phonebook/page/');

        $this->load->view('templates/header', $head);
        $this->load->view('contacts/phonebook', $data);
        $this->load->view('templates/footer');
	}

    public function delphone($id){        
        $this->db->where('id', $id)->delete('phonebook'); 
        redirect('/contacts/phonebook');  
    }

	public function groups(){
		$head['Title'] = 'Групи';
		$head['Description'] = 'Групи :: SMSYS';

		$data['groups'] = $this->contacts_model->get_groups($this->nPerPage);
		$data['paging'] = $this->getPaging($this->contacts_model->get_groups_cnt(), base_url().'contacts/groups/page/');

        $this->load->view('templates/header', $head);
        $this->load->view('contacts/groups', $data);
        $this->load->view('templates/footer');
	}	

	public function import(){
		$head['Title'] = 'Импорт';
		$head['Description'] = 'Импорт :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $head);
        $this->load->view('contacts/import', array('error' => ' ' ));
        $this->load->view('templates/footer');
	}	

	public function do_import(){
		$head['Title'] = 'Импорт';
		$head['Description'] = 'Импорт :: SMSYS';

        $config['upload_path']          = '/srv/http/static/uploads/';
        $config['allowed_types']        = 'vcf';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('filepath')){
                $error = array('error' => $this->upload->display_errors());
        		$this->load->view('templates/header', $head);
        		$this->load->view('contacts/import', $error);
        		$this->load->view('templates/footer');                
        }
        else
        {
                $data = array('upload_data' => $this->upload->data());
                require_once('smsys_core/contacts.php');
                $pCont = new ContactsMan();
                $pCont->importContacts($data["upload_data"]["full_path"]);
                redirect('/contacts/phonebook');
        }
    }	

	public function contform(){
		$head['Title'] = 'Импорт';
		$head['Description'] = 'Импорт :: SMSYS';
		$this->load->helper('url');

        $id = $this->uri->segment(3);
        $data = $this->db->get_where('phonebook', array('id' => $id))->row();

        $this->load->view('templates/header', $head);
        $this->load->view('contacts/contactform', $data);
        $this->load->view('templates/footer');
	}	

	public function groupsform(){
		$data['Title'] = 'Импорт';
		$data['Description'] = 'Импорт :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('contacts/groupsform');
        $this->load->view('templates/footer');
	}

}
