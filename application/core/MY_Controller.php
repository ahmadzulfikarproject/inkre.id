<?php (defined('BASEPATH')) or exit('No direct script access allowed');


class MY_Controller extends MX_Controller
{
    public function __construct()
    {
        //echo $_SERVER['HTTP_HOST'];
        //echo $_SERVER['HTTPS'];
        //echo isset($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : $_SERVER['HTTP_HOST'];
        parent::__construct();
        $this->load->model('tags_model');
        //$this->load->model('blog_model');
        $this->load->helper('tags');
        //error_reporting(0);
        //$configku = $this->config->item('modules_locations');
        //print_r($configku);
        //echo $this->router->fetch_module();

        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->helper(['url', 'language']);

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->template->meta->add('robots', if_offline_robot());
        $this->lang->load('auth');
        block_app();
        date_default_timezone_set('Asia/Jakarta');
        $this->template->footer = 'Dibuat dengan secangkir kopi';
        $this->template->title = $this->router->fetch_class();
        $this->template->active_link = $this->router->fetch_class();
        // $this->template->set_template($this->config->item('admin-template') . '/view/template');
        $this->template->view_path = 'templates/' . template() . '/views/';
        $this->template->set_template('../../templates/' . template() . '/views/template');

        // $this->output->cache(1);
        $this->load->library('CI_Minifier');
        // Minify html only
        $this->ci_minifier->init(0);
        $this->ci_minifier->enable_obfuscator();
        $this->contactsrow = $this->db->query("SELECT * FROM contact where id_contact=1")->row();
        Globals::setContact($this->contactsrow);
        $this->breadcrumbs->push('Home', '/');
        // $this->output->delete_cache();
        // echo template();
    }
}
class MY_AdminController extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model('tags_model');
        //$this->load->model('blog_model');
        //$this->load->helper('tags');
        //die('ini halaman admin');
        $this->load->language('admin', 'english');
        $this->config->load('template');
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->helper(['url', 'language']);

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');


        $user = $this->ion_auth->user()->row();
        Globals::setAuthenticatedMemeberId($user);
        $this->template->footer = 'Dibuat dengan secangkir kopi';
        $this->template->title = $this->router->fetch_class();
        $this->template->active_link = $this->router->fetch_class();
        $this->template->set_template($this->config->item('admin-template') . '/view/template');
        //echo $user->email;
        date_default_timezone_set('Asia/Jakarta');
        // $this->output->cache(1);
        $this->output->delete_cache();
        $this->load->library('CI_Minifier');
        // Minify html only
        $this->ci_minifier->init(0);
        // $this->ci_minifier->enable_obfuscator();
    }
}
