<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery extends MY_AdminController {
	function __construct(){
		parent::__construct();
		$this->load->model('model_gallery');
        $this->load->model('model_gallery_tags');
        $this->load->model('model_gallery_categories');
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
		$data['record'] = $this->model_gallery->list_gallery();

		$data['rss'] = $this->model_gallery->list_gallery_rss();
        $data['iden'] = $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        //$this->load->view(template().'/gallery-rss',$data);
        //$this->fcore->set_meta($data['rss'], 'gallery');
        //$this->template->loadrss(template().'/gallery-rss',$data);
		$this->template->load('administrator/template','view_gallery',$data);
	}
	function index(){
		cek_session_admin();
		$totalRec = count($this->model_gallery->getgallery());
		//pagination configuration
        $config['target']      = '#enquiryList';
        $config['base_url']    = base_url().'gallery/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $data['no'] = $this->perPage;
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['posts'] = $this->model_gallery->getgallery(array('limit'=>$this->perPage));
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
		$data['record'] = $this->model_gallery->list_gallery();
		$data['kategori'] = $this->model_gallery->kategori_gallery();
		$data['categories'] = $this->model_gallery->categories_gallery();
		//print_r($data['kategori']->result_array());
		//print_r($data['record']->row_array());
		$data['rss'] = $this->model_gallery->list_gallery_rss();
        $data['iden'] = $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        //$this->load->view(template().'/rss',$data);
        //$this->template->loadrss(template().'/rss',$data);
        //tagrss
        //$data['rss_tags'] = $this->model_gallery->list_gallery_rss_tags();
        //$this->template->loadrss(template().'/rss_tags',$data);
        //view
		$this->template->load('administrator/template','view_gallery_ajax',$data);
        
       
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
        $totalRec = count($this->model_gallery->getgallery($conditions));
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
        $config['base_url']    = base_url().'gallery/ajaxPaginationData';
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
        $data['posts'] = $this->model_gallery->getgallery($conditions);
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
        $data['kategori'] = $this->model_gallery->kategori_gallery();
        $data['categories'] = $this->model_gallery->categories_gallery();
        $this->load->view('ajax-pagination-data', $data, false);
        //$this->template->load('administrator/template','view_gallery_ajax',$data);

    }
	// produk
	// Controller Modul List produk

	function cepat_gallery(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_gallery->list_gallery_cepat();
			redirect('gallery');
		}
	} 

	function tambah_gallery(){
		cek_session_admin();
		if (isset($_POST['submit'])){

            $this->model_gallery->list_gallery_tambah();
            // print_r($this->db->insert_id());
			//$tags = $this->db->escape_str($this->input->post('tagshasil'));
			//$this->model_gallery_tags->insert_gallery_tagsdb($tags);
			redirect('gallery');
		}
		elseif (isset($_POST['savenew'])) {
			# code...
			//$tags = $this->db->escape_str($this->input->post('tagshasil'));
			$this->model_gallery->list_gallery_tambah();
			//$this->model_gallery_tags->insert_gallery_tagsdb($tags);
			redirect('tambah_gallery');
		}
		else{
            $data['tag'] = $this->model_gallery->tag_gallery();
			$data['record'] = $this->model_gallery->categories_gallery();
			// $data['users'] = $this->model_users->users();
			$this->template->load('administrator/template','view_gallery_tambah',$data);
		}
	}

	function edit_gallery(){
		cek_session_admin();
		$id = $this->uri->segment(3);
        $post_id = $this->db->escape_str($this->input->post('id'));
		if (isset($_POST['submit'])){

			//$tags = $this->db->escape_str($this->input->post('tagshasil'));
			$this->model_gallery->list_gallery_update();
            $this->model_gallery->list_gallery_uploadimg($post_id,'gallery');
			//$this->model_gallery_tags->insert_gallery_tagsdb($tags);

			//add tags
			$tags = $this->db->escape_str($this->input->post('tagshasil'));
            if (!empty($tags)) {
    			$this->model_gallery_tags->insert_gallery_tagsdb($tags);
    			$post_id = $this->db->escape_str($this->input->post('id'));
    			$this->model_gallery_tags->insert_gallery_tagsmap($tags,$post_id,'gallery');
            }
			
			redirect('gallery');
		}
		elseif (isset($_POST['update'])) {
			# code...
			//$tags = $this->db->escape_str($this->input->post('tagshasil'));
			$this->model_gallery->list_gallery_update();
            $this->model_gallery->list_gallery_uploadimg($post_id,'gallery');
			//$this->model_gallery_tags->insert_gallery_tagsdb($tags);
			//add tags
			$tags = $this->db->escape_str($this->input->post('tagshasil'));
            if (!empty($tags)) {
    			$this->model_gallery_tags->insert_gallery_tagsdb($tags);
    			$post_id = $this->db->escape_str($this->input->post('id'));
    			$this->model_gallery_tags->insert_gallery_tagsmap($tags,$post_id,'gallery');
            }

			redirect('gallery/edit_gallery/'.$_POST['id']);
		}
		else{
			$post_id = $this->db->escape_str($this->input->post('id'));
			//echo $post_id;
			$data['tags'] = $this->model_gallery->tags_gallery($id);

			$data['tag'] = $this->model_gallery->tag_gallery();
			$data['record'] = $this->model_gallery->categories_gallery();
			$data['rows'] = $this->model_gallery->list_gallery_edit($id)->row_array();
			// $data['users'] = $this->model_users->users();
            $data['files'] = $this->model_gallery->getRows_gallery($id);
            //alert($id);
            //print_r($data['files']);
			//print_r($data['tags']->row_array());
			$this->template->load('administrator/template','view_gallery_edit',$data);
		}
	}

	function delete_gallery(){
		$id = $this->uri->segment(3);
		$this->model_gallery->list_gallery_delete($id);
		redirect('gallery');
	}
	function update_semua_gallery(){
		cek_session_admin();
		$config = array(
                'field' => 'slug',
                'title' => 'judul',
                'table' => 'gallery',
                'id' => 'id_gallery',
            );
            $this->load->library('slug', $config);
		// Get title and id form database
	    // Assuming that $results includes row ID and title
	    $results = $this->model_gallery->list_gallery();

	    // Set $data array but leave it empty for now.
	    $data = array();
	    //print_r($results->result_array());
	    // Get key and value
	    foreach ($results->result_array() as $key => $value)
	    {
            if (!empty($value['gambar'])) {
                
                if (file_exists('../asset/foto_gallery/'.$value['gambar'])){
                    delete_thumb('../asset/foto_gallery/'.$value['gambar'],'foto_gallery');
                    thumb('../asset/foto_gallery/'.$value['gambar'],'400','200',false);
                }
            }
            
	        // Clean the slug
	        $cleanslug = $this->slug->create_uri($value['judul']);
	        

	        // Add cleaned title and id to new data array.
	        // By using the key value, we create a new array for each row
	        // in the already existsing data array that we created earlier.
	        // This also gives us the correct formatted array for update_batch()
	        // function later.
	        
	        $data[$key]['id_gallery']    = $value['id_gallery'];
	        $data[$key]['slug'] = $cleanslug;
	        $data[$key]['username'] = 'administrator';
	        
	    }

        $files = $this->model_gallery->getRows_gallery();
        foreach ($files as $file) {
            # code...
            if (!empty($file['file_name'])) {
            
                if (file_exists('../asset/foto_gallery/gallery/'.$file['file_name'])){
                    delete_thumb('../asset/foto_gallery/gallery/'.$file['file_name'],'foto_gallery/gallery');
                    thumb('../asset/foto_gallery/gallery/'.$file['file_name'],'400','200',TRUE);
                }
            }

        }
	    // Print out array for debug
	    //print_r($data);

	    // Update database
	    //===$this->model_gallery->update_gallery($data);
		//$data['record'] = $this->model_gallery->semua_galleryterbaru();
		
		 //$this->model_gallery->semua_gallery();
		//print_r($data);
		//$this->model_gallery->update_semua_gallery();
		redirect('gallery');
	}
    //fikar custom
    function import(){
      cek_session_admin();
      if (isset($_POST['submit'])){
        //$this->model_gallery->list_gallery_tambah();
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
        $this->model_gallery->upload_data();
      }else{
        show_404();
      }
    }
    function get_autocomplete(){
        if ($this->input->is_ajax_request())
        {

            if (isset($_GET['term'])) {
                $result = $this->model_gallery_tags->search_gallery_tags($_GET['term']);
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
    function reset_gallery(){
      if ($this->input->is_ajax_request()){
        $this->model_gallery->reset_db_gallery();
      }else{
        show_404();
      }
    }

}
