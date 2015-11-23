<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

	private $nPerPage = 15;

	public function __construct(){
        parent::__construct();
        $this->load->model('contacts_model');
        $this->load->helper(array('form', 'url'));
    }

    private function getPaging($nCnt, $strBaseUrl){
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
        $head['arCss'][] = 'static/css/list.css';

		$data['contacts'] = $this->contacts_model->get_contacts($this->nPerPage);
		$data['paging'] = $this->getPaging($this->contacts_model->get_contacts_cnt(), base_url().'contacts/phonebook/page/');

        $this->load->view('templates/header', $head);
        $this->load->view('contacts/phonebook', $data);
        $this->load->view('templates/footer');
	}

    public function addphone($err = ''){
        $head['Title'] = 'Добавя на контакт';
        $head['Description'] = 'Добавя на контакт :: SMSYS';
        $head['arCss'][] = 'static/css/form.css';

        $data['arGroups'] = $this->contacts_model->GetDropDownGr();
        $data['error'] = $err;

        $this->load->view('templates/header', $head);
        $this->load->view('contacts/contactform', $data);
        $this->load->view('templates/footer');
    }

    public function editphone($id,$err = ''){
        $head['Title'] = 'Редакция на контакт';
        $head['Description'] = 'Редакция на контакт :: SMSYS';
        $head['arCss'][] = 'static/css/form.css';

        $phone = $this->db->get_where('phonebook', array('id' => $id))->row();
        if($phone) $data = json_decode(json_encode($phone),true);

        $data['arGroups'] = $this->contacts_model->GetDropDownGr();
        $data['error'] = $err;

        $this->load->view('templates/header', $head);
        $this->load->view('contacts/contactform', $data);
        $this->load->view('templates/footer');
    }

    public function savephone(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('Phone', 'Номер', 'required');
        $this->form_validation->set_rules('Name', 'Име', 'required');

        if ($this->form_validation->run() == FALSE){
            if($this->input->post('ID') == FALSE) 
                $this->addphone(validation_errors());
            else 
                $this->editphone($this->input->post('ID'), validation_errors());
        } else {
            $data = array(
                'Name' => $this->input->post('Name'),
                'Phone' => $this->input->post('Phone'),
                'GroupID' => $this->input->post('GroupID')
            );

            if($this->input->post('ID') == FALSE) 
                $this->db->insert('phonebook', $data);
            else {
                $this->db->where('ID', $this->input->post('ID'));
                $this->db->update('phonebook', $data);
            }
            redirect('/contacts/phonebook');
        }      
    }

    public function delphone($id){        
        $this->db->where('id', $id)->delete('phonebook'); 
        redirect('/contacts/phonebook');  
    }

	public function groups(){
		$head['Title'] = 'Групи';
		$head['Description'] = 'Групи :: SMSYS';
        $head['arCss'][] = 'static/css/list.css';

		$data['groups'] = $this->contacts_model->get_groups($this->nPerPage);
		$data['paging'] = $this->getPaging($this->contacts_model->get_groups_cnt(), base_url().'contacts/groups/page/');

        $this->load->view('templates/header', $head);
        $this->load->view('contacts/groups', $data);
        $this->load->view('templates/footer');
	}	

    public function addgroup($err = ''){
        $head['Title'] = 'Добавяне на група';
        $head['Description'] = 'Добавяне на група :: SMSYS';
        $head['arCss'][] = 'static/css/form.css';

        $data['error'] = $err;

        $this->load->view('templates/header', $head);
        $this->load->view('contacts/groupform', $data);
        $this->load->view('templates/footer');
    }

    public function editgroup($id,$err = ''){
        $head['Title'] = 'Редакция на група';
        $head['Description'] = 'Редакция на група :: SMSYS';
        $head['arCss'][] = 'static/css/form.css';

        $group = $this->db->get_where('groups', array('id' => $id))->row();
        if($group) $data = json_decode(json_encode($group),true);        
        $data['error'] = $err;

        $this->load->view('templates/header', $head);
        $this->load->view('contacts/groupform', $data);
        $this->load->view('templates/footer');
    }

    public function savegroup(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('Title', 'Номер', 'required');

        if ($this->form_validation->run() == FALSE){
            if($this->input->post('ID') == FALSE) 
                $this->addgroup(validation_errors());
            else 
                $this->editgroup($this->input->post('ID'), validation_errors());
        } else {
            $data = array(
                'Title' => $this->input->post('Title'),
                'Description' => $this->input->post('Description')
            );

            if($this->input->post('ID') == FALSE) 
                $this->db->insert('groups', $data);
            else {
                $this->db->where('ID', $this->input->post('ID'));
                $this->db->update('groups', $data);
            }
            redirect('/contacts/groups');
        }      
    }

    public function delgroup($id){        
        $this->db->where('id', $id)->delete('groups'); 
        redirect('/contacts/groups');  
    }    

	public function import(){
		$head['Title'] = 'Импорт';
		$head['Description'] = 'Импорт :: SMSYS';
		$head['arCss'][] = 'static/css/form.css';

        $this->load->view('templates/header', $head);
        $this->load->view('contacts/import', array('error' => ' ' ));
        $this->load->view('templates/footer');
	}	

    public function export(){
        require_once('smsys_core/contacts.php');
        $pCont = new ContactsCore();
        $pCont->exportContacts();
    }

	public function doimport(){

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
                $pCont = new ContactsCore();
                $pCont->importContacts($data["upload_data"]["full_path"]);
                redirect('/contacts/phonebook');
        }
    }	
}
