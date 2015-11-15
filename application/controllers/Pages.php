<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function view($page = 'login'){
        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php')){
                show_404();
        }

		$data['Title'] = 'TO DO';
		$data['Description'] = 'TO DO :: SMSYS';
		$this->load->helper('url');

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page);
        $this->load->view('templates/footer');
	}

}
