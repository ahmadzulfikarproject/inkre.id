<?php
defined('BASEPATH') or exit('No direct script access allowed');
class products extends MY_AdminController
{
	function __construct()
	{
		parent::__construct();
		// $this->load->library('Ajax_pagination');
		// $this->perPage = 4;
		// $this->load->model('model_products');
		$this->load->model('model_products_tags', 'tags');
		// $this->load->model('model_products_categories');
		// $this->load->helper('cookie');
		// $this->lang->load('products');
		// $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		// $this->load->database();
		$this->load->model('products_model', 'products');
		// $this->load->model('customers/customers_model', 'customers');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->helper('url');
	}
	function index()
	{
		cek_session_admin();
		$categories = $this->products->get_list_categories();
		// print_r($categories);
		$opt = array('' => 'All Category');
		foreach ($categories as $category) {
			$opt[$category['cat']] = $category['name'];
		}
		// print_r($this->products->get_datatables());
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
		$this->ion_auth->in_group('superadmin') ? $this->template->button->add('<a href="#resetModal" class="btn btn-primary" data-toggle="modal">Reset products DB</a>') : '';
		$this->template->button->add('<a class="btn btn-primary" href="' . base_url('products/add_products') . '">Tambahkan Data</a>');
		$data['button'] = $this->template->button;
		$this->template->button_action->add('<a class="btn btn-primary" href="#">Cancel</a>');
		$data['button_action'] = $this->template->button_action;
		$this->template->content->view('view_products_ajax', $data);
		// Publish the template
		// $this->template->set_template($this->config->item('admin-template') . '/view/template');
		$this->template->publish();
	}
	public function ajax_list()
	{
		$list = $this->products->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $products) {
			$action = anchor(base_url('products/edit_products/' . $products->id_products), 'Edit <span class="glyphicon glyphicon-edit"></span>', array('class' => 'btn btn-primary btn-sm', 'title' => $products->judul));
			$action .= anchor(home_url('products/detail/' . $products->slug), 'View', array('class' => 'btn btn-success btn-sm', 'target' => '_blank', 'title' => $products->judul));
			$action .= anchor(base_url('products/delete_products/' . $products->id_products), 'Delete <span class="glyphicon glyphicon-remove"></span>', array('onclick' => 'return confirm(\'Apa anda yakin untuk hapus Data ini?\')', 'class' => 'btn btn-danger btn-sm', 'title' => $products->judul));
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $products->gambar ? '<img src="' . home_url('asset/foto_products/' . getnameimage($products->gambar, '_200_400_thumb')) . '" alt="..." class="imglist">' : '';
			$row[] = $products->judul;
			// $row[] = anchor(home_url('products/detail/'.$products->slug), $products->judul, array('target' => '_blank','title' => $products->judul));
			$row[] = $products->id_categories ? anchor(home_url('products/categories/' . $products->cat_slug), $products->cat_name, array('target' => '_blank', 'title' => $products->cat_name)) : 'uncategorised'; //anchor(home_url('products/categories/' . $products->cat_slug), $products->cat_name, array('target' => '_blank', 'title' => $products->cat_name));
			$row[] = $products->products_views;
			$row[] = $products->created_time;
			$row[] = $action;
			// $row[] = $products->phone;
			// $row[] = $products->address;
			// $row[] = $products->city;
			// $row[] = $products->country;

			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->products->count_all(),
			"recordsFiltered" => $this->products->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	function add_products()
	{
		cek_session_admin();
		if (isset($_POST['submit'])) {
			$this->products->products_add();
			redirect('products');
		} else {
			$categories = $this->products->get_all_categories();
			// print_r($categories);
			$opt = array('' => 'All Category');
			foreach ($categories as $category) {
				$opt[$category['cat']] = $category['name'];
			}
			// print_r($this->products->get_datatables());
			$data['form_category'] = form_dropdown('', $opt, '', 'name="category" id="category" class="form-control"');
			$this->template->button->add('<button type="submit" name="submit" class="btn btn-info btn-lg"><i class="fa fa-save"></i> Simpan</button>');
			$this->template->button->add('<a class="btn btn-primary btn-lg" href="' . base_url('products') . '">Cancel</a>');
			$data['button'] = $this->template->button;
			$this->template->content->view('view_products_add', $data);
			// Publish the template
			$this->template->set_template($this->config->item('admin-template') . '/view/template');
			$this->template->publish();
			// $this->template->load('administrator/template', 'view_products_add');
		}
	}
	public function edit_products()
	{
		cek_session_admin();
		$id = $this->uri->segment(3);
		$post_id = $this->db->escape_str($this->input->post('id'));
		if (isset($_POST['submit'])) {
			//add tags
			$tags = $this->db->escape_str($this->input->post('tagshasil'));
			$this->tags->insert_products_tagsdb($tags);
			$this->tags->insert_products_tagsmap($tags, $post_id, 'products');
			$this->products->products_update();
			redirect('products');
		} else {
			$data['rows'] = $this->products->products_edit($id)->row_array();
			//category
			$categories = $this->products->get_all_categories($data['rows']['id_categories'], 5);
			// print_r($categories);
			// echo "aaaaaaaaaaaaaa";
			$opt = array('' => 'All Category');
			foreach ($categories as $category) {
				$opt[$category['cat']] = $category['name'];
			}
			// print_r($this->products->get_datatables());
			$selected = $data['rows']['id_categories'] ? $data['rows']['id_categories'] : ''; // untuk edit ganti '' menjadi data terpilih/selected
			$data['form_category'] = form_dropdown('', $opt, $selected, 'name="category" id="category" class="form-control"');
			$this->template->button->add('<button type="submit" name="submit" class="btn btn-info btn-lg"><i class="fa fa-save"></i> Update</button>');
			$this->template->button->add('<a class="btn btn-primary btn-lg" href="' . base_url('products') . '">Cancel</a>');
			$data['button'] = $this->template->button;
			//tags
			$data['tags'] = $this->products->tags_products($id);
			// print_r($data['tags']);
			$this->template->content->view('view_products_edit', $data);
			// Set a partial's content
			$this->template->footer = 'Made with Twitter Bootstrap';
			// <!-- jQuery Tags Input -->
			// $this->template->javascript->add(base_url('admin-templates/' . $this->config->item('admin-template-name') . '/') . 'vendors/jquery.tagsinput/src/jquery.tagsinput.js');
			// Publish the template
			$this->template->set_template($this->config->item('admin-template') . '/view/template');
			$this->template->publish();
		}
	}
	function delete_products()
	{
		$id = $this->uri->segment(3);
		$this->products->products_delete($id);
		redirect('products');
	}
	function productsmodule($data)
	{
		cek_session_admin();

		//$this->template->load('administrator/template','view_products_ajax',$data);
		// $this->load->view('view_products_ajax',$data);
		$categories = $this->products->get_list_categories();
		// print_r($categories);
		$opt = array('' => 'All Category');
		foreach ($categories as $category) {
			$opt[$category['cat']] = $category['name'];
		}
		// print_r($this->products->get_datatables());
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
		// $this->template->content->view('view_products_ajax', $data);
		// Publish the template
		// $this->template->set_template($this->config->item('admin-template') . '/view/template');
		$this->load->view('view_products_ajax', $data);
		$this->template->publish();
	}
	function get_autocomplete()
	{
		if ($this->input->is_ajax_request()) {

			if (isset($_GET['term'])) {
				$result = $this->tags->search_products_tags($_GET['term']);
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
	function reset_products()
	{
		if ($this->input->is_ajax_request()) {
			$this->products->reset_db_products();
		} else {
			show_404();
		}
	}
}
