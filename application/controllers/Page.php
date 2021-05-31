<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends MY_Controller
{
	public function detail()
	{
		cek_session_front();
		$ids = $this->uri->segment(3);
		//$dat = $this->db->query("SELECT * FROM `pages` where lower(replace(judul,' ','-'))='$ids'");
		$dat = $this->db->query("SELECT * FROM `pages` where slug='$ids'");
		$row = $dat->row();
		$total = $dat->num_rows();
		if ($total == 0) {
			redirect('main');
		}
		$data['title'] = $row->judul;
		$data['slug'] = $row->slug;
		$string = character_limiter(strip_tags(html_entity_decode($row->isi_pages)), 300);

		$data['description'] = ($row->meta_description) ? $row->meta_description : $string;
		//$data['description'] = $row->isi_pages;
		$data['ogimage'] = base_url() . webconfig('asset') . '/foto_statis/' . $row->gambar;
		$data['record'] = $this->model_utama->page_detail($ids)->row_array();
		//$this->fcore->set_meta(array(), 'home');
		$this->fcore->set_meta($data['record'], 'page');
		//$this->template->load(template().'/template',template().'/view_page',$data);
		$this->template->title = ($row->meta_title) ? $row->meta_title : $data['title'] ;
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
		$this->template->meta->add('publisher', 'Sewa Genset 88');
		// Dynamically add a css stylesheet
		//$this->template->stylesheet->add('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');
		// $this->breadcrumbs->push('Page', 'page');
		$this->breadcrumbs->push($row->judul, $row->slug);
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		// Load a view in the content partial
		$this->template->content->view('../../templates/' . template() . '/views/view_page', $data);

		// Set a partial's content
		$this->template->footer = 'Made with Twitter Bootstrap';

		// Publish the template
		//$this->template->set_template('../../templates/gentelella/view/template');
		$this->template->set_template('../../templates/' . template() . '/views/template');
		$this->template->publish();
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
			$data['page'] = $this->model_utama->page($dari, $config['per_page']);
		} else {
			redirect('page');
		}
		// set your feed's title, description, link, pubdate and language
		$posts = $data['page']->result();
		$feed->title = setting('meta_title') ? setting('meta_title') : setting('site_name');
		$feed->description = setting('site_description');
		$feed->link = base_url('page/feed');
		$feed->lang = 'id';
		$feed->pubdate = (!empty($posts)) ? $posts[0]->tgl_posting : date('Y-m-d H:i:s');
		// print_r($data['page']->result_array());
		// add posts to the feed
		if (!empty($posts)) {
			foreach ($posts as $post) {
				$post->slug = base_url('page/detail/' . $post->slug);
				// set item's title, author, url, pubdate and description
				$feed->add($post->meta_title ? $post->meta_title : $post->judul, setting('site_name'), $post->slug, $post->tgl_posting, clear_html(strip_tags($post->isi_pages)));
				// $feed->add($post->judul, $post->first_name . ' ' . $post->last_name, $post->slug, $post->tgl_posting, '');
			}
		}
		// show your feed (options: 'atom' (recommended) or 'rss')
		$feed->render('atom');
	}
}
