<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

	public function sys(){
		$data['Title'] = 'Системен лог';
		$data['Description'] = 'Системен лог :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('logs/log');
        $this->load->view('templates/footer');
	}

	public function in(){
		$data['Title'] = 'Входящи логове';
		$data['Description'] = 'Входящи логове :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('logs/in-log');
        $this->load->view('templates/footer');
	}	

	public function out(){
		$data['Title'] = 'Изходящи логове';
		$data['Description'] = 'Изходящи логове :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('logs/out-log');
        $this->load->view('templates/footer');
	}
}
