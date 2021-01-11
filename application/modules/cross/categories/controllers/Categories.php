<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * categories List
 *
 * @package Controller
 * @author  Michał Śniatała <michal@sniatala.pl>
 * @license http://opensource.org/licenses/MIT  (MIT)
 * @since   Version 0.1
 */
class Categories extends MY_AdminController
{

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->library('categories_list');
	}

	/**
	 * Show all categories groups
	 *
	 * @return void
	 */
	public function index()
	{
		cek_session_admin();
		cek_session_level('admin');

		$groups         = $this->categories_list->get_all_groups();
		$data['groups'] = array();

		foreach ($groups as $group) {
			$items                                 = $this->categories_list->get_all($group['id']);
			$data['groups'][$group['id']]          = $group;
			$data['groups'][$group['id']]['items'] = parse_children($items);
		}

		$data['title'] = 'categories';
		//print_r($groups);
		//$this->load->view('categories/list/index', $data);
		// $this->template->load('administrator/template', 'view_nestedmenu', $data);
		// $data = $this->settings->get_settings_list();
		// $this->template->build('admin/settings/index', $data);



		$this->template->content->view('view_nestedmenu', $data);
		$this->template->publish();
	}
	public function view($slug)
	{
		cek_session_admin();
		$groups         = $this->categories_list->get_all_groups();
		$data['groups'] = array();

		foreach ($groups as $group) {
			if ($slug == $group['slug']) {
				# code...

				$items                                 = $this->categories_list->get_all($group['id']);
				$data['groups'][$group['id']]          = $group;
				$data['groups'][$group['id']]['items'] = parse_children($items);
			}
		}

		$data['title'] = 'categories';
		//print_r($groups);
		//$this->load->view('categories/list/index', $data);
		// $this->template->load('administrator/template', 'view_nestedmenu', $data);
		$this->template->content->view('view_nestedmenu', $data);
		$this->template->publish();
	}
	/**
	 * Add new item to categories group
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
			$data['categories'] = $this->categories_list->get_group($id);
			$data['dropdown']   = $this->categories_list->get_all_for_dropdown($id);
			$data['title']      = 'Add item';

			//$this->load->view('categories/list/add', $data);
			// $this->template->load('administrator/template', 'view_nestedmenu_add', $data);
			$this->template->content->view('view_nestedmenu_add', $data);
			$this->template->publish();
		} else {
			$data             = $this->input->post();
			$data['group_id'] = $id;
			$data['slug'] = url_title($this->input->post('name'), '-', TRUE);
			$this->categories_list->add_item($data);

			redirect('categories');
		}
	}

	/**
	 * Edit item from categories group
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
			if ($data = $this->categories_list->get_item($id)) {
				$data['categories'] = $this->categories_list->get_group($data['group_id']);
				$data['dropdown']   = $this->categories_list->get_all_for_dropdown($data['group_id'], (int)$id);
				$data['title']      = 'Edit item';
				//$this->load->view('categories/list/edit', $data);
				// $this->template->load('administrator/template', 'view_nestedmenu_edit', $data);
				$this->template->content->view('view_nestedmenu_edit', $data);
				$this->template->publish();
			} else {
				show_404();
			}
		} else {
			$data             = $this->input->post();
			$data['slug'] = url_title($this->input->post('name'), '-', TRUE);
			$this->categories_list->update_item($id, $data);

			redirect('categories');
		}
	}

	/**
	 * Delete item from categories group
	 *
	 * @param string $id Item id
	 *
	 * @return void
	 */
	public function delete($id)
	{
		cek_session_admin();
		if (!$this->categories_list->has_children($id)) {
			$this->categories_list->delete_item($id);
		}

		redirect('categories');
	}

	/**
	 * Reorder items in categories group
	 *
	 * @return void
	 */
	public function reorder()
	{
		if ($this->input->is_ajax_request()) {
			$arr   = array();
			$order = $this->input->post('order');

			parse_str($order, $arr);

			$this->categories_list->reorder($arr['list']);
		} else {
			show_404();
		}
	}

	/**
	 * Add new categories group
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
			$data['title'] = 'Add categories group';
			//$this->load->view('categories/group/add', $data);
			// $this->template->load('administrator/template', 'group/add', $data);
			$this->template->content->view('group/add', $data);
			$this->template->publish();
		} else {
			$this->categories_list->add_group($this->input->post());

			redirect('categories');
		}
	}

	/**
	 * Edit categories group
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
			if ($data = $this->categories_list->get_group($id)) {
				$data['title'] = 'Edit categories group';
				//$this->load->view('categories/group/edit', $data);
				// $this->template->load('administrator/template', 'group/edit', $data);
				$this->template->content->view('group/edit', $data);
				$this->template->publish();
			} else {
				show_404();
			}
		} else {
			$this->categories_list->update_group($id, $this->input->post());

			redirect('categories');
		}
	}

	/**
	 * Delete categories group
	 *
	 * @param string $id Item id
	 *
	 * @return void
	 */
	public function delete_group($id)
	{
		cek_session_admin();
		$this->categories_list->delete_group($id);

		redirect('categories');
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
		//$this->load->view('categories/sample/index', $data);
		// $this->template->load('administrator/template', 'sample/index', $data);
		$this->template->content->view('sample/index', $data);
		$this->template->publish();
	}
}
/* End of file al.php */
/* Location: ./controllers/al.php */
