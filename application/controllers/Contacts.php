<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

	public function phonebook(){
		$data['Title'] = 'Номера';
		$data['Description'] = 'Номера :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('contacts/phonebook');
        $this->load->view('templates/footer');
	}

	public function groups(){
		$data['Title'] = 'Групи';
		$data['Description'] = 'Групи :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('contacts/groups');
        $this->load->view('templates/footer');
	}	

	public function import(){
		$data['Title'] = 'Импорт';
		$data['Description'] = 'Импорт :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('contacts/import');
        $this->load->view('templates/footer');
	}	

	public function contactsform(){
		$data['Title'] = 'Импорт';
		$data['Description'] = 'Импорт :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('contacts/contactsform');
        $this->load->view('templates/footer');
	}	

	public function groupsform(){
		$data['Title'] = 'Импорт';
		$data['Description'] = 'Импорт :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('contacts/groupsform');
        $this->load->view('templates/footer');
	}

}
