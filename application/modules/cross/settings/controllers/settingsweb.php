<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Settingsweb extends MY_AdminController
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_identitas');
		//$this->load->model('blog_model');
		//$this->load->helper('tags');
		error_reporting(0);
	}
	function index()
	{
		cek_session_admin();
		if (isset($_POST['submit'])) {
			$this->model_identitas->identitas_update();
			redirect('settings/settingsweb');
		} else {
			$data['record'] = $this->model_identitas->identitas()->row_array();
			// $this->template->load('administrator/template', 'view_identitas', $data);
			$this->template->content->view('view_identitas', $data);

			// Set a partial's content
			// $this->template->footer = 'Made with Twitter Bootstrap';

			// Publish the template
			//$this->template->set_template('../../templates/gentelella/view/template');
			$this->template->set_template($this->config->item('admin-template') . '/view/template');
			$this->template->publish();
		}
	}
	function backup_data()
	{
		$group = 'superadmin';
		if ($this->input->is_ajax_request()) {
			if ($this->ion_auth->in_group($group)) {
				$this->model_utama->backup_db();
				// $this->session->set_flashdata('message', 'You must be a gangsta to view this page');
				// redirect('welcome/index');
			}
		} else {
			show_404();
		}
	}
}
