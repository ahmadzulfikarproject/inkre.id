<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contacts extends MY_AdminController {
	function __construct(){
		parent::__construct();
		$this->load->model('model_contact');
	}
	function index(){
		cek_session_admin();
		//echo "berhasil";
		$data['record'] = $this->model_contact->list_contact();
		//print_r($data['record']->row_array());
		$data['rss'] = $this->model_contact->list_contact_rss();
        $data['iden'] = $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        //$this->load->view(template().'/contact-rss',$data);
		$this->template->load('administrator/template','view_contact',$data);
	}

	// Controller Modul List contact

	function cepat_contact(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_contact->list_contact_cepat();
			redirect('contacts');
		}
	}
	function tambah_contact(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_contact->list_contact_tambah();
			redirect('contacts');
		}
		elseif (isset($_POST['savenew'])) {
			# code...
			$this->model_contact->list_contact_tambah();
			redirect('contacts/tambah_contact');
		}
		else{
			//$data['tag'] = $this->model_contact->tag_contact();
			//$data['record'] = $this->model_contact->kategori_contact();
			//$data['users'] = $this->model_users->users();
			//$this->template->load('administrator/template','view_contact_tambah');
			$this->template->load('administrator/template','view_contact_tambah');
		}
	}

	function edit_contact(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_contact->list_contact_update();
			redirect('dashboard');
		}
		elseif (isset($_POST['update'])) {
			# code...
			$this->model_contact->list_contact_update();
			redirect('contacts/edit_contact/'.$_POST['id']);
		}
		else{
			//$data['tag'] = $this->model_contact->tag_contact();
			//$data['record'] = $this->model_contact->kategori_contact();
			$data['rows'] = $this->model_contact->list_contact_edit($id)->row_array();
			//$data['users'] = $this->model_users->users();
			//$this->template->load('administrator/template','view_contact_edit',$data);
			$this->template->content->view('view_contact_edit', $data);
			// Set a partial's content
			$this->template->footer = 'Made with Twitter Bootstrap';
			// Publish the template
			$this->template->set_template($this->config->item('admin-template') . '/view/template');
			$this->template->publish();
		}
	}

	function delete_contact(){
		$id = $this->uri->segment(3);
		$this->model_contact->list_contact_delete($id);
		redirect('contacts');
	}

}
