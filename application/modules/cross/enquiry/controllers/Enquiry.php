<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Enquiry extends MY_AdminController
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('enquiry_model');
		$this->load->helper('string');
		//$this->load->model('blog_model');
		//$this->load->helper('tags');
		//$this->load->model('tags/tags_model');
		//error_reporting(0);
	}

	function index()
	{
		$this->load->helper('captcha');
		$this->rand = random_string('numeric', 4);
		$vals = array(
			'word'       => $this->rand,
			'img_path'	 => './captcha/',
			'img_url'	 => home_url() . 'captcha/',
			'font_path' => set_realpath('./asset/entsans.ttf'),
			'font_size'  => 30,
			'img_width'	 => 200,
			'img_height' => 60,
			'border' => 0,
			'word_length'   => 4,
			'expiration' => 7200
		);

		$cap = create_captcha($vals);
		$data['image'] = $cap['image'];
		$this->session->set_userdata('mycaptchacode', $cap['word']);
		$this->load->view('enquiry_view_data', $data);
	}
	function ajax_index()
	{
		$this->rand = random_string('numeric', 4);
		$data = array();
		$this->load->helper('captcha');
		$vals = array(
			'word'       => $this->rand,
			'img_path'	 => './captcha/',
			'img_url'	 => home_url() . 'captcha/',
			'font_path' => set_realpath('./asset/entsans.ttf'),
			'font_size'  => 30,
			'img_width'	 => 200,
			'img_height' => 60,
			'border' => 0,
			'word_length'   => 4,
			'expiration' => 7200
		);

		$cap = create_captcha($vals);
		$data['image'] = $cap['image'];
		// echo $data['image'];
		// echo $cap['word'];
		$this->session->set_userdata('mycaptchacode', $cap['word']);
		// echo $this->session->userdata('mycaptchacode');
		$this->load->view('enquiry_view_ajax', $data);
	}
	function ajax_index_form()
	{
		$this->load->helper('captcha');
		$this->rand = random_string('numeric', 4);
		$vals = array(
			'word'       => $this->rand,
			'img_path'	 => './captcha/',
			'img_url'	 => home_url() . 'captcha/',
			'font_path' => set_realpath('./asset/entsans.ttf'),
			'font_size'  => 30,
			'img_width'	 => 200,
			'img_height' => 60,
			'border' => 0,
			'word_length'   => 4,
			'expiration' => 7200
		);

		$cap = create_captcha($vals);
		$data['image'] = $cap['image'];
		$this->session->set_userdata('mycaptchacode', $cap['word']);
		$this->load->view('enquiry_view_ajax_form', $data);
	}
	/*
	function get_autocomplete(){
		if (isset($_GET['term'])) {
		  	$result = $this->tags_model->search_tags($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
		     		'id'			=> $row->tags_id,
					'label'			=> $row->tags_title,
					'description'	=> $row->tags_description,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}
	*/

	//inser ajax
	public function add_enquiry()
	{
		if ($this->input->is_ajax_request()) {
			$config = array(
				'field' => 'slug',
				'title' => 'judul',
				'table' => 'tags',
				'id' => 'tags_id',
			);
			$this->load->library('slug', $config);

			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'subjek' => $this->input->post('subjek'),
				'message' => $this->input->post('message'),
				//'date' => date('Y-m-d'),
				//'file' => $this->input->post('file'),
				//'tags'=>$this->input->post('tags')
			);

			if ($this->input->post() && (strtolower($this->input->post('security_code')) == strtolower($this->session->userdata('mycaptchacode')))) {

				if ($this->enquiry_model->insert_enquiry($data)) {
					# code...
					$this->rand = random_string('numeric', 4);
					$data['error'] = false;
					$this->load->helper('captcha');
					$vals = array(
						'word'       => $this->rand,
						'img_path'	 => './captcha/',
						'img_url'	 => home_url() . 'captcha/',
						'font_path' => set_realpath('./asset/entsans.ttf'),
						'font_size'  => 30,
						'img_width'	 => 200,
						'img_height' => 60,
						'border' => 0,
						'word_length'   => 4,
						'expiration' => 7200
					);

					$cap = create_captcha($vals);
					$data['image'] = $cap['image'];
					$this->session->set_userdata('mycaptchacode', $cap['word']);
				} else {
					$data['error'] = true;
				}


				echo json_encode($data);


				//echo "cobadddddddddd";
				//redirect('');

				//$data['title'] = 'Contact Kami';
				//$this->template->load(template().'/template',template().'/view_contact',$data);
			} else {
				//$this->session->set_flashdata('error', 'pesan gagal terkirim !');
				//$error = array();
				$this->load->helper('captcha');
				$this->rand = random_string('numeric', 4);
				$vals = array(
					'word'       => $this->rand,
					'img_path'	 => './captcha/',
					'img_url'	 => home_url() . 'captcha/',
					'font_path' => set_realpath('./asset/entsans.ttf'),
					'font_size'  => 30,
					'img_width'	 => 200,
					'img_height' => 60,
					'border' => 0,
					'word_length'   => 4,
					'expiration' => 7200
				);

				$cap = create_captcha($vals);
				$data['image'] = $cap['image'];
				$this->session->set_userdata('mycaptchacode', $cap['word']);

				$data['error'] = true;
				echo json_encode($data);
				//redirect('');

			}

			//$this->enquiry_model->insert_enquiry($data);
			//echo json_encode($data);
		} else {
			show_404();
		}
	}
	public function reload_captcha()
	{
		if ($this->input->is_ajax_request()) {
			$this->rand = random_string('numeric', 4);
			$data = array();
			$this->load->helper('captcha');
			$vals = array(
				'word'       => $this->rand,
				'img_path'	 => './captcha/',
				'img_url'	 => home_url() . 'captcha/',
				'font_path' => set_realpath('./asset/entsans.ttf'),
				'font_size'  => 30,
				'img_width'	 => 200,
				'img_height' => 60,
				'border' => 0,
				'word_length'   => 4,
				'expiration' => 7200
			);

			$cap = create_captcha($vals);
			$data['image'] = $cap['image'];
			$this->session->set_userdata('mycaptchacode', $cap['word']);
			echo json_encode($data);
		} else {
			show_404();
		}
	}
}
