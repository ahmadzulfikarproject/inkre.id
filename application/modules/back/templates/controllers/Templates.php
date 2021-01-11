<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('templates');
		$this->load->model('model_template');
				
	}
	public function index()
	{
		cek_session_admin();
		$data['record'] = $this->model_template->template();
		$this->template->load('administrator/template','view_template',$data);
	}
	// Controller Modul Template Website

	function tambah_templates(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_template->template_tambah();
			redirect('templates');
		}else{
			$this->template->load('administrator/template','view_template_tambah');
		}
	}

	function edit_templates(){
		cek_session_admin();
		$id = $this->uri->segment(3);

		if (isset($_POST['submit'])){
			$this->model_template->template_update();
			$results = $this->model_template->template();

		    // Set $data array but leave it empty for now.
		    $data = array();
		    //print_r($results->result_array());
		    // Get key and value
		    foreach ($results->result_array() as $key => $value)
		    {
		        // Clean the slug
		        if (($value['id_templates'] == $this->input->post('id')) && ($this->db->escape_str($this->input->post('d')) == 'Y')) {
		        	# code...
		        	$status = $this->db->escape_str($this->input->post('d'));
		        	$data[$key]['id_templates']    = $value['id_templates'];
		        	$data[$key]['aktif'] = $status;
		        	

		        }
		        else{
		        	$status = 'N';
		        	$data[$key]['id_templates']    = $value['id_templates'];
		        	$data[$key]['aktif'] = $status;
		        }

		        
		        

		        // Add cleaned title and id to new data array.
		        // By using the key value, we create a new array for each row
		        // in the already existsing data array that we created earlier.
		        // This also gives us the correct formatted array for update_batch()
		        // function later.
		        
		        
		        //$data[$key]['username'] = 'administrator';
		        
		    }

		    // Print out array for debug
		    //print_r($data);

		    // Update database

		    $this->model_template->template_update_batch($data);

			
			redirect('templates');
		}else{
			$data['rows'] = $this->model_template->template_edit($id)->row_array();
			$this->template->load('administrator/template','view_template_edit',$data);
		}
	}

	function delete_templates(){
		$id = $this->uri->segment(3);
		$this->model_template->template_delete($id);
		redirect('templates');
	}

}
