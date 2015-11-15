<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {

	public function inbox(){
		$data['Title'] = 'Входяща поща';
		$data['Description'] = 'Входяща поща :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('sms/inbox');
        $this->load->view('templates/footer');
	}

	public function outbox(){
		$data['Title'] = 'Изходяща поща';
		$data['Description'] = 'Изходяща поща :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('sms/outbox');
        $this->load->view('templates/footer');
	}	

	public function send(){
		$data['Title'] = 'Изпрати SMS';
		$data['Description'] = 'Изпрати SMS :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('sms/send');
        $this->load->view('templates/footer');
	}	
}
