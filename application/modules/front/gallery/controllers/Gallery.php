 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery extends MY_Controller {
	function __construct() {
       parent::__construct();
       //cek_session_admin();
       	$this->load->model('model_gallery');
       	$this->load->model('model_utama_gallery');
		//$this->load->model('model_gallery_tags');
		//$this->load->model('model_gallery_categories');
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
		$data['title'] = 'gallery';
		$jumlah= $this->model_utama_gallery->hitunggallery()->num_rows();
		$config['base_url'] = base_url().'gallery/index';
		$config['total_rows'] = $jumlah;
		$this->session->set_userdata('classmenu', 'gallery');
		$config['per_page'] = 12; 	
			if ($this->uri->segment('3')!=''){
				$dari = $this->uri->segment('3');
			}else{
				$dari = 0;
			}

			if (is_numeric($dari)) {
				$data['gallery'] = $this->model_utama_gallery->gallery($dari, $config['per_page']);
			}else{
				redirect('gallery');
			}
		$this->pagination->initialize($config);
		$this->fcore->set_meta($data, 'home');
		$this->template->load(template().'/template',template().'/view_gallery',$data);
		*/

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
        $this->fcore->set_meta($data, 'home');
		// $this->template->load(template().'/template','view_gallery_ajax',$data);
		$this->template->title = 'Proyek - Proyek yang kami kerjakan';

		// Dynamically add a css stylesheet
		//$this->template->stylesheet->add('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');
		$this->breadcrumbs->push('gallery', 'gallery');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		// Load a view in the content partial
		$this->template->content->view('view_gallery_ajax', $data);
		$this->template->publish();
		
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
	public function detail($slug = NULL){
		cek_session_front();
		$this->session->set_userdata('classmenu', 'gallery');
		//$ids = $this->uri->segment(3);
		$ids = $slug;
		$dat = $this->db->query("SELECT * FROM gallery where slug='$ids' OR id_gallery='$ids'");
	    $row = $dat->row();
	    //print_r(expression);
	    $dataku = $dat->row_array();
	    //print_r($dataku);
	    $post_id = $dataku['id_gallery'];
	    $total = $dat->num_rows();
	        if ($total == 0){
	        	//redirect(show_404());
	        	show_404();
	        }
		$data['title'] = $row->judul;
		$string = character_limiter(strip_tags(html_entity_decode($row->isi_gallery)), 300);		
		$data['description'] = $string;
		$data['ogimage'] = base_url().webconfig('asset').'/foto_gallery/'.$row->gambar;
		$data['record'] = $this->model_utama_gallery->gallery_detail($ids)->row_array();
		$data['files'] = $this->model_utama_gallery->getRows_gallery($post_id);
		$data['slug'] = $slug;
		//$data['meta'] = $this->model_utama_gallery->gallery_detail($ids)->row_array();
		//$meta = 'contoh meta';
		//$this->template->set('meta_title',$data['record']['judul']);
		//$this->template->set('meta_description',$data['record']['meta_description']);

		//if (isset($data['record']['meta_title'])) {
		//	$data['record']['meta_title'] = $row->judul;
		//	# code...
		//}
		//print_r($data);
		// $this->fcore->set_meta($data['record'], 'gallery');
		// $this->template->load(template().'/template',template().'/view_gallery_detail',$data);

		$this->model_utama_gallery->gallery_update_count($ids);
		//echo 'okehhhhhh';
		//$this->add_count($slug);
		$this->template->title = $data['title'];
		$this->template->meta->add('description', $data['description']);
		$this->template->meta->add('keywords', $row->meta_keywords);
		$this->template->meta->add('author', 'Ahmad Zulfikar');
		$this->template->meta->add('webcrawlers', 'all');
		$this->template->meta->add('rating', 'general');
		$this->template->meta->add('spiders', 'all');
		$this->template->meta->add('image', $data['ogimage'], 'og');
		$this->template->meta->add('site_name', $this->template->title, 'og');
		$this->template->meta->add('url', base_url(), 'og');
		$this->template->meta->add('description', $data['description'], 'og');
		$this->template->meta->add('title', $this->template->title, 'og');
		$this->template->meta->add('type', 'website', 'og');
		$this->template->meta->add('locale', 'id_ID', 'og');

		// Dynamically add a css stylesheet
		//$this->template->stylesheet->add('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');
		$this->breadcrumbs->push('gallery', 'gallery');
		$this->breadcrumbs->push($row->judul, $row->slug);
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		print_r($data);
		// Load a view in the content partial
		$this->template->content->view('../../templates/' . template() . '/views/view_gallery_detail', $data);

		// Set a partial's content
		$this->template->footer = 'Made with Twitter Bootstrap';

		// Publish the template
		//$this->template->set_template('../../templates/gentelella/view/template');
		$this->template->set_template('../../templates/' . template() . '/views/template');
		$this->template->publish();
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
	    $jumlah= $this->model_utama_gallery->hitunggallerykategori($row->id_kategori)->num_rows();
		$config['base_url'] = base_url().'gallery/kategori/'.$row->kategori_seo;
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 21; 	
			if ($this->uri->segment('4')!=''){
				$dari = $this->uri->segment('4');
			}else{
				$dari = 0;
			}

			if (is_numeric($dari)) {
				$data['kategori'] = $this->model_utama_gallery->detail_gallery_kategori($row->id_kategori, $dari, $config['per_page']);
			}else{
				redirect('gallery');
			}
		$this->pagination->initialize($config);
		$data['title'] = $row->nama_kategori;
		$this->fcore->set_meta(array(), 'home'); 
		$this->template->load(template().'/template',template().'/view_gallery_kategori',$data);
		//echo 'okehhhhhhhhhhh';
	}

	public function categories(){
		cek_session_front();
		$ids = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM categories_lists where group_id=10 and slug='".$this->db->escape_str($ids)."'");
	    $row = $dat->row();
	    $total = $dat->num_rows();
	        if ($total == 0){
	        	redirect('utama');
	        }
	    $jumlah= $this->model_utama_gallery->hitunggallerycategories($row->id)->num_rows();
		$config['base_url'] = base_url().'gallery/categories/'.$row->slug;
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 20; 	
			if ($this->uri->segment('4')!=''){
				$dari = $this->uri->segment('4');
			}else{
				$dari = 0;
			}

			if (is_numeric($dari)) {
				$data['categories'] = $this->model_utama_gallery->detail_gallery_categories($row->id, $dari, $config['per_page']);
			}else{
				redirect('gallery');
			}
		$this->pagination->initialize($config);
		$data['title'] = $row->name;
		$this->fcore->set_meta(array(), 'home'); 
		$this->template->load(template().'/template',template().'/view_gallery_categories',$data);
		//echo 'okehhhhhhhhhhh';
	}

	public function tags(){
		cek_session_front();
		$ids = $this->uri->segment(3);
		if ($ids == 'feed') {
			$data['title'] = 'Semua gallery';
			//======================
			$email = explode(',',contactwebsite('email'));
			$data['post_type'] = 'gallery';
			$data['feed_name'] = setting('site_name');
	        $data['encoding'] = 'utf-8';
	        $data['feed_url'] = base_url('gallery/feed');
	        $data['url'] = base_url('gallery');
	        $data['page_description'] = idwebsite('meta_deskripsi');
	        $data['page_language'] = 'en-en';
	        $data['creator_email'] = $email['0'];
	        $data['tags'] = $this->model_utama_gallery->feed_gallery_tags('gallery');
	        
	        $data['hasil'] =$data['tags']->result_array();
	        //print_r($data['posts']);
	  
	        foreach($data['hasil'] as &$tag){
			    $tag['content'] = $tag['tags_description']. ' '.idwebsite('meta_deskripsi');
			    $tag['judul'] = $tag['tags_title'].' di Jakarta Bogor Depok Tangerang Bekasi'.' | '.setting('site_name');
			    $tag['created_time'] = $tag['updated_at'];
			    
			    unset($tag['tags_description']);
			} 
			$data['posts'] = $data['hasil'];
			//print_r($data['hasil']);      
	        header("Content-Type: application/rss+xml");
	         
	        //$this->load->view('rss', $data);
	        $this->template->load(template().'/template_tags_rss',template().'/view_gallery_rss',$data);
			# code...
		}
		else{

			$dat = $this->db->query("SELECT * FROM gallery_tags where slug='".$this->db->escape_str($ids)."'");
		    $row = $dat->row();
		    $total = $dat->num_rows();
		        if ($total == 0){
		        	redirect('utama');
		        }
		    //$jumlah= $this->model_utama_gallery->hitunggallerytags($row->tags_id)->num_rows();
		    $jumlah= $this->model_utama_gallery->get_hitung_gallery_tags('gallery',$row->tags_id)->num_rows();
			$config['base_url'] = base_url().'gallery/tags/'.$row->slug;
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 21; 	
				if ($this->uri->segment('4')!=''){
					$dari = $this->uri->segment('4');
				}else{
					$dari = 0;
				}

				if (is_numeric($dari)) {
					//$data['tags'] = $this->model_utama_gallery->detail_gallery_tags($row->slug, $dari, $config['per_page']);
					$data['tags'] = $this->model_utama_gallery->get_detail_gallery_tags('gallery',$row->tags_id, $dari, $config['per_page']);
				}else{
					redirect('gallery');
				}
			$this->pagination->initialize($config);
			$data['title'] = $row->tags_title;
			$data['judul'] = $row->tags_title;
			//$this->fcore->set_meta(array(), 'home'); 
			$this->fcore->set_meta($data, 'tags');
			//print_r($data['tags']);
			$this->template->load(template().'/template',template().'/view_gallery_tags',$data);
			//echo 'okehhhhhhhhhhh';

		}
	}
	public function feed()
	{
		//$this->load->helper('xml');
        //$this->load->helper('text');

        cek_session_front();
		$data['title'] = 'Semua gallery';
		$jumlah= $this->model_utama_gallery->hitunggallery()->num_rows();
		$config['base_url'] = base_url().'gallery/index';
		$config['total_rows'] = $jumlah;
		$this->session->set_userdata('classmenu', 'gallery');
		$config['per_page'] = 20; 	
			if ($this->uri->segment('3')!=''){
				$dari = $this->uri->segment('3');
			}else{
				$dari = 0;
			}

			if (is_numeric($dari)) {
				$data['gallery'] = $this->model_utama_gallery->gallery($dari, $config['per_page']);
			}else{
				redirect('gallery');
			}
		$this->pagination->initialize($config);
		//$this->fcore->set_meta(array(), 'home');
		//$this->template->load(template().'/template_rss',template().'/view_gallery_rss',$data);
		$email = explode(',',contactwebsite('email'));
		$data['post_type'] = 'gallery';
		$data['feed_name'] = setting('site_name');
        $data['encoding'] = 'utf-8';
        $data['feed_url'] = base_url('gallery/feed');
        $data['url'] = base_url('gallery');
        $data['page_description'] = idwebsite('meta_deskripsi');
        $data['page_language'] = 'en-en';
        $data['creator_email'] = $email['0'];
        
        
        $data['hasil'] =$data['gallery']->result_array();
        //print_r($data['posts']);
  
        foreach($data['hasil'] as &$tag){
		    $tag['content'] = $tag['isi_gallery'];
		    $tag['judul'] = $tag['judul'];
		    unset($tag['isi_gallery']);
		} 
		$data['posts'] = $data['hasil'];
		//print_r($data['hasil']);     
        header("Content-Type: application/rss+xml");
         
        //$this->load->view('rss', $data);
        $this->template->load(template().'/template_rss',template().'/view_gallery_rss',$data);
	}
}
