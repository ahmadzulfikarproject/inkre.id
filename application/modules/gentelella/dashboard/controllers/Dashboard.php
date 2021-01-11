 <?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_AdminController {

 public function __construct()
 {
  parent::__construct();
 }

 public function index()
 {
    cek_session_admin();
  // Set the title
    $this->template->title = 'Welcome!';
    $this->template->active_link = 'settings';
    // $this->template->active_link->set('description','cotoh deskripsi');

		// $this->template->set('active_link', 'settings');
    
    // Dynamically add a css stylesheet
    //$this->template->stylesheet->add('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');

    // Load a view in the content partial
    //$this->template->content->view('hero', array('title' => 'Hello, world!'));
    $news = array(); // load from model (but using a dummy array here)
    $this->template->content->view('dashboard', $news);

    // Set a partial's content
    $this->template->footer = 'Made with Twitter Bootstrap';

    // Publish the template
    //$this->template->set_template('../../templates/gentelella/view/template');
    $this->template->set_template($this->config->item('admin-template').'/view/template');
    $this->template->publish();
    //echo $this->config->item('admin-template');
 }
 public function edit()
 {
    cek_session_admin();
  // Set the title
    $this->template->title = 'Edit!';

    // Dynamically add a css stylesheet
    //$this->template->stylesheet->add('http://twitter.github.com/bootstrap/assets/css/bootstrap.css');

    // Load a view in the content partial
    //$this->template->content->view('hero', array('title' => 'Hello, world!'));
    $news = array(); // load from model (but using a dummy array here)
    $this->template->content->view('edit', $news);

    // Set a partial's content
    $this->template->footer = 'Made with Twitter Bootstrap';

    // Publish the template
    //$this->template->set_template('../../templates/gentelella/view/template');
    $this->template->set_template($this->config->item('admin-template').'/view/template');
    $this->template->publish();
    //echo $this->config->item('admin-template');
 }

}
