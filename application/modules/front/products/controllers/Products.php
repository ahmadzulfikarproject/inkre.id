<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Products extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		//cek_session_admin();
		$this->load->model('model_products');
		$this->load->model('model_utama_products');
		//$this->load->model('model_products_tags');
		//$this->load->model('model_products_categories');

		$this->load->library('Ajax_pagination');
		$this->perPage = 6;
		$this->load->helper('cookie');
		//$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->config('ajax_pagination');
	}


	public function index()
	{
		cek_session_front();

		$totalRec = count($this->model_products->getproducts());
		//pagination configuration
		$config['target']      = '#enquiryList';
		$config['base_url']    = base_url() . 'products/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$data['no'] = $this->perPage;
		$this->ajax_pagination->initialize($config);

		//get the posts data
		$data['posts'] = $this->model_products->getproducts(array('limit' => $this->perPage));
		$data['start'] = 0;
		// custom paging configuration
		$config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;

		$config['full_tag_open'] = '<ul class="pagination pg-blue justify-content-center">';
		$config['full_tag_close'] = '</ul>';

		$config['first_link'] = 'First Page';
		$config['first_tag_open'] = '<li class="page-item"><span class="firstlink">';
		$config['first_tag_close'] = '</span></li>';

		$config['last_link'] = 'Last Page';
		$config['last_tag_open'] = '<li class="page-item"><span class="lastlink">';
		$config['last_tag_close'] = '</span></li>';

		$config['next_link'] = 'Next Page';
		$config['next_tag_open'] = '<li class="page-item"><span class="nextlink">';
		$config['next_tag_close'] = '</span></li>';

		$config['prev_link'] = 'Prev Page';
		$config['prev_tag_open'] = '<li class="page-item"><span class="prevlink">';
		$config['prev_tag_close'] = '</span></li>';

		$config['cur_tag_open'] = '<li class="page-item active"><span class="curlink page-link">';
		$config['cur_tag_close'] = '</span></li>';

		$config['num_tag_open'] = '<li><span class="numlink">';
		$config['num_tag_close'] = '</span></li>';
		$config['anchor_class'] = 'page-link';

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
		$this->fcore->set_meta($data, 'home');
		//$this->template->load(template().'/template',template().'/view_products_ajax',$data);
		$this->template->title = 'Produk Kami';

		// Dynamically add a css stylesheet
		//$this->template->stylesheet->add('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');
		$this->breadcrumbs->push('products', 'products');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		// Load a view in the content partial
		$this->template->content->view('view_products_ajax', $data);
		$this->template->publish();
	}
	function ajaxPaginationData()
	{
		$conditions = array();

		//calc offset number
		$page = $this->input->post('page');
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $page;
		}

		//set conditions for search
		$keywords = $this->input->post('keywords');
		$sortBy = $this->input->post('sortBy');
		$numView = $this->input->post('numView');
		$kategori = $this->input->post('kategori');
		if (!empty($keywords)) {
			$conditions['search']['keywords'] = $keywords;
		}
		if (!empty($sortBy)) {
			$conditions['search']['sortBy'] = $sortBy;
		}
		if (!empty($kategori)) {
			$conditions['search']['kategori'] = $kategori;
		}
		//total rows count
		$totalRec = count($this->model_products->getproducts($conditions));
		if (!empty($numView)) {
			//$conditions['limit'] = $numView;
			$config['per_page']    = $numView;
		} else {
			//$conditions['limit'] = $this->perPage;
			$config['per_page']    = $this->perPage;
		}
		//pagination configuration
		$config['target']      = '#enquiryList';
		$config['base_url']    = base_url() . 'products/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		//$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);

		//set start and limit
		$conditions['start'] = $offset;
		if (!empty($numView)) {
			$conditions['limit'] = $numView;
			//$config['per_page']    = $numView;
		} else {
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

		$config['full_tag_open'] = '<ul class="pagination pg-blue justify-content-center">';
		$config['full_tag_close'] = '</ul>';

		$config['first_link'] = 'First Page';
		$config['first_tag_open'] = '<li class="page-item"><span class="firstlink">';
		$config['first_tag_close'] = '</span></li>';

		$config['last_link'] = 'Last Page';
		$config['last_tag_open'] = '<li class="page-item"><span class="lastlink">';
		$config['last_tag_close'] = '</span></li>';

		$config['next_link'] = 'Next Page';
		$config['next_tag_open'] = '<li class="page-item"><span class="nextlink">';
		$config['next_tag_close'] = '</span></li>';

		$config['prev_link'] = 'Prev Page';
		$config['prev_tag_open'] = '<li class="page-item"><span class="prevlink">';
		$config['prev_tag_close'] = '</span></li>';

		$config['cur_tag_open'] = '<li class="page-item active"><span class="curlink page-link">';
		$config['cur_tag_close'] = '</span></li>';

		$config['num_tag_open'] = '<li><span class="numlink">';
		$config['num_tag_close'] = '</span></li>';
		$config['anchor_class'] = 'page-link';

		$this->ajax_pagination->initialize($config);
		//load the view
		$data['kategori'] = $this->model_products->kategori_products();
		$data['categories'] = $this->model_products->categories_products();
		$this->load->view('ajax-pagination-data', $data, false);
		//$this->template->load('administrator/template','view_products_ajax',$data);

	}
	function related($limit = 2)
	{

		$conditions = array();
		$data = array();
		//calc offset number
		$conditions['products_id'] = Globals::idPage();
		$conditions['start'] = 0;
		$conditions['limit'] = $limit;
		// echo Globals::idPage();
		//get posts data
		$data['posts'] = $this->model_products->getproducts($conditions);
		$data['post_type'] = 'products';
		// $this->template->view_part('view_products_detail', $data);
		$this->load->view('../../templates/' . template() . '/views/view_related', $data, false);
	}
	public function detail($slug = NULL)
	{
		cek_session_front();
		$this->session->set_userdata('classmenu', 'products');
		//$ids = $this->uri->segment(3);
		$ids = $slug;
		$dat = $this->db->query("SELECT * FROM products where slug='$ids' OR id_products='$ids'");
		$row = $dat->row();
		$total = $dat->num_rows();
		if ($total == 0) {
			//redirect(show_404());
			show_404();
		}
		$id_post = $dat->row_array();
		$data['title'] = $row->judul;
		$string = character_limiter(strip_tags(html_entity_decode($row->isi_products)), 300);
		$data['description'] = ($row->meta_description) ? $row->meta_description : $string;
		$data['ogimage'] = base_url() . webconfig('asset') . '/foto_products/' . $row->gambar;
		$data['record'] = $this->model_utama_products->products_detail($ids)->row_array();
		$data['slug'] = $slug;
		$data['images'] = $this->model_utama_products->getRows_products($id_post['id_products']);
		//$data['meta'] = $this->model_utama_products->products_detail($ids)->row_array();
		//$meta = 'contoh meta';
		//$this->template->set('meta_title',$data['record']['judul']);
		//$this->template->set('meta_description',$data['record']['meta_description']);

		//if (isset($data['record']['meta_title'])) {
		//	$data['record']['meta_title'] = $row->judul;
		//	# code...
		//}
		//print_r($data);
		// $this->fcore->set_meta($data['record'], 'products');
		//$this->template->load(template().'/template',template().'/view_products_detail',$data);
		$this->model_utama_products->products_update_count($ids);
		//echo 'okehhhhhh';
		//$this->add_count($slug);
		$this->template->title = ($row->meta_title) ? $row->meta_title : $data['title'];
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
		$this->breadcrumbs->push('products', 'products');
		$this->breadcrumbs->push($row->judul, $row->slug);
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		// Load a view in the content partial
		$this->template->content->view('../../templates/' . template() . '/views/view_products_detail', $data);

		// Set a partial's content
		$this->template->footer = 'Made with Twitter Bootstrap';

		// Publish the template
		//$this->template->set_template('../../templates/gentelella/view/template');
		$this->template->set_template('../../templates/' . template() . '/views/template');
		$this->template->publish();
	}

	public function categories()
	{
		cek_session_front();
		$ids = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM categories_lists where group_id=5 and slug='" . $this->db->escape_str($ids) . "'");
		$row = $dat->row();
		$total = $dat->num_rows();
		if ($total == 0) {
			redirect('utama');
		}
		$jumlah = $this->model_utama_products->hitungproductscategories($row->id)->num_rows();
		$config['base_url'] = base_url() . 'products/categories/' . $row->slug;
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 20;
		if ($this->uri->segment('4') != '') {
			$dari = $this->uri->segment('4');
		} else {
			$dari = 0;
		}

		if (is_numeric($dari)) {
			$data['categories'] = $this->model_utama_products->detail_products_categories($row->id, $dari, $config['per_page']);
		} else {
			redirect('products');
		}

		$this->pagination->initialize($config);
		$data['title'] = $row->name;
		$this->fcore->set_meta(array(), 'home');
		// $this->template->load(template().'/template',template().'/view_products_categories',$data);
		//echo 'okehhhhhhhhhhh';
		$this->template->title = $data['title'];
		$this->breadcrumbs->push('products', 'products');
		// $this->breadcrumbs->push($row->tags_title, 'products/tags/' . $row->tags_title);
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		// Dynamically add a css stylesheet
		//$this->template->stylesheet->add('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');

		// Load a view in the content partial
		//$this->template->content->view('hero', array('title' => 'Hello, world!'));
		$news = array(); // load from model (but using a dummy array here)
		$this->template->content->view('../../templates/' . template() . '/views/view_products_categories', $data);

		// Set a partial's content
		$this->template->footer = 'Made with Twitter Bootstrap';

		// Publish the template
		//$this->template->set_template('../../templates/gentelella/view/template');
		$this->template->set_template('../../templates/' . template() . '/views/template');
		$this->template->publish();
	}

	public function tags()
	{
		cek_session_front();
		$ids = $this->uri->segment(3);
		if ($ids == 'feed') {
			$data['title'] = 'Semua products';
			//======================
			$email = explode(',', contactwebsite('email'));
			$data['post_type'] = 'products';
			$data['feed_name'] = setting('site_name');
			$data['encoding'] = 'utf-8';
			$data['feed_url'] = base_url('products/feed');
			$data['url'] = base_url('products');
			$data['page_description'] = setting('site_description');
			$data['page_language'] = 'en-en';
			$data['creator_email'] = $email['0'];
			$data['tags'] = $this->model_utama_products->feed_products_tags('products');

			$data['hasil'] = $data['tags']->result_array();
			//print_r($data['posts']);

			foreach ($data['hasil'] as &$tag) {
				$tag['content'] = $tag['tags_description'] . ' ' . setting('site_description');
				$tag['judul'] = $tag['tags_title'] . ' di Jakarta Bogor Depok Tangerang Bekasi' . ' | ' . setting('site_name');
				$tag['created_time'] = $tag['updated_at'];

				unset($tag['tags_description']);
			}
			$data['posts'] = $data['hasil'];
			//print_r($data['hasil']);
			header("Content-Type: application/rss+xml");

			//$this->load->view('rss', $data);
			$this->template->load(template() . '/template_tags_rss', template() . '/view_products_rss', $data);
			# code...
		} else {

			$dat = $this->db->query("SELECT * FROM products_tags where slug='" . $this->db->escape_str($ids) . "'");
			$row = $dat->row();
			$total = $dat->num_rows();
			if ($total == 0) {
				redirect('utama');
			}
			//$jumlah= $this->model_utama_products->hitungproductstags($row->tags_id)->num_rows();
			$jumlah = $this->model_utama_products->get_hitung_products_tags('products', $row->tags_id)->num_rows();
			$config['base_url'] = base_url() . 'products/tags/' . $row->slug;
			$config['total_rows'] = $jumlah;
			$config['per_page'] = 21;
			if ($this->uri->segment('4') != '') {
				$dari = $this->uri->segment('4');
			} else {
				$dari = 0;
			}

			if (is_numeric($dari)) {
				//$data['tags'] = $this->model_utama_products->detail_products_tags($row->slug, $dari, $config['per_page']);
				$data['tags'] = $this->model_utama_products->get_detail_products_tags('products', $row->tags_id, $dari, $config['per_page']);
			} else {
				redirect('products');
			}
			$this->pagination->initialize($config);
			$data['title'] = $row->tags_title;
			$data['judul'] = $row->tags_title;
			//$this->fcore->set_meta(array(), 'home');
			// $this->fcore->set_meta($data, 'tags');
			// //print_r($data['tags']);
			// $this->template->load(template() . '/template', template() . '/view_products_tags', $data);
			// //echo 'okehhhhhhhhhhh';
			$this->template->title = $row->tags_title;

			// Dynamically add a css stylesheet
			//$this->template->stylesheet->add('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');
			$this->breadcrumbs->push('products', 'products');
			$this->breadcrumbs->push($row->tags_title, 'products/tags/' . $row->tags_title);
			$data['breadcrumbs'] = $this->breadcrumbs->show();
			// Load a view in the content partial
			$this->template->content->view('view_products_tags', $data);
			$this->template->publish();
		}
	}

	public function feed()
	{
		// cek_session_front();
		$this->load->library('feed');
		// create new instance
		$feed = new Feed();
		$dari = 0;
		$config['per_page'] = 20;
		if (is_numeric($dari)) {
			$data['products'] = $this->model_utama_products->products($dari, $config['per_page']);
		} else {
			redirect('products');
		}
		// set your feed's title, description, link, pubdate and language
		$posts = $data['products']->result();
		$feed->title = setting('site_name');
		$feed->description = setting('site_description');
		$feed->link = base_url('products/feed');
		$feed->lang = 'id';
		$feed->pubdate = (!empty($posts)) ? $posts[0]->created_time : date('Y-m-d H:i:s');
		// add posts to the feed
		if (!empty($posts)) {
			foreach ($posts as $post) {
				$post->slug = base_url('products/detail/' . $post->slug);
				// set item's title, author, url, pubdate and description
				$feed->add($post->meta_title ? $post->meta_title : $post->judul, $post->first_name . ' ' . $post->last_name, $post->slug, $post->created_time, clear_html(strip_tags($post->isi_products)));
				// $feed->add($post->judul, $post->first_name . ' ' . $post->last_name, $post->slug, $post->created_time, '');
			}
		}
		// show your feed (options: 'atom' (recommended) or 'rss')
		$feed->render('atom');
	}
}
