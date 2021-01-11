<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clients extends MY_AdminController {
	function __construct(){
		parent::__construct();
		$this->load->model('model_clients');
        $this->load->model('model_clients_tags');
        $this->load->model('model_clients_categories');
		$this->load->library('Ajax_pagination');
        $this->perPage = 4;
        $this->load->helper('cookie');
        // $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('date');
		//error_reporting(0);
	}
	function index(){
		cek_session_admin();
		$totalRec = count($this->model_clients->getclients());
		//pagination configuration
        $config['target']      = '#enquiryList';
        $config['base_url']    = base_url().'clients/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $data['no'] = $this->perPage;
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['posts'] = $this->model_clients->getclients(array('limit'=>$this->perPage));
        $data['start'] = 0;
        // custom paging configuration
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
         
        $config['full_tag_open'] = '<ul class="pagination fikar">';
        $config['full_tag_close'] = '</ul>';
         
        $config['first_link'] = 'First Page';
        $config['first_tag_open'] = '<li><span class="firstlink">';
        $config['first_tag_close'] = '</span></li>';
         
        $config['last_link'] = 'Last Page';
        $config['last_tag_open'] = '<li><span class="lastlink">';
        $config['last_tag_close'] = '</span></li>';
         
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li><span class="nextlink">';
        $config['next_tag_close'] = '</span></li>';

        $config['prev_link'] = 'Prev Page';
        $config['prev_tag_open'] = '<li><span class="prevlink">';
        $config['prev_tag_close'] = '</span></li>';

        $config['cur_tag_open'] = '<li class="active"><span class="curlink">';
        $config['cur_tag_close'] = '</span></li>';

        $config['num_tag_open'] = '<li><span class="numlink">';
        $config['num_tag_close'] = '</span></li>';
         
        $this->ajax_pagination->initialize($config);
        //===================
		$data['record'] = $this->model_clients->list_clients();
		$data['kategori'] = $this->model_clients->kategori_clients();
		$data['categories'] = $this->model_clients->categories_clients();
		//print_r($data['kategori']->result_array());
		//print_r($data['record']->row_array());
		$data['rss'] = $this->model_clients->list_clients_rss();
        $data['iden'] = $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        //$this->load->view(template().'/rss',$data);
        //$this->template->loadrss(template().'/rss',$data);
        //tagrss
        //$data['rss_tags'] = $this->model_clients->list_clients_rss_tags();
        //$this->template->loadrss(template().'/rss_tags',$data);
        //view
		$this->template->load('administrator/template','view_clients_ajax',$data);
        
       
	}
	function ajaxPaginationData(){
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        $numView = $this->input->post('numView');
        $kategori = $this->input->post('kategori');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        if(!empty($kategori)){
            $conditions['search']['kategori'] = $kategori;
        }
        //total rows count
        $totalRec = count($this->model_clients->getclients($conditions));
        if(!empty($numView)){
            //$conditions['limit'] = $numView;
            $config['per_page']    = $numView;
        }
        else{
            //$conditions['limit'] = $this->perPage;
            $config['per_page']    = $this->perPage;
        }
        //pagination configuration
        $config['target']      = '#enquiryList';
        $config['base_url']    = base_url().'clients/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        //$config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        if(!empty($numView)){
            $conditions['limit'] = $numView;
            //$config['per_page']    = $numView;
        }
        else{
            $conditions['limit'] = $this->perPage;
            //$config['per_page']    = $this->perPage;
        }
        /*
        //fikar cookie
        $cookie= array(
   
             'name'   => 'numvewku',
   
             'value'  => $numView,
   
             'expire' => '3600',
   
        );
   
        $this->input->set_cookie($cookie);
        */
        
         //end cookie
        //get posts data
        $data['posts'] = $this->model_clients->getclients($conditions);
        $data['start'] = $offset;
        $data['sortBy'] = $sortBy;
        // custom paging configuration
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
         
        $config['full_tag_open'] = '<ul class="pagination fikar">';
        $config['full_tag_close'] = '</ul>';
         
        $config['first_link'] = 'First Page';
        $config['first_tag_open'] = '<li><span class="firstlink">';
        $config['first_tag_close'] = '</span></li>';
         
        $config['last_link'] = 'Last Page';
        $config['last_tag_open'] = '<li><span class="lastlink">';
        $config['last_tag_close'] = '</span></li>';
         
        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li><span class="nextlink">';
        $config['next_tag_close'] = '</span></li>';

        $config['prev_link'] = 'Prev Page';
        $config['prev_tag_open'] = '<li><span class="prevlink">';
        $config['prev_tag_close'] = '</span></li>';

        $config['cur_tag_open'] = '<li class="active"><span class="curlink">';
        $config['cur_tag_close'] = '</span></li>';

        $config['num_tag_open'] = '<li><span class="numlink">';
        $config['num_tag_close'] = '</span></li>';
         
        $this->ajax_pagination->initialize($config);
        //load the view
        $data['kategori'] = $this->model_clients->kategori_clients();
        $data['categories'] = $this->model_clients->categories_clients();
        $this->load->view('ajax-pagination-data', $data, false);
        //$this->template->load('administrator/template','view_clients_ajax',$data);

    }
	// produk
	// Controller Modul List produk

	function cepat_clients(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_clients->list_clients_cepat();
			redirect('clients');
		}
	} 

	function tambah_clients(){
		cek_session_admin();
		if (isset($_POST['submit'])){

			$this->model_clients->list_clients_tambah();
			//$tags = $this->db->escape_str($this->input->post('tagshasil'));
			//$this->model_clients_tags->insert_clients_tagsdb($tags);
			redirect('clients');
		}
		elseif (isset($_POST['savenew'])) {
			# code...
			//$tags = $this->db->escape_str($this->input->post('tagshasil'));
			$this->model_clients->list_clients_tambah();
			//$this->model_clients_tags->insert_clients_tagsdb($tags);
			redirect('tambah_clients');
		}
		else{
			$data['tag'] = $this->model_clients->tag_clients();
			$data['record'] = $this->model_clients->categories_clients();
			$data['users'] = $this->model_users->users();
			$this->template->load('administrator/template','view_clients_tambah',$data);
		}
	}

	function edit_clients(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){

			//$tags = $this->db->escape_str($this->input->post('tagshasil'));
			$this->model_clients->list_clients_update();
			//$this->model_clients_tags->insert_clients_tagsdb($tags);

			//add tags
			$tags = $this->db->escape_str($this->input->post('tagshasil'));
            if (!empty($tags)) {
    			$this->model_clients_tags->insert_clients_tagsdb($tags);
    			$post_id = $this->db->escape_str($this->input->post('id'));
    			$this->model_clients_tags->insert_clients_tagsmap($tags,$post_id,'clients');
            }
			
			redirect('clients');
		}
		elseif (isset($_POST['update'])) {
			# code...
			//$tags = $this->db->escape_str($this->input->post('tagshasil'));
			$this->model_clients->list_clients_update();
			//$this->model_clients_tags->insert_clients_tagsdb($tags);
			//add tags
			$tags = $this->db->escape_str($this->input->post('tagshasil'));
            if (!empty($tags)) {
    			$this->model_clients_tags->insert_clients_tagsdb($tags);
    			$post_id = $this->db->escape_str($this->input->post('id'));
    			$this->model_clients_tags->insert_clients_tagsmap($tags,$post_id,'clients');
            }

			redirect('clients/edit_clients/'.$_POST['id']);
		}
		else{
			$post_id = $this->db->escape_str($this->input->post('id'));
			//echo $post_id;
			$data['tags'] = $this->model_clients->tags_clients($id);

			$data['tag'] = $this->model_clients->tag_clients();
			$data['record'] = $this->model_clients->categories_clients();
			$data['rows'] = $this->model_clients->list_clients_edit($id)->row_array();
			// $data['users'] = $this->model_users->users();

			//print_r($data['tags']->row_array());
			$this->template->load('administrator/template','view_clients_edit',$data);
		}
	}

	function delete_clients(){
		$id = $this->uri->segment(3);
		$this->model_clients->list_clients_delete($id);
		redirect('clients');
	}
	function update_semua_clients(){
		cek_session_admin();
		$config = array(
                'field' => 'slug',
                'title' => 'judul',
                'table' => 'clients',
                'id' => 'id_clients',
            );
            $this->load->library('slug', $config);
		// Get title and id form database
	    // Assuming that $results includes row ID and title
	    $results = $this->model_clients->list_clients();

	    // Set $data array but leave it empty for now.
	    $data = array();
	    //print_r($results->result_array());
	    // Get key and value
	    foreach ($results->result_array() as $key => $value)
	    {
	        // Clean the slug
	        $cleanslug = $this->slug->create_uri($value['judul']);
	        

	        // Add cleaned title and id to new data array.
	        // By using the key value, we create a new array for each row
	        // in the already existsing data array that we created earlier.
	        // This also gives us the correct formatted array for update_batch()
	        // function later.
	        
	        $data[$key]['id_clients']    = $value['id_clients'];
	        $data[$key]['slug'] = $cleanslug;
	        $data[$key]['username'] = 'administrator';
	        
	    }

	    // Print out array for debug
	    //print_r($data);

	    // Update database
	    $this->model_clients->update_clients($data);
		//$data['record'] = $this->model_clients->semua_clientsterbaru();
		
		 //$this->model_clients->semua_clients();
		//print_r($data);
		//$this->model_clients->update_semua_clients();
		redirect('clients');
	}
    //fikar custom
    function import(){
      cek_session_admin();
      if (isset($_POST['submit'])){
        //$this->model_clients->list_clients_tambah();
        //redirect('data');
        echo 'submittttttt';
      }else{
        $data = array();
        if (! is_level('admin')){
            die();
        }
        $this->template->load('administrator/template','view_import',$data);
      }

    }
    function do_upload(){
      if ($this->input->is_ajax_request()){
        $this->model_clients->upload_data();
      }else{
        show_404();
      }
    }
    function get_autocomplete(){
        if ($this->input->is_ajax_request())
        {

            if (isset($_GET['term'])) {
                $result = $this->model_clients_tags->search_clients_tags($_GET['term']);
                if (count($result) > 0) {
                    foreach ($result as $row)
                        $arr_result[] = array(
                            'label'         => $row->tags_title,
                            'value'         => $row->slug,
                            'description'   => $row->tags_description,
                        );
                    echo json_encode($arr_result);
                }
            }
        }

    }
    function reset_clients(){
      if ($this->input->is_ajax_request()){
        $this->model_clients->reset_db_clients();
      }else{
        show_404();
      }
    }

}
