<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sys extends CI_Controller {

	public function settings(){
		$data['Title'] = 'Настройки';
		$data['Description'] = 'Настройки :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('sys/settings');
        $this->load->view('templates/footer');
	}
}
