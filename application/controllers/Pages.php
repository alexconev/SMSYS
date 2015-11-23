<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

        public function __construct(){
                parent::__construct();
                $this->load->model('sys_model');
                $this->load->helper('url');
        }   

	public function view($page = 'login'){
                if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))  show_404();

		$head['Title'] = 'TO DO';
		$head['Description'] = 'TO DO :: SMSYS';

                if($page != 'login') $this->load->view('templates/header', $head);
                $this->load->view('pages/'.$page);
                if($page != 'login') $this->load->view('templates/footer');
	}

}
