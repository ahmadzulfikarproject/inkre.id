<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Berita extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_berita');
		$this->load->model('model_utama_berita');
		// $this->output->cache(1);
		// $this->output->delete_cache();

	}
	public function index()
	{
		cek_session_front();
		$this->session->set_userdata('classmenu', 'berita');

		if (isset($_POST['submit'])) {
			$keyword = cetak($this->input->post('cari'));
			$data['title'] = 'Pencarian keyword : ' . $keyword;
			$data['search_keyword'] = $keyword;
			$data['berita'] = $this->model_utama->semua_berita_cari(0, 5, $keyword);
		} else {
			$data['title'] = 'Berita';
			if ($this->uri->segment('3') != '') {
				$dari = $this->uri->segment('3');
			} else {
				$dari = 0;
			}
			$config['base_url'] = base_url() . 'berita/index';
			$config['per_page'] = 5;
			$jumlah = $this->model_utama->hitungberita()->num_rows();
			if (is_numeric($dari)) {
				$data['berita'] = $this->model_utama->semua_berita($dari, $config['per_page']);
			} else {
				redirect('berita');
			}
			$config['total_rows'] = $jumlah;
			$this->pagination->initialize($config);
		}
		//$this->fcore->set_meta(array(), 'home');
		$data['judul'] = $data['title'];
		$this->breadcrumbs->push('Berita', 'berita');
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		$this->fcore->set_meta($data, 'index');
		//$this->template->load(template().'/template',template().'/view_semua_berita_list',$data);
		$this->template->title = $data['title'];

		// Dynamically add a css stylesheet
		//$this->template->stylesheet->add('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');

		// Load a view in the content partial
		//$this->template->content->view('hero', array('title' => 'Hello, world!'));
		$news = array(); // load from model (but using a dummy array here)
		$this->template->content->view('../../templates/' . template() . '/views/view_semua_berita_list', $data);

		// Set a partial's content
		$this->template->footer = 'Made with Twitter Bootstrap';

		// Publish the template
		//$this->template->set_template('../../templates/gentelella/view/template');
		$this->template->set_template('../../templates/' . template() . '/views/template');
		$this->template->publish();
	}
	function related($limit = 2)
	{

		$conditions = array();
		$data = array();
		//calc offset number
		$conditions['berita_id'] = Globals::idPage();
		$conditions['start'] = 0;
		$conditions['limit'] = $limit;
		//echo Globals::idPage();
		//get posts data
		$data['posts'] = $this->model_berita->getberita($conditions);
		$data['post_type'] = 'berita';
		$this->load->view('../../templates/' . template() . '/views/view_related', $data, false);
	}
	public function detail($slug = NULL)
	{
		cek_session_front();
		$this->session->set_userdata('classmenu', 'berita');
		//$ids = $this->uri->segment(3);
		$ids = $slug;
		$dat = $this->db->query("SELECT * FROM berita a JOIN users b on a.username=b.username where slug='$ids' OR id_berita='$ids'");
		$row = $dat->row();
		$total = $dat->num_rows();
		if ($total == 0) {
			redirect('utama');
		}
		$id_post = $dat->row_array();
		$data['title'] = $row->judul;
		$data['meta_title'] = $row->meta_title;
		$string = character_limiter(strip_tags(html_entity_decode($row->isi_berita)), 300);
		$data['description'] = $string;
		$data['ogimage'] = base_url() . webconfig('asset') . '/foto_berita/' . $row->gambar;
		$data['record'] = $this->model_utama->berita_detail($ids)->row_array();
		$data['infoterkait'] = $this->model_utama->info_terkait(3, $row->tag, $ids);
		$data['images'] = $this->model_utama_berita->getRows_berita($id_post['id_berita']);

		$this->load->helper('captcha');
		$vals = array(
			'img_path'	 => './captcha/',
			'img_url'	 => base_url() . 'captcha/',
			'font_path' => set_realpath('./asset/entsans.ttf'),
			'font_size'     => 16,
			'img_width'	 => '100',
			'img_height' => 30,
			'border' => 0,
			'word_length'   => 5,
			'expiration' => 7200
		);

		$cap = create_captcha($vals);
		$data['image'] = $cap['image'];
		$this->session->set_userdata('mycaptcha', $cap['word']);
		//$this->fcore->set_meta(array(), 'home');
		$this->fcore->set_meta($data['record'], 'berita');
		$data['tags'] = $this->model_berita->tags_berita($row->id_berita);
		//$this->template->load(template().'/template',template().'/view_berita_detail',$data);
		//$this->model_utama->berita_dibaca_update($ids);
		$this->model_utama->berita_update_count($ids);
		//echo 'okehhhhhh';
		//$this->add_count($slug);
		$this->template->title = $data['meta_title'] ? $data['meta_title'] : $data['title'];
		// Dynamically add a css stylesheet
		//$this->template->stylesheet->add('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');

		// Load a view in the content partial
		//$this->template->content->view('hero', array('title' => 'Hello, world!'));
		$this->breadcrumbs->push('Berita', 'berita');
		$this->breadcrumbs->push($row->judul, $row->slug);
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->template->content->view('../../templates/' . template() . '/views/view_berita_detail', $data);

		// Set a partial's content
		// $this->template->footer = 'Made with Twitter Bootstrap';
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


		// Publish the template
		//$this->template->set_template('../../templates/gentelella/view/template');
		$this->template->set_template('../../templates/' . template() . '/views/template');
		$this->template->publish();
	}
	public function categories()
	{
		cek_session_front();
		$ids = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM categories_lists where group_id=9 and slug='" . $this->db->escape_str($ids) . "'");
		$row = $dat->row();
		$total = $dat->num_rows();
		if ($total == 0) {
			redirect('utama');
		}

		$jumlah = $this->model_utama_berita->hitungberitacategories($row->id)->num_rows();
		$config['base_url'] = base_url() . 'berita/categories/' . $row->slug;
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 20;
		if ($this->uri->segment('4') != '') {
			$dari = $this->uri->segment('4');
		} else {
			$dari = 0;
		}

		if (is_numeric($dari)) {
			$data['categories'] = $this->model_utama->detail_berita_categories($row->id, $dari, $config['per_page']);
		} else {
			redirect('berita');
		}

		$this->pagination->initialize($config);
		$data['title'] = $row->name;
		$this->fcore->set_meta(array(), 'home');
		// $this->template->load(template().'/template',template().'/view_berita_categories',$data);
		//echo 'okehhhhhhhhhhh';
		$this->template->title = $data['title'];

		// Dynamically add a css stylesheet
		//$this->template->stylesheet->add('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');

		// Load a view in the content partial
		//$this->template->content->view('hero', array('title' => 'Hello, world!'));
		$news = array(); // load from model (but using a dummy array here)
		$this->template->content->view('../../templates/' . template() . '/views/view_berita_categories', $data);

		// Set a partial's content
		$this->template->footer = 'Made with Twitter Bootstrap';

		// Publish the template
		//$this->template->set_template('../../templates/gentelella/view/template');
		$this->template->set_template('../../templates/' . template() . '/views/template');
		$this->template->publish();
	}
	//fikar tag toxi
	public function tags()
	{
		cek_session_front();
		$ids = $this->uri->segment(3);
		$dat = $this->db->query("SELECT * FROM berita_tags where slug='" . $this->db->escape_str($ids) . "'");
		$row = $dat->row();
		$total = $dat->num_rows();
		if ($total == 0) {
			redirect('utama');
		}
		$jumlah = $this->model_utama->hitung_post_tags('berita', $row->tags_id)->num_rows();
		$config['base_url'] = base_url() . 'berita/tags_berita/' . $row->slug;
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 21;
		if ($this->uri->segment('4') != '') {
			$dari = $this->uri->segment('4');
		} else {
			$dari = 0;
		}

		if (is_numeric($dari)) {
			$data['tags'] = $this->model_utama->detail_post_tags('berita', $row->tags_id, $dari, $config['per_page']);
		} else {
			redirect('berita');
		}
		$this->pagination->initialize($config);
		$data['title'] = $row->tags_title;
		$data['judul'] = $row->tags_title;
		//$data['meta_keywords'] = 'contoh keyword'; //$row->meta_keywords;
		//$data['meta_description'] = $row->meta_description;
		//$data['gambar'] = $row->gambar;
		//$this->fcore->set_meta(array(), 'home');
		$this->fcore->set_meta($data, 'tags');
		//print_r($data);
		//print_r($data['tags']);
		//print_r($row);
		// $this->template->load(template().'/template',template().'/view_berita_tags',$data);
		//echo 'okehhhhhhhhhhh';
		$this->template->title = $data['title'];

		// Dynamically add a css stylesheet
		//$this->template->stylesheet->add('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');

		// Load a view in the content partial
		//$this->template->content->view('hero', array('title' => 'Hello, world!'));
		$this->template->content->view('../../templates/' . template() . '/views/view_berita_tags', $data);

		// Set a partial's content
		$this->template->footer = 'Made with Twitter Bootstrap';

		// Publish the template
		//$this->template->set_template('../../templates/gentelella/view/template');
		$this->template->set_template('../../templates/' . template() . '/views/template');
		$this->template->publish();
	}
	public function feed()
	{
		cek_session_front();
		$this->load->library('feed');
		// create new instance
		$feed = new Feed();

		$dari = 0;
		$config['per_page'] = 20;
		if (is_numeric($dari)) {
			$data['berita'] = $this->model_utama->semua_berita($dari, $config['per_page']);
		} else {
			redirect('berita');
		}

		// set your feed's title, description, link, pubdate and language
		$posts = $data['berita']->result();
		$feed->title = setting('site_name');
		$feed->description = setting('site_description');
		$feed->link = base_url('berita/feed');
		$feed->lang = 'id';
		$feed->pubdate = (!empty($posts)) ? $posts[0]->tanggal : date('Y-m-d H:i:s');
		// add posts to the feed
		if (!empty($posts)) {
			foreach ($posts as $post) {
				$post->slug = base_url('berita/detail/' . $post->slug);
				// set item's title, author, url, pubdate and description
				$feed->add($post->meta_title ? $post->meta_title : $post->judul, $post->first_name . ' ' . $post->last_name, $post->slug, $post->tanggal, clear_html(strip_tags($post->isi_berita)));
			}
		}

		// show your feed (options: 'atom' (recommended) or 'rss')
		$feed->render('atom');
	}

	function add_count($slug)
	{
		// load cookie helper
		//$this->load->helper('cookie');
		$this->load->helper('cookie');

		// this line will return the cookie which has slug name
		$check_visitor = $this->input->cookie(urldecode($slug), FALSE);
		// this line will return the visitor ip address
		$ip = $this->input->ip_address();
		// if the visitor visit this article for first time then //
		//set new cookie and update article_views column  ..
		//you might be notice we used slug for cookie name and ip
		//address for value to distinguish between articles  views
		if ($check_visitor == false) {
			$cookie = array(
				"name"   => urldecode($slug),
				"value"  => "$ip",
				"expire" =>  time() + 7200,
				"secure" => false
			);
			//print_r($cookie);
			$this->input->set_cookie($cookie);
			$this->model_utama->update_counter(urldecode($slug));
		}
	}
}
