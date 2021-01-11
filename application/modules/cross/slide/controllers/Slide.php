<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Slide extends MY_AdminController
{
	function __construct()
	{
		parent::__construct();
		error_reporting(0);
	}
	function index_sort()
	{
		cek_session_admin();
		$data['record'] = $this->model_slide->slide();
		$this->template->load('administrator/template', 'view_slide', $data);
	}

	// Controller Modul slide Baru

	function add_slide()
	{
		cek_session_admin();
		if (isset($_POST['submit'])) {
			$this->model_slide->slide_add();
			redirect('slide');
		} else {
			$this->template->button->add('<button type="submit" name="submit" class="btn btn-info btn-lg"><i class="fa fa-save"></i> Simpan</button>');
			$this->template->button->add('<a class="btn btn-primary btn-lg" href="' . base_url('slide') . '">Cancel</a>');
			$data['button'] = $this->template->button;
			$this->template->content->view('view_slide_tambah', $data);
			// Publish the template
			$this->template->set_template($this->config->item('admin-template') . '/view/template');
			$this->template->publish();
		}
	}
	function edit_slide()
	{
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])) {
			$this->model_slide->slide_update();
			redirect('slide');
		} else {
			$data['rows'] = $this->model_slide->slide_edit($id)->row_array();
			// $this->template->load('administrator/template', 'view_slide_edit', $data);

			$this->template->button->add('<button type="submit" name="submit" class="btn btn-info btn-lg"><i class="fa fa-save"></i> Update</button>');
			$this->template->button->add('<a class="btn btn-primary btn-lg" href="' . base_url('slide') . '">Cancel</a>');
			$data['button'] = $this->template->button;
			$this->template->content->view('view_slide_edit', $data);
			// Set a partial's content
			$this->template->footer = 'Made with Twitter Bootstrap';
			$this->template->set_template($this->config->item('admin-template') . '/view/template');
			$this->template->publish();
		}
	}

	function delete_slidebaru($id)
	{
		//$id = $this->uri->segment(3);
		$this->model_slide->slide_delete($id);
		redirect('slide');
	}
	function index()
	{
		cek_session_admin();
		$data['posts'] = $this->model_slide->slide()->result_array();
		// $this->template->load('administrator/template','view_sort_slide',$data);

		$this->template->title = $this->router->fetch_class();
		$this->ion_auth->in_group('superadmin') ? $this->template->button->add('<a href="#resetModal" class="btn btn-primary" data-toggle="modal">Reset services DB</a>') : '';
		$this->template->button->add('<a class="btn btn-primary" href="' . base_url('services/add_services') . '">Tambahkan Data</a>');
		$data['button'] = $this->template->button;
		$this->template->button_action->add('<a class="btn btn-primary" href="#">Cancel</a>');
		$data['button_action'] = $this->template->button_action;
		$this->template->content->view('view_sort_slide', $data);
		// Publish the template
		// $this->template->set_template($this->config->item('admin-template') . '/view/template');
		$this->template->publish();
	}
	public function reorder_slide()
	{
		if ($this->input->is_ajax_request()) {
			echo "halooo broo";
			$arr   = array();
			$order = $this->input->post('order');

			parse_str($order, $arr);

			$this->model_slide->reorder_slide($arr['list']);
		} else {
			show_404();
		}
	}
}
