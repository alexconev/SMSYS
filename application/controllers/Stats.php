<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stats extends CI_Controller {

	public function day(){
		$data['Title'] = 'Статистика днес';
		$data['Description'] = 'Статистика днес :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('stats/day');
        $this->load->view('templates/footer');
	}

	public function week(){
		$data['Title'] = 'Статистика последна седмица';
		$data['Description'] = 'Статистика последна седмица :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('stats/week');
        $this->load->view('templates/footer');
	}	

	public function month(){
		$data['Title'] = 'Статистика последен месец';
		$data['Description'] = 'Статистика последен месец :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('stats/month');
        $this->load->view('templates/footer');
	}	
}
