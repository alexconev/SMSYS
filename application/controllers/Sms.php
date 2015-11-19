<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {

	private $nPerPage = 14;

	public function __construct(){
        parent::__construct();
        $this->load->model('sms_model');
        $this->load->helper('url');
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

	public function inbox(){
		$head['Title'] = 'Входяща поща';
		$head['Description'] = 'Входяща поща :: SMSYS';

		$data['inbox'] = $this->sms_model->get_inbox($this->nPerPage);
		$data['paging'] = $this->getPaging($this->sms_model->get_inbox_cnt(), base_url().'sms/inbox/page/');

        $this->load->view('templates/header', $head);
        $this->load->view('sms/inbox', $data);
        $this->load->view('templates/footer');
	}

	public function outbox(){
		$head['Title'] = 'Изходяща поща';
		$head['Description'] = 'Изходяща поща :: SMSYS';

		$data['outbox'] = $this->sms_model->get_outbox($this->nPerPage);
		$data['paging'] = $this->getPaging($this->sms_model->get_outbox_cnt(), base_url().'sms/inbox/page/');

        $this->load->view('templates/header', $head);
        $this->load->view('sms/outbox', $data);
        $this->load->view('templates/footer');
	}	

	public function send(){
		$data['Title'] = 'Изпрати SMS';
		$data['Description'] = 'Изпрати SMS :: SMSYS';

        $this->load->view('templates/header', $data);
        $this->load->view('sms/send');
        $this->load->view('templates/footer');
	}	
}
