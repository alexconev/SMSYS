<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {

	private $nPerPage = 15;

	public function __construct(){
        parent::__construct();
        $this->load->model('sms_model');
        $this->load->helper('url');
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

	public function inbox(){
		$head['Title'] = 'Входящи съобщения';
		$head['Description'] = 'Входящи съобщения :: SMSYS';
		$head['arCss'][] = 'static/css/list.css';

		$data['inbox'] = $this->sms_model->get_inbox($this->nPerPage);
		$data['paging'] = $this->getPaging($this->sms_model->get_inbox_cnt(), base_url().'sms/inbox/page/');

        $this->load->view('templates/header', $head);
        $this->load->view('sms/inbox', $data);
        $this->load->view('templates/footer');
	}
    
    public function delin($id){	
		if (empty($id)) show_404();
        $this->db->where('id', $id)->delete('sms_inbox'); 
        redirect('/sms/inbox');  
    }

	public function outbox(){
		$head['Title'] = 'Изходящи съобщения';
		$head['Description'] = 'Изходящи съобщения :: SMSYS';
		$head['arCss'][] = 'static/css/list.css';

		$data['outbox'] = $this->sms_model->get_outbox($this->nPerPage);
		$data['paging'] = $this->getPaging($this->sms_model->get_outbox_cnt(), base_url().'sms/inbox/page/');

        $this->load->view('templates/header', $head);
        $this->load->view('sms/outbox', $data);
        $this->load->view('templates/footer');
	}	

    public function delout($id){ 
    	if (empty($id)) show_404();       
        $this->db->where('id', $id)->delete('sms_outbox'); 
        redirect('/sms/outbox');  
    }

	public function send(){
		$head['Title'] = 'Изпрати SMS';
		$head['Description'] = 'Изпрати SMS :: SMSYS';
		$head['arCss'][] = 'static/css/form.css';
		$head['arJs'][] = 'static/js/sms.js';

		$this->load->helper('form');
		$this->load->model('contacts_model');
		$pContacts = new Contacts_model();
		$data['arConts'] = $pContacts->GetDropDownConts();
		$data['error'] = '';

        $this->load->view('templates/header', $head);
        $this->load->view('sms/send', $data);
        $this->load->view('templates/footer');
	}	

	public function dosend(){

        $this->load->library('form_validation');

        $this->form_validation->set_rules('phone', 'Номер', 'required');
        $this->form_validation->set_rules('Content', 'Съобщение', 'required');

        if ($this->form_validation->run() == FALSE){
            $head['Title'] = 'Изпрати SMS';
			$head['Description'] = 'Изпрати SMS :: SMSYS';
			$head['arCss'][] = 'static/css/form.css';
			$head['arJs'][] = 'static/js/sms.js';

			$this->load->model('contacts_model');
			$pContacts = new Contacts_model();
			$data['arConts'] = $pContacts->GetDropDownConts();
			$data['error'] = $this->upload->display_errors();

	        $this->load->view('templates/header', $head);
	        $this->load->view('sms/send', $data);
	        $this->load->view('templates/footer');			
        } else {
        	require_once('smsys_core/sms.php');
			SMScore::sendSMS($this->input->post('phone'), $this->input->post('Content'));
        	$this->sms_model->send_sms();
            redirect('/sms/outbox');
        }
    }

    public function export(){
        require_once('smsys_core/sms.php');
        $pCont = new SMScore();
        $pCont->exportSMS();
    }
}
