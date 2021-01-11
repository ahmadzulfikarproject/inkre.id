<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Settings extends MY_AdminController
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_identitas');
		$this->load->model('model_settings', 'settings');
		//$this->load->model('blog_model');
		//$this->load->helper('tags');
		$this->load->helper('inflector');
		error_reporting(0);
	}
	function index()
	{
		cek_session_admin();
		// if (isset($_POST['submit'])) {
		// 	$this->model_identitas->identitas_update();
		// 	redirect('settings');
		// }
		// do we have a submitted form?
		if ($this->input->post() && isset($_POST['submit'])) {
			// some fields aren't required, so we get the
			// ones that are, and set form_validation
			foreach ($this->settings->get_required_settings() as $item) {
				$this->form_validation->set_rules($item->name, ucfirst($item->tab) . ' Tab - ' . ucwords(humanize($item->name)), 'required');
			}

			// form validation failed, send them back to 
			// the form to fix whatever it was.
			if ($this->form_validation->run() === FALSE) {
				// get the list of settings
				$data = $this->settings->get_settings_list();
				// $this->template->build('admin/settings/index', $data);
				$this->template->title = 'Settings';
				$this->template->active_link = 'settings';

				$this->template->content->view('settings/index', $data);

				// Set a partial's content
				// $this->template->footer = 'Made with Twitter Bootstrap';

				// Publish the template
				//$this->template->set_template('../../templates/gentelella/view/template');
				$this->template->set_template($this->config->item('admin-template') . '/view/template');
				$this->template->publish();
			}
			// form_validation succeeded
			// let's insert the new values
			// and move on.
			
			if ($this->settings->update_settings()) {
				$this->session->set_flashdata('success', lang('settings_update_success'));
				// redirect('settings');
			} else {
				$data['message'] = lang('settings_update_failed');
				// get the list of settings
				$data = $this->settings->get_settings_list();
				// $this->template->build('admin/settings/index', $data);
				$this->template->title = 'Settings';
				$this->template->active_link = 'settings';

				$this->template->content->view('view_settings', $data);

				// Set a partial's content
				// $this->template->footer = 'Made with Twitter Bootstrap';

				// Publish the template
				//$this->template->set_template('../../templates/gentelella/view/template');
				$this->template->set_template($this->config->item('admin-template') . '/view/template');
				$this->template->publish();
			}
		} else {
			// $data['record'] = $this->model_identitas->identitas()->row_array();
			// $this->template->load('administrator/template', 'view_identitas', $data);
			// get the list of settings
			$data = $this->settings->get_settings_list();
			// $this->template->build('admin/settings/index', $data);

			

			$this->template->content->view('view_settings', $data);

			// Set a partial's content
			// $this->template->footer = 'Made with Twitter Bootstrap';

			// Publish the template
			//$this->template->set_template('../../templates/gentelella/view/template');
			// $this->template->set_template($this->config->item('admin-template') . '/view/template');
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
