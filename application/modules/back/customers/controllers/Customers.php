<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Customers extends MY_AdminController
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('customers_model','customers');
	}
	function index()
	{
		cek_session_admin();
		$this->load->helper('url');
        $this->load->helper('form');
         
        $countries = $this->customers->get_list_countries();
 
        $opt = array('' => 'All Country');
        foreach ($countries as $country) {
            $opt[$country] = $country;
        }
 
        $data['form_country'] = form_dropdown('',$opt,'','id="country" class="form-control"');
        // $this->load->view('customers_view', $data);
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
		$this->template->append = $this->router->fetch_class();
		$this->template->content->view('customers_view',$data);
		// Publish the template
		$this->template->set_template($this->config->item('admin-template') . '/view/template');
		$this->template->publish();
	}
	public function ajax_list()
    {
        $list = $this->customers->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customers->FirstName;
            $row[] = $customers->LastName;
            $row[] = $customers->phone;
            $row[] = $customers->address;
            $row[] = $customers->city;
            $row[] = $customers->country;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->customers->count_all(),
                        "recordsFiltered" => $this->customers->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
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
