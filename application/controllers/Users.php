<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	private $nPerPage = 15;

	public function __construct(){
        parent::__construct();
        $this->load->model('users_model');
        $this->load->helper(array('form', 'url'));
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

	public function all(){
		$head['Title'] = 'Потребители';
		$head['Description'] = 'Потребители :: SMSYS';
		$head['arCss'][] = 'static/css/list.css';

		$data['users'] = $this->users_model->get_users($this->nPerPage);
		$data['paging'] = $this->getPaging($this->users_model->get_users_cnt(), base_url().'sms/inbox/page/');

        $this->load->view('templates/header', $head);
        $this->load->view('users/list', $data);
        $this->load->view('templates/footer');
	}   

    public function add($err = ''){
        $head['Title'] = 'Добавя на потребител';
        $head['Description'] = 'Добавя на потребител :: SMSYS';
        $head['arCss'][] = 'static/css/form.css';

        $data['error'] = $err;

        $this->load->view('templates/header', $head);
        $this->load->view('users/userform', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id,$err = ''){
        $head['Title'] = 'Редакция на потребител';
        $head['Description'] = 'Редакция на потребител :: SMSYS';
        $head['arCss'][] = 'static/css/form.css';

        $user = $this->db->get_where('users', array('id' => $id))->row();
        if($user) $data = json_decode(json_encode($user),true);

        $data['error'] = $err;

        $this->load->view('templates/header', $head);
        $this->load->view('users/userform', $data);
        $this->load->view('templates/footer');
    }

    public function save(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('Name', 'Име', 'required');
        $this->form_validation->set_rules('Family', 'Фамилия', 'required');
        $this->form_validation->set_rules('username', 'Потребителско име', 'required');

        if ($this->form_validation->run() == FALSE){
            if($this->input->post('ID') == FALSE) 
                $this->add(validation_errors());
            else 
                $this->edit($this->input->post('ID'), validation_errors());
        } else {
            $data = array(
                'Name' => $this->input->post('Name'),
                'Family' => $this->input->post('Family'),
                'username' => $this->input->post('username'),
                'pass' => md5($this->input->post('pass'))
            );

            if($this->input->post('ID') == FALSE) 
                $this->db->insert('users', $data);
            else {
                $this->db->where('ID', $this->input->post('ID'));
                $this->db->update('users', $data);
            }
            redirect('/users/all');
        }      
    }

 	public function delete($id){        
        $this->db->where('id', $id)->delete('users'); 
        redirect('/users/all');  
    }    
}