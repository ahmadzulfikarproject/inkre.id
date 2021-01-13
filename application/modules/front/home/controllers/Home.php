<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        //$this->load->model('identitaswebsite/model_identitas');
        error_reporting(0);
    }
    public function index()
    {
        cek_session_front();
        $this->load->helper("image");
        $this->load->library('adjacency_list');
        //fikar
        $this->load->model('model_utama_projects');
        $this->load->model('model_utama_services');
        $data['title'] = setting('site_name');
        $data['description'] = setting('site_description'); //setting('site_description');
        $data['keywords'] = setting('meta_keyword'); //idwebsite('meta_keyword');
        $data['ogimage'] = home_url() . 'asset/settings/' . setting('site_header');
        $this->fcore->set_meta($data, 'home');
        $this->load->helper('captcha');
        $vals = array(
            'img_path'     => './captcha/',
            'img_url'     => base_url() . 'captcha/',
            'font_path' => set_realpath('./asset/entsans.ttf'),
            'font_size'     => 16,
            'img_width'     => '100',
            'img_height' => 30,
            'border' => 0,
            'word_length'   => 5,
            'expiration' => 7200
        );

        $cap = create_captcha($vals);
        $data['image'] = $cap['image'];
        $this->session->set_userdata('mycaptchacode', $cap['word']);
        //echo template();
        //$this->template->load(template().'/template',template().'/view_home',$data);

        //$this->template->load(template().'/views/template',template().'/views/view_home');
        $this->template->title = $data['title'];
        $this->template->meta->add('description', $data['description']);
		$this->template->meta->add('keywords', $data['keywords']);
		$this->template->meta->add('author', 'Ahmad Zulfikar');
		$this->template->meta->add('webcrawlers', 'all');
		$this->template->meta->add('rating', 'general');
		$this->template->meta->add('spiders', 'all');
		$this->template->meta->add('image', $data['ogimage'],'og');
		$this->template->meta->add('site_name', $this->template->title,'og');
		$this->template->meta->add('url', base_url(),'og');
		$this->template->meta->add('description', $data['description'],'og');
		$this->template->meta->add('title', $this->template->title,'og');
		$this->template->meta->add('type', 'website','og');
        $this->template->meta->add('locale', 'id_ID','og');
        
        // $this->template->content->view('../../templates/' . template() . '/views/view_home', $data);
        $this->template->content->view('view_home', $data);
        $this->template->publish();
    }
    public function feed()
	{
		// cek_session_front();
		$this->load->library('feed');
		// create new instance
		$feed = new Feed();
		
		$feed->title = setting('site_name');
		$feed->description = setting('site_description');
		$feed->link = base_url();
		$feed->lang = 'id';
		$feed->pubdate = date('Y-m-d H:i:s');
		// add posts to the feed
		
		// show your feed (options: 'atom' (recommended) or 'rss')
		$feed->render('atom');
	}
}
