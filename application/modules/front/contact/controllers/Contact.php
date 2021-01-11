<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_contact');
	}
	public function detail($slug = NULL)
	{
		cek_session_front();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">×</a>', '</div>');
		$this->form_validation->set_rules('n', 'Nama', 'required|trim');
		$this->form_validation->set_rules('e', 'E-mail', 'required|trim');
		$this->form_validation->set_rules('p', 'phone', 'required|trim');
		$this->form_validation->set_rules('s', 'Subjek', 'required|trim');
		$this->form_validation->set_rules('m', 'Message', 'required|trim');
		$this->form_validation->set_rules('security_code', 'Security Code', 'required|trim');

		//$ids = $this->uri->segment(3);
		$ids = $slug;
		//$dat = $this->db->query("SELECT * FROM `halamanstatis` where lower(replace(judul,' ','-'))='$ids'");
		$dat = $this->db->query("SELECT * FROM `contact` where slug='$ids'");
		$row = $dat->row();
		$total = $dat->num_rows();
		if ($total == 0) {
			redirect('main');
		}
		if (isset($_POST['submit'])) {
			if ($this->form_validation->run() === TRUE) {
					if ($this->input->post() && (strtolower($this->input->post('security_code')) == strtolower($this->session->userdata('mycaptchacode')))) {
						//if (strtolower($this->input->post('security_code')) == strtolower($this->session->userdata('mycaptcha'))) {
						$this->model_contact->pesan_masuk_kirim_admin();
						$this->model_contact->kirim_Pesan();


						//echo "cobadddddddddd";
						redirect('contact/detail/' . $slug);

						//$data['title'] = 'Contact Kami';
						//$this->template->load(template().'/template',template().'/view_contact',$data);
					} else {
						$this->session->set_flashdata('error', 'pesan gagal terkirim !');
						redirect('contact/detail/' . $slug);
					}
				}
		}


		$data['title'] = $row->nama;
		$data['slug'] = $row->slug;
		$data['record'] = $this->model_contact->contact_detail($ids)->row_array();
		//print_r($data['record']);
		//fikar contact

		// $data['title'] = 'contact Kami';
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
		$this->session->set_userdata('mycaptchacode', $cap['word']);
		//echo strtolower($cap['word']).$this->session->userdata('mycaptchacode');
		//$this->fcore->set_meta(array(), 'home');
		$this->fcore->set_meta($data['record'], 'contact');
		//$this->template->load(template().'/template',template().'/view_contact',$data);
		$this->template->title = $data['title'];
		// $this->template->meta->add('description', $data['description']);
		$this->template->meta->add('keywords', $row->meta_keywords);
		$this->template->meta->add('author', 'Ahmad Zulfikar');
		$this->template->meta->add('webcrawlers', 'all');
		$this->template->meta->add('rating', 'general');
		$this->template->meta->add('spiders', 'all');
		// $this->template->meta->add('image', $data['ogimage'],'og');
		$this->template->meta->add('site_name', $this->template->title,'og');
		$this->template->meta->add('url', base_url(),'og');
		// $this->template->meta->add('description', $data['description'],'og');
		$this->template->meta->add('title', $this->template->title,'og');
		$this->template->meta->add('type', 'website','og');
		$this->template->meta->add('locale', 'id_ID','og');
		// Dynamically add a css stylesheet
		//$this->template->stylesheet->add('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');

		// Load a view in the content partial
		$this->breadcrumbs->push($row->nama, $row->slug);
		$data['breadcrumbs'] = $this->breadcrumbs->show();

		$this->template->content->view('../../templates/' . template() . '/views/view_contact', $data);

		// Set a partial's content
		$this->template->footer = 'Made with Twitter Bootstrap';

		// Publish the template
		//$this->template->set_template('../../templates/gentelella/view/template');
		$this->template->set_template('../../templates/' . template() . '/views/template');
		$this->template->publish();

		/*
		}
		*/
	}

	
}
