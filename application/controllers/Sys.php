<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sys extends CI_Controller {

	private $nPerPage = 15;

	public function __construct(){
        parent::__construct();
        $this->load->model('sys_model');
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

	public function info(){
		$head['Title'] = 'Информация за системата';
		$head['Description'] = 'Информация за системата :: SMSYS';
		$head['arCss'][] = 'static/css/form.css';

        $this->load->view('templates/header', $head);
        $this->load->view('system/info');
        $this->load->view('templates/footer');
	}

	public function status(){
		require_once('smsys_core/network.php');
		$t = new Network();
		echo $t->getJSONState();
	}

	public function loadsms(){
		require_once('smsys_core/sms.php');
		SMScore::getSMS();
	}

	public function statistics(){
		$head['Title'] = 'Статистика днес';
		$head['Description'] = 'Статистика днес :: SMSYS';

		$data['arData'] = $this->sys_model->get_stats();

        $this->load->view('templates/header', $head);
        $this->load->view('system/stats', $data);
        $this->load->view('templates/footer');
	}	

	public function log(){
		$head['Title'] = 'Системен лог';
		$head['Description'] = 'Системен лог :: SMSYS';
		$head['arCss'][] = 'static/css/list.css';

		$data['logs'] = $this->sys_model->get_logs($this->nPerPage);
		$data['paging'] = $this->getPaging($this->sys_model->get_logs_cnt(), base_url().'sys/log/page/');

        $this->load->view('templates/header', $head);
        $this->load->view('system/log', $data);
        $this->load->view('templates/footer');
	}	
}
