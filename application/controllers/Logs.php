<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

	public function sys(){
		$data['Title'] = 'Системен лог';
		$data['Description'] = 'Системен лог :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('sms/log');
        $this->load->view('templates/footer');
	}

	public function in(){
		$data['Title'] = 'Входящи логове';
		$data['Description'] = 'Входящи логове :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('sms/in-log');
        $this->load->view('templates/footer');
	}	

	public function out(){
		$data['Title'] = 'Изходящи логове';
		$data['Description'] = 'Изходящи логове :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('sms/out-log');
        $this->load->view('templates/footer');
	}
}
