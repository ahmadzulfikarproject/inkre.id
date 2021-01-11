<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Promo extends MY_AdminController
{
	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$this->load->model('model_promo');
	}
	function index_sort()
	{
		cek_session_admin();
		$data['record'] = $this->model_promo->promo();
		$this->template->load('administrator/template', 'view_promo', $data);
	}

	// Controller Modul promo Baru

	function add_promo()
	{
		cek_session_admin();
		if (isset($_POST['submit'])) {
			$this->model_promo->promo_add();
			redirect('promo');
		} else {
			$this->template->button->add('<button type="submit" name="submit" class="btn btn-info btn-lg"><i class="fa fa-save"></i> Simpan</button>');
			$this->template->button->add('<a class="btn btn-primary btn-lg" href="' . base_url('promo') . '">Cancel</a>');
			$data['button'] = $this->template->button;
			$this->template->content->view('view_promo_tambah', $data);
			// Publish the template
			$this->template->set_template($this->config->item('admin-template') . '/view/template');
			$this->template->publish();
		}
	}
	function edit_promo()
	{
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])) {
			$this->model_promo->promo_update();
			redirect('promo');
		} else {
			$data['rows'] = $this->model_promo->promo_edit($id)->row_array();
			// $this->template->load('administrator/template', 'view_promo_edit', $data);

			$this->template->button->add('<button type="submit" name="submit" class="btn btn-info btn-lg"><i class="fa fa-save"></i> Update</button>');
			$this->template->button->add('<a class="btn btn-primary btn-lg" href="' . base_url('promo') . '">Cancel</a>');
			$data['button'] = $this->template->button;
			$this->template->content->view('view_promo_edit', $data);
			// Set a partial's content
			$this->template->footer = 'Made with Twitter Bootstrap';
			$this->template->set_template($this->config->item('admin-template') . '/view/template');
			$this->template->publish();
		}
	}

	function delete_promobaru($id)
	{
		//$id = $this->uri->segment(3);
		$this->model_promo->promo_delete($id);
		redirect('promo');
	}
	function index()
	{
		cek_session_admin();
		$data['posts'] = $this->model_promo->promo()->result_array();
		// $this->template->load('administrator/template','view_sort_promo',$data);

		$this->template->title = $this->router->fetch_class();
		$this->ion_auth->in_group('superadmin') ? $this->template->button->add('<a href="#resetModal" class="btn btn-primary" data-toggle="modal">Reset services DB</a>') : '';
		$this->template->button->add('<a class="btn btn-primary" href="' . base_url('services/add_services') . '">Tambahkan Data</a>');
		$data['button'] = $this->template->button;
		$this->template->button_action->add('<a class="btn btn-primary" href="#">Cancel</a>');
		$data['button_action'] = $this->template->button_action;
		$this->template->content->view('view_sort_promo', $data);
		// Publish the template
		// $this->template->set_template($this->config->item('admin-template') . '/view/template');
		$this->template->publish();
	}
	public function reorder_promo()
	{
		if ($this->input->is_ajax_request()) {
			echo "halooo broo";
			$arr   = array();
			$order = $this->input->post('order');

			parse_str($order, $arr);

			$this->model_promo->reorder_promo($arr['list']);
		} else {
			show_404();
		}
	}
}
