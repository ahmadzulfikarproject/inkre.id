<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pages extends MY_AdminController
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_pages');
	}
	function index()
	{
		cek_session_admin();
		$data['record'] = $this->model_pages->pages();
		$data['rss'] = $this->model_pages->list_pages_rss();
		$data['iden'] = $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
		
		// Datatables
		$this->template->stylesheet->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css', array('media' => 'all'));
		$this->template->stylesheet->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css', array('media' => 'all'));
		$this->template->stylesheet->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css', array('media' => 'all'));
		$this->template->stylesheet->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css', array('media' => 'all'));
		$this->template->stylesheet->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css', array('media' => 'all'));
	
		// Datatables
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net/js/jquery.dataTables.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-buttons/js/dataTables.buttons.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-buttons/js/buttons.flash.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-buttons/js/buttons.html5.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-buttons/js/buttons.print.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-keytable/js/dataTables.keyTable.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-responsive/js/dataTables.responsive.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/').'vendors/datatables.net-scroller/js/dataTables.scroller.min.js');

	
		$this->template->title = $this->router->fetch_class();
		$this->template->content->view('view_pages',$data);
		// Publish the template
		$this->template->set_template($this->config->item('admin-template') . '/view/template');
		$this->template->publish();
	}

	// Controller Modul pages 

	function tambah_pages()
	{
		cek_session_admin();
		if (isset($_POST['submit'])) {
			$this->model_pages->pages_tambah();
			redirect('pages');
		} else {
			$this->template->content->view('view_pages_tambah');
			// Publish the template
			$this->template->set_template($this->config->item('admin-template') . '/view/template');
			$this->template->publish();
			// $this->template->load('administrator/template', 'view_pages_tambah');
		}
	}

	function edit_pages()
	{
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])) {
			$this->model_pages->pages_update();
			redirect('pages');
		} else {
			$data['rows'] = $this->model_pages->pages_edit($id)->row_array();
			$this->template->content->view('view_pages_edit', $data);
			// Set a partial's content
			$this->template->footer = 'Made with Twitter Bootstrap';
			// Publish the template
			$this->template->set_template($this->config->item('admin-template') . '/view/template');
			$this->template->publish();
		}
	}

	function delete_pages()
	{
		$id = $this->uri->segment(3);
		$this->model_pages->pages_delete($id);
		redirect('pages');
	}
}
