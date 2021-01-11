<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class user extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_user');
	}
	function index(){
		cek_session_admin();
		$data['record'] = $this->model_user->user();
		$data['rss'] = $this->model_user->list_user_rss();
        $data['iden'] = $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        //$this->load->view(template().'/rss',$data);
        //$this->template->loadrss(template().'/rss_page',$data);
		$this->template->load('administrator/template','view_user',$data);
	}

	// Controller Modul user 

	function tambah_user(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_user->user_tambah();
			redirect('user');
		}else{
			$this->template->load('administrator/template','view_user_tambah');
		}
	}

	function edit_user(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_user->user_update();
			redirect('user');
		}else{
			$data['rows'] = $this->model_user->user_edit($id)->row_array();
			$this->template->load('administrator/template','view_user_edit',$data);
		}
	}

	function delete_user(){
		$id = $this->uri->segment(3);
		$this->model_user->user_delete($id);
		redirect('user');
	}
	

}
