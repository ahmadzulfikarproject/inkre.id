<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Projects extends MY_AdminController
{
	function __construct()
	{
		parent::__construct();
		// $this->load->library('Ajax_pagination');
		// $this->perPage = 4;
		// $this->load->model('model_projects');
		$this->load->model('model_projects_tags', 'tags');
		// $this->load->model('model_projects_categories');
		// $this->load->helper('cookie');
		// $this->lang->load('projects');
		// $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		// $this->load->database();
		$this->load->model('projects_model', 'projects');
		// $this->load->model('customers/customers_model', 'customers');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->helper('url');
	}
	function index()
	{
		cek_session_admin();
		$categories = $this->projects->get_list_categories();
		// print_r($categories);
		$opt = array('' => 'All Category');
		foreach ($categories as $category) {
			$opt[$category['cat']] = $category['name'];
		}
		// print_r($this->projects->get_datatables());
		$data['form_category'] = form_dropdown('', $opt, '', 'id="category" class="form-control"');
		// echo $data['form_category'];
		// Datatables
		$this->template->stylesheet->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css', array('media' => 'all'));
		$this->template->stylesheet->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css', array('media' => 'all'));
		$this->template->stylesheet->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css', array('media' => 'all'));
		$this->template->stylesheet->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css', array('media' => 'all'));
		$this->template->stylesheet->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css', array('media' => 'all'));

		// Datatables
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net/js/jquery.dataTables.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-buttons/js/dataTables.buttons.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-buttons/js/buttons.flash.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-buttons/js/buttons.html5.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-buttons/js/buttons.print.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-keytable/js/dataTables.keyTable.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-responsive/js/dataTables.responsive.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-scroller/js/dataTables.scroller.min.js');


		$this->template->title = $this->router->fetch_class();
		$this->ion_auth->in_group('superadmin') ? $this->template->button->add('<a href="#resetModal" class="btn btn-primary" data-toggle="modal">Reset projects DB</a>') : '';
		$this->template->button->add('<a class="btn btn-primary" href="' . base_url('projects/add_projects') . '">Tambahkan Data</a>');
		$data['button'] = $this->template->button;
		$this->template->button_action->add('<a class="btn btn-primary" href="#">Cancel</a>');
		$data['button_action'] = $this->template->button_action;
		$this->template->content->view('view_projects_ajax', $data);
		// Publish the template
		// $this->template->set_template($this->config->item('admin-template') . '/view/template');
		$this->template->publish();
	}
	public function ajax_list()
	{
		$list = $this->projects->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $projects) {
			$action = anchor(base_url('projects/edit_projects/' . $projects->id_projects), 'Edit <span class="glyphicon glyphicon-edit"></span>', array('class' => 'btn btn-primary btn-sm', 'title' => $projects->judul));
			$action .= anchor(home_url('projects/detail/' . $projects->slug), 'View', array('class' => 'btn btn-success btn-sm', 'target' => '_blank', 'title' => $projects->judul));
			$action .= anchor(base_url('projects/delete_projects/' . $projects->id_projects), 'Delete <span class="glyphicon glyphicon-remove"></span>', array('onclick' => 'return confirm(\'Apa anda yakin untuk hapus Data ini?\')', 'class' => 'btn btn-danger btn-sm', 'title' => $projects->judul));
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $projects->gambar ? '<img src="' . home_url('asset/foto_projects/' . getnameimage($projects->gambar, '_200_400_thumb')) . '" alt="..." class="imglist">' : '';
			$row[] = $projects->judul;
			$row[] = $projects->lokasi;
			// $row[] = anchor(home_url('projects/detail/'.$projects->slug), $projects->judul, array('target' => '_blank','title' => $projects->judul));
			$row[] = $projects->id_categories ? anchor(home_url('projects/categories/' . $projects->cat_slug), $projects->cat_name, array('target' => '_blank', 'title' => $projects->cat_name)) : 'uncategorised'; //anchor(home_url('projects/categories/' . $projects->cat_slug), $projects->cat_name, array('target' => '_blank', 'title' => $projects->cat_name));
			$row[] = $projects->projects_views;
			$row[] = $projects->created_time;
			$row[] = $action;
			// $row[] = $projects->phone;
			// $row[] = $projects->address;
			// $row[] = $projects->city;
			// $row[] = $projects->country;

			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->projects->count_all(),
			"recordsFiltered" => $this->projects->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function add_projects()
	{
		cek_session_admin();
		if (isset($_POST['submit'])) {
			$this->projects->projects_add();
			redirect('projects');
		} else {
			$categories = $this->projects->get_all_categories();
			// print_r($categories);
			$opt = array('' => 'All Category');
			foreach ($categories as $category) {
				$opt[$category['cat']] = $category['name'];
			}
			// print_r($this->projects->get_datatables());
			$data['form_category'] = form_dropdown('', $opt, '', 'name="category" id="category" class="form-control"');
			$this->template->button->add('<button type="submit" name="submit" class="btn btn-info btn-lg"><i class="fa fa-save"></i> Simpan</button>');
			$this->template->button->add('<a class="btn btn-primary btn-lg" href="' . base_url('projects') . '">Cancel</a>');
			$data['button'] = $this->template->button;
			$this->template->content->view('view_projects_add', $data);
			// Publish the template
			$this->template->set_template($this->config->item('admin-template') . '/view/template');
			$this->template->publish();
			// $this->template->load('administrator/template', 'view_projects_add');
		}
	}
	public function edit_projects()
	{
		cek_session_admin();
		$id = $this->uri->segment(3);
		$post_id = $this->db->escape_str($this->input->post('id'));
		if (isset($_POST['submit'])) {
			//add tags
			$tags = $this->db->escape_str($this->input->post('tagshasil'));
			$this->tags->insert_projects_tagsdb($tags);
			$this->tags->insert_projects_tagsmap($tags, $post_id, 'projects');
			$this->projects->projects_update();
			redirect('projects');
		} else {
			$data['rows'] = $this->projects->projects_edit($id)->row_array();
			//category
			$categories = $this->projects->get_all_categories($data['rows']['id_categories'], 6);
			// print_r($categories);
			// echo "aaaaaaaaaaaaaa";
			$opt = array('' => 'All Category');
			foreach ($categories as $category) {
				$opt[$category['cat']] = $category['name'];
			}
			// print_r($this->projects->get_datatables());
			$selected = $data['rows']['id_categories'] ? $data['rows']['id_categories'] : ''; // untuk edit ganti '' menjadi data terpilih/selected
			$data['form_category'] = form_dropdown('', $opt, $selected, 'name="category" id="category" class="form-control"');
			$this->template->button->add('<button type="submit" name="submit" class="btn btn-info btn-lg"><i class="fa fa-save"></i> Update</button>');
			$this->template->button->add('<a class="btn btn-primary btn-lg" href="' . base_url('projects') . '">Cancel</a>');
			$data['button'] = $this->template->button;
			//tags
			$data['tags'] = $this->projects->tags_projects($id);
			// print_r($data['tags']);
			$this->template->content->view('view_projects_edit', $data);
			// Set a partial's content
			$this->template->footer = 'Made with Twitter Bootstrap';
			// <!-- jQuery Tags Input -->
			// $this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/jquery.tagsinput/src/jquery.tagsinput.js');
			// Publish the template
			$this->template->set_template($this->config->item('admin-template') . '/view/template');
			$this->template->publish();
		}
	}
	function delete_projects()
	{
		$id = $this->uri->segment(3);
		$this->projects->projects_delete($id);
		redirect('projects');
	}
	function projectsmodule($data)
	{
		cek_session_admin();

		//$this->template->load('administrator/template','view_projects_ajax',$data);
		// $this->load->view('view_projects_ajax',$data);
		$categories = $this->projects->get_list_categories();
		// print_r($categories);
		$opt = array('' => 'All Category');
		foreach ($categories as $category) {
			$opt[$category['cat']] = $category['name'];
		}
		// print_r($this->projects->get_datatables());
		$data['form_category'] = form_dropdown('', $opt, '', 'id="category" class="form-control"');
		// echo $data['form_category'];
		// Datatables
		$this->template->stylesheet->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-bs/css/dataTables.bootstrap.min.css', array('media' => 'all'));
		$this->template->stylesheet->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css', array('media' => 'all'));
		$this->template->stylesheet->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css', array('media' => 'all'));
		$this->template->stylesheet->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css', array('media' => 'all'));
		$this->template->stylesheet->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css', array('media' => 'all'));

		// Datatables
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net/js/jquery.dataTables.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-bs/js/dataTables.bootstrap.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-buttons/js/dataTables.buttons.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-buttons/js/buttons.flash.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-buttons/js/buttons.html5.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-buttons/js/buttons.print.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-keytable/js/dataTables.keyTable.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-responsive/js/dataTables.responsive.min.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js');
		$this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/datatables.net-scroller/js/dataTables.scroller.min.js');


		$this->template->title = $this->router->fetch_class();
		// $this->template->content->view('view_projects_ajax', $data);
		// Publish the template
		// $this->template->set_template($this->config->item('admin-template') . '/view/template');
		$this->load->view('view_projects_ajax', $data);
		$this->template->publish();
	}
	function get_autocomplete()
	{
		if ($this->input->is_ajax_request()) {

			if (isset($_GET['term'])) {
				$result = $this->tags->search_projects_tags($_GET['term']);
				if (count($result) > 0) {
					foreach ($result as $row)
						$arr_result[] = array(
							'label'			=> $row->tags_title,
							'value'			=> $row->slug,
							'description'	=> $row->tags_description,
						);
					echo json_encode($arr_result);
				}
			}
		}
	}
	function reset_projects()
	{
		if ($this->input->is_ajax_request()) {
			$this->projects->reset_db_projects();
		} else {
			show_404();
		}
	}
}
