<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
	public function __construct()
    {
        parent::__construct();
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data = array();
		//$this->load->module('data');
        //$this->data->index($data); 
		//$this->load->view('welcome_message');
		// Set the title
        $this->template->title = 'Welcome!';
        
        // Dynamically add a css stylesheet
        $this->template->stylesheet->add('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');
        
        // Load a view in the content partial
        $this->template->content->view('hero', array('title' => 'Hello, world!'));

        $news = array(); // load from model (but using a dummy array here)
        //$this->template->content->view('news', $news);
        
        // Set a partial's content
        $this->template->footer = 'Made with Twitter Bootstrap';
        $this->template->meta->add('robots', 'index,follow');
        // Publish the template
         $this->fcore->set_meta($data, 'home');
        $this->template->publish('../../templates/'.template().'/views/'.template().'/template');
	}
}
