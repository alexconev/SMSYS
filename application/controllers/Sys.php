<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sys extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('sys_model');
        $this->load->helper('url');
    }	

	public function settings(){
		$data['Title'] = 'Настройки';
		$data['Description'] = 'Настройки :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('system/settings');
        $this->load->view('templates/footer');
	}

	public function statistics(){
		$data['Title'] = 'Статистика днес';
		$data['Description'] = 'Статистика днес :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('system/stats');
        $this->load->view('templates/footer');
	}	

	public function log(){
		$data['Title'] = 'Статистика днес';
		$data['Description'] = 'Статистика днес :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('system/log');
        $this->load->view('templates/footer');
	}	
}
