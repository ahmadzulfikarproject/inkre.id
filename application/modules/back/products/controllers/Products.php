<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends MY_AdminController {
	function __construct(){
		parent::__construct();
		$this->load->model('model_products');
        $this->load->model('model_products_tags');
        $this->load->model('model_products_categories');
        $this->load->model('model_products_attachment');
		$this->load->library('Ajax_pagination');
        $this->perPage = 4;
        $this->load->helper('cookie');
        // $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('date');
		//error_reporting(0);
	}
	function index2(){
		cek_session_admin();
		$data['record'] = $this->model_products->list_products();

		$data['rss'] = $this->model_products->list_products_rss();
        $data['iden'] = $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        //$this->load->view(template().'/products-rss',$data);
        //$this->fcore->set_meta($data['rss'], 'products');
        //$this->template->loadrss(template().'/products-rss',$data);
		$this->template->load('administrator/template','view_products',$data);
	}
	function index(){
		cek_session_admin();
		$totalRec = count($this->model_products->getproducts());
		//pagination configuration
        $config['target']      = '#enquiryList';
        $config['base_url']    = base_url().'products/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $data['no'] = $this->perPage;
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['posts'] = $this->model_products->getproducts(array('limit'=>$this->perPage));
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
		$data['record'] = $this->model_products->list_products();
		$data['kategori'] = $this->model_products->kategori_products();
		$data['categories'] = $this->model_products->categories_products();
		//print_r($data['kategori']->result_array());
		//print_r($data['record']->row_array());
		$data['rss'] = $this->model_products->list_products_rss();
        $data['iden'] = $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        //$this->load->view(template().'/rss',$data);
        //$this->template->loadrss(template().'/rss',$data);
        //tagrss
        //$data['rss_tags'] = $this->model_products->list_products_rss_tags();
        //$this->template->loadrss(template().'/rss_tags',$data);
        //view
		$this->template->load('administrator/template','view_products_ajax',$data);
        
       
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
        $totalRec = count($this->model_products->getproducts($conditions));
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
        $config['base_url']    = base_url().'products/ajaxPaginationData';
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
        $data['posts'] = $this->model_products->getproducts($conditions);
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
        $data['kategori'] = $this->model_products->kategori_products();
        $data['categories'] = $this->model_products->categories_products();
        $this->load->view('ajax-pagination-data', $data, false);
        //$this->template->load('administrator/template','view_products_ajax',$data);

    }
	// produk
	// Controller Modul List produk
    function featured(){
        cek_session_admin();
        $data['posts'] = $this->model_products->featured_products();
        $this->template->load('administrator/template','view_featured_products',$data);
    }
    public function reorder_featured()
    {
        if ($this->input->is_ajax_request())
        {
            $arr   = array();
            $order = $this->input->post('order');

            parse_str($order, $arr);

            $this->model_products->reorder_featured($arr['item']);
        }
        else
        {
            show_404();
        }
    }

	function cepat_products(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_products->list_products_cepat();
			redirect('products');
		}
	} 

	function tambah_products(){
		cek_session_admin();
		if (isset($_POST['submit'])){

			$this->model_products->list_products_tambah();
			//$tags = $this->db->escape_str($this->input->post('tagshasil'));
			//$this->model_products_tags->insert_products_tagsdb($tags);
			redirect('products');
		}
		elseif (isset($_POST['savenew'])) {
			# code...
			//$tags = $this->db->escape_str($this->input->post('tagshasil'));
			$this->model_products->list_products_tambah();
			//$this->model_products_tags->insert_products_tagsdb($tags);
			redirect('products/tambah_products');
		}
		else{
			$data['tag'] = $this->model_products->tag_products();
			$data['record'] = $this->model_products->categories_products();
			// $data['users'] = $this->model_users->users();
			$this->template->load('administrator/template','view_products_tambah',$data);
		}
	}

	function edit_products(){
		cek_session_admin();
		$id = $this->uri->segment(3);
        $post_id = $this->db->escape_str($this->input->post('id'));
		if (isset($_POST['submit'])){

			//$tags = $this->db->escape_str($this->input->post('tagshasil'));
			$this->model_products->list_products_update();
            $this->model_products->list_products_uploadimg($post_id,'products');
			//$this->model_products_tags->insert_products_tagsdb($tags);

			//add tags
			$tags = $this->db->escape_str($this->input->post('tagshasil'));
            if (!empty($tags)) {
    			$this->model_products_tags->insert_products_tagsdb($tags);
    			//$post_id = $this->db->escape_str($this->input->post('id'));
    			$this->model_products_tags->insert_products_tagsmap($tags,$post_id,'products');
            }
			
			redirect('products'); 
		}
		elseif (isset($_POST['update'])) {
			# code...
			//$tags = $this->db->escape_str($this->input->post('tagshasil'));
			$this->model_products->list_products_update();
            $this->model_products->list_products_uploadimg($post_id,'products');
            $this->model_products_attachment->list_products_attachment($post_id,'products');
			//$this->model_products_tags->insert_products_tagsdb($tags);
			//add tags
			$tags = $this->db->escape_str($this->input->post('tagshasil'));
            if (!empty($tags)) {
    			$this->model_products_tags->insert_products_tagsdb($tags);
    			//$post_id = $this->db->escape_str($this->input->post('id'));
    			$this->model_products_tags->insert_products_tagsmap($tags,$post_id,'products');
            }

			redirect('products/edit_products/'.$_POST['id']);
		}
		else{
			//$post_id = $this->db->escape_str($this->input->post('id'));
			//echo $post_id;
			$data['tags'] = $this->model_products->tags_products($id);
            $data['files'] = $this->model_products_attachment->getRows_attachment($id);
			$data['tag'] = $this->model_products->tag_products();
			$data['record'] = $this->model_products->categories_products();
			$data['rows'] = $this->model_products->list_products_edit($id)->row_array();
			// $data['users'] = $this->model_users->users();
            $data['images'] = $this->model_products->getRows_products($id);

			//print_r($data['tags']->row_array());
			$this->template->load('administrator/template','view_products_edit',$data);
		}
	}

	function delete_products(){
		$id = $this->uri->segment(3);
		$this->model_products->list_products_delete($id);
		redirect('products');
	}
	function update_semua_products(){
		cek_session_admin();
		$config = array(
                'field' => 'slug',
                'title' => 'judul',
                'table' => 'products',
                'id' => 'id_products',
            );
            $this->load->library('slug', $config);
		// Get title and id form database
	    // Assuming that $results includes row ID and title
	    $results = $this->model_products->list_products();

	    // Set $data array but leave it empty for now.
	    $data = array();
	    //print_r($results->result_array());
	    // Get key and value
	    foreach ($results->result_array() as $key => $value)
	    {
            if (!empty($value['gambar'])) {
                
                if (file_exists('../asset/foto_products/'.$value['gambar'])){
                    delete_thumb('../asset/foto_products/'.$value['gambar'],'foto_products');
                    thumb('../asset/foto_products/'.$value['gambar'],'400','200',false);
                }
            }
	        // Clean the slug
	        $cleanslug = $this->slug->create_uri($value['judul']);
	        

	        // Add cleaned title and id to new data array.
	        // By using the key value, we create a new array for each row
	        // in the already existsing data array that we created earlier.
	        // This also gives us the correct formatted array for update_batch()
	        // function later.
	        
	        $data[$key]['id_products']    = $value['id_products'];
	        $data[$key]['slug'] = $cleanslug;
	        $data[$key]['username'] = 'administrator';
	        
	    }

	    // Print out array for debug
	    //print_r($data);

	    // Update database
	    //======$this->model_products->update_products($data);
		//$data['record'] = $this->model_products->semua_productsterbaru();
		
		 //$this->model_products->semua_products();
		//print_r($data);
		//$this->model_products->update_semua_products();
		redirect('products');
	}
    //fikar custom
    function import(){
      cek_session_admin();
      if (isset($_POST['submit'])){
        //$this->model_products->list_products_tambah();
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
        $this->model_products->upload_data();
      }else{
        show_404();
      }
    }
    function get_autocomplete(){
        if ($this->input->is_ajax_request())
        {

            if (isset($_GET['term'])) {
                $result = $this->model_products_tags->search_products_tags($_GET['term']);
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
    function reset_products(){
      if ($this->input->is_ajax_request()){
        $this->model_products->reset_db_products();
      }else{
        show_404();
      }
    }

}
