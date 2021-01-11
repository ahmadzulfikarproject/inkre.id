<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * slide List
 *
 * @package Controller
 * @author  Michał Śniatała <michal@sniatala.pl>
 * @license http://opensource.org/licenses/MIT  (MIT)
 * @since   Version 0.1
 */
class Slidez extends MY_AdminController
{

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->library('slide_list');
	}

	/**
	 * Show all slide groups
	 *
	 * @return void
	 */
	public function index()
	{
		cek_session_admin();
		cek_session_level('admin');

		$groups         = $this->slide_list->get_all_groups();
		$data['groups'] = array();

		foreach ($groups as $group) {
			$items                                 = $this->slide_list->get_all($group['id']);
			$data['groups'][$group['id']]          = $group;
			$data['groups'][$group['id']]['items'] = parse_children($items);
		}

		$data['title'] = 'slide';
		//print_r($groups);
		//$this->load->view('slide/list/index', $data);
		// $this->template->load('administrator/template', 'view_nestedmenu', $data);
		// $data = $this->settings->get_settings_list();
		// $this->template->build('admin/settings/index', $data);



		$this->template->content->view('view_nestedmenu', $data);
		$this->template->publish();
	}
	public function view($slug)
	{
		cek_session_admin();
		$groups         = $this->slide_list->get_all_groups();
		$data['groups'] = array();

		foreach ($groups as $group) {
			if ($slug == $group['slug']) {
				# code...

				$items                                 = $this->slide_list->get_all($group['id']);
				$data['groups'][$group['id']]          = $group;
				$data['groups'][$group['id']]['items'] = parse_children($items);
			}
		}

		$data['title'] = 'slide';
		//print_r($groups);
		//$this->load->view('slide/list/index', $data);
		// $this->template->load('administrator/template', 'view_nestedmenu', $data);
		$this->template->content->view('view_nestedmenu', $data);
		$this->template->publish();
	}
	/**
	 * Add new item to slide group
	 *
	 * @param string $id Item id
	 *
	 * @return void
	 */
	public function add($id)
	{
		cek_session_admin();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">×</a>', '</div>');
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		// $this->form_validation->set_rules('url', 'URL', 'required|trim');
		$this->form_validation->set_rules('parent_id', 'Parent', 'required|integer');
		// $this->form_validation->set_rules('level', 'level', 'required|trim');
		// $this->form_validation->set_rules('code', 'code');

		if ($this->form_validation->run() === FALSE) {
			$data['slide'] = $this->slide_list->get_group($id);
			$data['dropdown']   = $this->slide_list->get_all_for_dropdown($id);
			$data['title']      = 'Add item';

			//$this->load->view('slide/list/add', $data);
			// $this->template->load('administrator/template', 'view_nestedmenu_add', $data);
			$this->template->content->view('view_nestedmenu_add', $data);
			$this->template->publish();
		} else {
			$data             = $this->input->post();
			$data['group_id'] = $id;
			$data['slug'] = url_title($this->input->post('name'), '-', TRUE);
			$this->slide_list->add_item($data);

			redirect('slide');
		}
	}

	/**
	 * Edit item from slide group
	 *
	 * @param string $id Item id
	 *
	 * @return void
	 */
	public function edit($id)
	{
		cek_session_admin();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">×</a>', '</div>');
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		// $this->form_validation->set_rules('url', 'URL', 'required|trim');
		$this->form_validation->set_rules('icon', 'Icon', 'required|trim');
		$this->form_validation->set_rules('parent_id', 'Parent', 'required|integer');
		// $this->form_validation->set_rules('level', 'level', 'required|trim');
		// $this->form_validation->set_rules('code', 'code');

		if ($this->form_validation->run() === FALSE) {
			if ($data = $this->slide_list->get_item($id)) {
				$data['slide'] = $this->slide_list->get_group($data['group_id']);
				$data['dropdown']   = $this->slide_list->get_all_for_dropdown($data['group_id'], (int)$id);
				$data['title']      = 'Edit item';
				//$this->load->view('slide/list/edit', $data);
				// $this->template->load('administrator/template', 'view_nestedmenu_edit', $data);
				$this->template->content->view('view_nestedmenu_edit', $data);
				$this->template->publish();
			} else {
				show_404();
			}
		} else {
			$data             = $this->input->post();
			$data['slug'] = url_title($this->input->post('name'), '-', TRUE);
			$this->slide_list->update_item($id, $data);

			redirect('slide');
		}
	}

	/**
	 * Delete item from slide group
	 *
	 * @param string $id Item id
	 *
	 * @return void
	 */
	public function delete($id)
	{
		cek_session_admin();
		if (!$this->slide_list->has_children($id)) {
			$this->slide_list->delete_item($id);
		}

		redirect('slide');
	}

	/**
	 * Reorder items in slide group
	 *
	 * @return void
	 */
	public function reorder()
	{
		if ($this->input->is_ajax_request()) {
			$arr   = array();
			$order = $this->input->post('order');

			parse_str($order, $arr);

			$this->slide_list->reorder($arr['list']);
		} else {
			show_404();
		}
	}

	/**
	 * Add new slide group
	 *
	 * @return void
	 */
	public function add_group()
	{
		cek_session_admin();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">×</a>', '</div>');
		$this->form_validation->set_rules('name', 'Name', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			$data['title'] = 'Add slide group';
			//$this->load->view('slide/group/add', $data);
			// $this->template->load('administrator/template', 'group/add', $data);
			$this->template->content->view('group/add', $data);
			$this->template->publish();
		} else {
			$this->slide_list->add_group($this->input->post());

			redirect('slide');
		}
	}

	/**
	 * Edit slide group
	 *
	 * @param string $id Item id
	 *
	 * @return void
	 */
	public function edit_group($id)
	{
		cek_session_admin();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">×</a>', '</div>');
		$this->form_validation->set_rules('name', 'Name', 'required|trim');

		if ($this->form_validation->run() === FALSE) {
			if ($data = $this->slide_list->get_group($id)) {
				$data['title'] = 'Edit slide group';
				//$this->load->view('slide/group/edit', $data);
				// $this->template->load('administrator/template', 'group/edit', $data);
				$this->template->content->view('group/edit', $data);
				$this->template->publish();
			} else {
				show_404();
			}
		} else {
			$this->slide_list->update_group($id, $this->input->post());

			redirect('slide');
		}
	}

	/**
	 * Delete slide group
	 *
	 * @param string $id Item id
	 *
	 * @return void
	 */
	public function delete_group($id)
	{
		cek_session_admin();
		$this->slide_list->delete_group($id);

		redirect('slide');
	}

	/**
	 * Samples - library usage
	 *
	 * @return void
	 */
	public function samples()
	{
		cek_session_admin();
		$data['title'] = 'Samples';
		//$this->load->view('slide/sample/index', $data);
		// $this->template->load('administrator/template', 'sample/index', $data);
		$this->template->content->view('sample/index', $data);
		$this->template->publish();
	}
}
/* End of file al.php */
/* Location: ./controllers/al.php */
