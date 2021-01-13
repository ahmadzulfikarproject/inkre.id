 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sertifikat extends MY_Controller {
	function __construct() {
       parent::__construct();
       //cek_session_admin();
       	$this->load->model('model_sertifikat');
       	$this->load->model('model_utama_sertifikat');
		//$this->load->model('model_sertifikat_tags');
		//$this->load->model('model_sertifikat_categories');
		$this->load->library('Ajax_pagination');
		$this->perPage = 12;
		$this->load->helper('cookie');
		//$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('date');
    }

	
	public function index(){
		cek_session_front();
		/*
		$data['title'] = 'sertifikat';
		$jumlah= $this->model_utama_sertifikat->hitungsertifikat()->num_rows();
		$config['base_url'] = base_url().'sertifikat/index';
		$config['total_rows'] = $jumlah;
		$this->session->set_userdata('classmenu', 'sertifikat');
		$config['per_page'] = 12; 	
			if ($this->uri->segment('3')!=''){
				$dari = $this->uri->segment('3');
			}else{
				$dari = 0;
			}

			if (is_numeric($dari)) {
				$data['sertifikat'] = $this->model_utama_sertifikat->sertifikat($dari, $config['per_page']);
			}else{
				redirect('sertifikat');
			}
		$this->pagination->initialize($config);
		$this->fcore->set_meta($data, 'home');
		$this->template->load(template().'/template',template().'/view_sertifikat',$data);
		*/

		$totalRec = count($this->model_sertifikat->getsertifikat());
		//pagination configuration
        $config['target']      = '#enquiryList';
        $config['base_url']    = base_url().'sertifikat/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $data['no'] = $this->perPage;
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['posts'] = $this->model_sertifikat->getsertifikat(array('limit'=>$this->perPage));
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
		$data['record'] = $this->model_sertifikat->list_sertifikat();
		$data['kategori'] = $this->model_sertifikat->kategori_sertifikat();
		$data['categories'] = $this->model_sertifikat->categories_sertifikat();
		//print_r($data['kategori']->result_array());
		//print_r($data['record']->row_array());
		$data['rss'] = $this->model_sertifikat->list_sertifikat_rss();
        $data['iden'] = $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        //$this->load->view(template().'/rss',$data);
        //$this->template->loadrss(template().'/rss',$data);
        //tagrss
        //$data['rss_tags'] = $this->model_sertifikat->list_sertifikat_rss_tags();
        //$this->template->loadrss(template().'/rss_tags',$data);
        //view
        $this->fcore->set_meta($data, 'home');
		$this->template->load(template().'/template','view_sertifikat_ajax',$data);
		
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
        $totalRec = count($this->model_sertifikat->getsertifikat($conditions));
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
        $config['base_url']    = base_url().'sertifikat/ajaxPaginationData';
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
        $data['posts'] = $this->model_sertifikat->getsertifikat($conditions);
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
        $data['kategori'] = $this->model_sertifikat->kategori_sertifikat();
        $data['categories'] = $this->model_sertifikat->categories_sertifikat();
        $this->load->view('ajax-pagination-data', $data, false);
        //$this->template->load('administrator/template','view_sertifikat_ajax',$data);

    }
	public function detail($slug = NULL){
		cek_session_front();
		$this->session->set_userdata('classmenu', 'sertifikat');
		//$ids = $this->uri->segment(3);
		$ids = $slug;
		$dat = $this->db->query("SELECT * FROM sertifikat where slug='$ids' OR id_sertifikat='$ids'");
	    $row = $dat->row();
	    $total = $dat->num_rows();
	        if ($total == 0){
	        	//redirect(show_404());
	        	show_404();
	        }
		$data['title'] = $row->judul;
		$string = character_limiter(strip_tags(html_entity_decode($row->isi_sertifikat)), 300);		
		$data['description'] = $string;
		$data['ogimage'] = base_url().webconfig('asset').'/foto_sertifikat/'.$row->gambar;
		$data['record'] = $this->model_utama_sertifikat->sertifikat_detail($ids)->row_array();
		$data['slug'] = $slug;
		//$data['meta'] = $this->model_utama_sertifikat->sertifikat_detail($ids)->row_array();
		//$meta = 'contoh meta';
		//$this->template->set('meta_title',$data['record']['judul']);
		//$this->template->set('meta_description',$data['record']['meta_description']);

		//if (isset($data['record']['meta_title'])) {
		//	$data['record']['meta_title'] = $row->judul;
		//	# code...
		//}
		//print_r($data);
		$this->fcore->set_meta($data['record'], 'sertifikat');
		$this->template->load(template().'/template',template().'/view_sertifikat_detail',$data);
		$this->model_utama_sertifikat->sertifikat_update_count($ids);
		//echo 'okehhhhhh';
		//$this->add_count($slug);
	}

	public function kategori(){
		cek_session_front();
		$ids = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM kategori where kategori_seo='".$this->db->escape_str($ids)."'");
	    $row = $dat->row();
	    $total = $dat->num_rows();
	        if ($total == 0){
	        	redirect('utama');
	        }
	    $jumlah= $this->model_utama_sertifikat->hitungsertifikatkategori($row->id_kategori)->num_rows();
		$config['base_url'] = base_url().'sertifikat/kategori/'.$row->kategori_seo;
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 21; 	
			if ($this->uri->segment('4')!=''){
				$dari = $this->uri->segment('4');
			}else{
				$dari = 0;
			}

			if (is_numeric($dari)) {
				$data['kategori'] = $this->model_utama_sertifikat->detail_sertifikat_kategori($row->id_kategori, $dari, $config['per_page']);
			}else{
				redirect('sertifikat');
			}
		$this->pagination->initialize($config);
		$data['title'] = $row->nama_kategori;
		$this->fcore->set_meta(array(), 'home'); 
		$this->template->load(template().'/template',template().'/view_sertifikat_kategori',$data);
		//echo 'okehhhhhhhhhhh';
	}

	public function categories(){
		cek_session_front();
		$ids = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM categories_lists where group_id=11 and slug='".$this->db->escape_str($ids)."'");
	    $row = $dat->row();
	    $total = $dat->num_rows();
	        if ($total == 0){
	        	redirect('utama');
	        }
	    $jumlah= $this->model_utama_sertifikat->hitungsertifikatcategories($row->id)->num_rows();
		$config['base_url'] = base_url().'sertifikat/categories/'.$row->slug;
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 20; 	
			if ($this->uri->segment('4')!=''){
				$dari = $this->uri->segment('4');
			}else{
				$dari = 0;
			}

			if (is_numeric($dari)) {
				$data['categories'] = $this->model_utama_sertifikat->detail_sertifikat_categories($row->id, $dari, $config['per_page']);
			}else{
				redirect('sertifikat');
			}
		$this->pagination->initialize($config);
		$data['title'] = $row->name;
		$this->fcore->set_meta(array(), 'home'); 
		$this->template->load(template().'/template',template().'/view_sertifikat_categories',$data);
		//echo 'okehhhhhhhhhhh';
	}

	public function tags(){
		cek_session_front();
		$ids = $this->uri->segment(3);
		if ($ids == 'feed') {
			$data['title'] = 'Semua sertifikat';
			//======================
			$email = explode(',',contactwebsite('email'));
			$data['post_type'] = 'sertifikat';
			$data['feed_name'] = setting('site_name');
	        $data['encoding'] = 'utf-8';
	        $data['feed_url'] = base_url('sertifikat/feed');
	        $data['url'] = base_url('sertifikat');
	        $data['page_description'] = setting('site_description');
	        $data['page_language'] = 'en-en';
	        $data['creator_email'] = $email['0'];
	        $data['tags'] = $this->model_utama_sertifikat->feed_sertifikat_tags('sertifikat');
	        
	        $data['hasil'] =$data['tags']->result_array();
	        //print_r($data['posts']);
	  
	        foreach($data['hasil'] as &$tag){
			    $tag['content'] = $tag['tags_description']. ' '.setting('site_description');
			    $tag['judul'] = $tag['tags_title'].' di Jakarta Bogor Depok Tangerang Bekasi'.' | '.setting('site_name');
			    $tag['tgl_posting'] = $tag['updated_at'];
			    
			    unset($tag['tags_description']);
			} 
			$data['posts'] = $data['hasil'];
			//print_r($data['hasil']);      
	        header("Content-Type: application/rss+xml");
	         
	        //$this->load->view('rss', $data);
	        $this->template->load(template().'/template_tags_rss',template().'/view_sertifikat_rss',$data);
			# code...
		}
		else{

			$dat = $this->db->query("SELECT * FROM sertifikat_tags where slug='".$this->db->escape_str($ids)."'");
		    $row = $dat->row();
		    $total = $dat->num_rows();
		        if ($total == 0){
		        	redirect('utama');
		        }
		    //$jumlah= $this->model_utama_sertifikat->hitungsertifikattags($row->tags_id)->num_rows();
		    $jumlah= $this->model_utama_sertifikat->get_hitung_sertifikat_tags('sertifikat',$row->tags_id)->num_rows();
			$config['base_url'] = base_url().'sertifikat/tags/'.$row->slug;
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 21; 	
				if ($this->uri->segment('4')!=''){
					$dari = $this->uri->segment('4');
				}else{
					$dari = 0;
				}

				if (is_numeric($dari)) {
					//$data['tags'] = $this->model_utama_sertifikat->detail_sertifikat_tags($row->slug, $dari, $config['per_page']);
					$data['tags'] = $this->model_utama_sertifikat->get_detail_sertifikat_tags('sertifikat',$row->tags_id, $dari, $config['per_page']);
				}else{
					redirect('sertifikat');
				}
			$this->pagination->initialize($config);
			$data['title'] = $row->tags_title;
			$data['judul'] = $row->tags_title;
			//$this->fcore->set_meta(array(), 'home'); 
			$this->fcore->set_meta($data, 'tags');
			//print_r($data['tags']);
			$this->template->load(template().'/template',template().'/view_sertifikat_tags',$data);
			//echo 'okehhhhhhhhhhh';

		}
	}
	public function feed()
	{
		//$this->load->helper('xml');
        //$this->load->helper('text');

        cek_session_front();
		$data['title'] = 'Semua sertifikat';
		$jumlah= $this->model_utama_sertifikat->hitungsertifikat()->num_rows();
		$config['base_url'] = base_url().'sertifikat/index';
		$config['total_rows'] = $jumlah;
		$this->session->set_userdata('classmenu', 'sertifikat');
		$config['per_page'] = 20; 	
			if ($this->uri->segment('3')!=''){
				$dari = $this->uri->segment('3');
			}else{
				$dari = 0;
			}

			if (is_numeric($dari)) {
				$data['sertifikat'] = $this->model_utama_sertifikat->sertifikat($dari, $config['per_page']);
			}else{
				redirect('sertifikat');
			}
		$this->pagination->initialize($config);
		//$this->fcore->set_meta(array(), 'home');
		//$this->template->load(template().'/template_rss',template().'/view_sertifikat_rss',$data);
		$email = explode(',',contactwebsite('email'));
		$data['post_type'] = 'sertifikat';
		$data['feed_name'] = setting('site_name');
        $data['encoding'] = 'utf-8';
        $data['feed_url'] = base_url('sertifikat/feed');
        $data['url'] = base_url('sertifikat');
        $data['page_description'] = setting('site_description');
        $data['page_language'] = 'en-en';
        $data['creator_email'] = $email['0'];
        
        
        $data['hasil'] =$data['sertifikat']->result_array();
        //print_r($data['posts']);
  
        foreach($data['hasil'] as &$tag){
		    $tag['content'] = $tag['isi_sertifikat'];
		    $tag['judul'] = $tag['judul'];
		    unset($tag['isi_sertifikat']);
		} 
		$data['posts'] = $data['hasil'];
		//print_r($data['hasil']);     
        header("Content-Type: application/rss+xml");
         
        //$this->load->view('rss', $data);
        $this->template->load(template().'/template_rss',template().'/view_sertifikat_rss',$data);
	}
}
