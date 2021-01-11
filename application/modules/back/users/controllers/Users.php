<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_users');
	}
	function index(){
		cek_session_admin();
		$data['record'] = $this->model_users->users();
		$data['rss'] = $this->model_users->list_users_rss();
        $data['iden'] = $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        //$this->load->view(template().'/rss',$data);
        //$this->template->loadrss(template().'/rss_page',$data);
		$this->template->load('administrator/template','view_users',$data);
	}

	// Controller Modul users 

	function tambah_users(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_users->users_tambah();
			redirect('users');
		}else{
			$this->template->load('administrator/template','view_users_tambah');
		}
	}

	function edit_users(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_users->users_update();
			redirect('users');
		}else{
			$data['rows'] = $this->model_users->users_edit($id)->row_array();
			$this->template->load('administrator/template','view_users_edit',$data);
		}
	}

	function delete_users(){
		$id = $this->uri->segment(3);
		$this->model_users->users_delete($id);
		redirect('users');
	}
	

}
