<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Admin_m
 * 
 * Admin Model Class
 *
 * @access  public
 * @author  Enliven Applications
 * @version 3.0
 * 
 */
class Model_settings extends CI_Model
{
    // Protected or private properties
    protected $_table;

    /**
     * Construct
     *
     * @access  public
     * @author  Enliven Applications
     * @version 3.0
     * 
     * @return  null
     */
    public function __construct()
    {
        parent::__construct();

        // // load db tables config items
        // $tables = $this->config->item('openblog');
        // $this->_table = $tables['tables'];
    }

    /**
     * get_settings_list
     * 
     * get's the list of settings and preps
     * them for the form
     *
     * @access  public
     * @author  Enliven Applications
     * @version 3.0
     * 
     * @return  object
     */
    public function get_settings_list()
    {
        // init data obj
        $data = new stdClass();

        // sort tabs
        $tabs = $this->db->select('tab')->distinct()->get('settings')->result();

        // foreach of those tabs, we get all
        // options in that tab
        foreach ($tabs as &$tab) {
            // get the list for the tab
            $tab->list = $this->db->where('tab', $tab->tab)->get('settings')->result();

            // foreach of the list items
            foreach ($tab->list as &$item) {
                // we build the form field so we can just echo it 
                // in the view
                $item->input = $this->fcore->build_form_field($item->field_type, $item->name, $item->value, $item->options);
            }
        }

        // load up the object with the info
        $data->settings = $tabs;

        // send it off
        return $data;
    }
    /**
     * update_settings
     * 
     * Updates the settings from the admin 
     *
     * @access  public
     * @author  Enliven Applications
     * @version 3.0
     * 
     * @return  bool
     */
    public function update_settings()
    {
        // is there actually any post data?
        if (!$this->input->post()) {
            // nope, fail
            return FALSE;
        }

        // there is, so we'll check the db for that $k
        // print_r($this->input->post());
        //logo
        // $config['upload_path'] = '../asset/';
        // $config['allowed_types'] = 'ico|gif|jpg|png|JPG|JPEG';
        // $config['max_size'] = '30000'; // kb
        // $this->load->library('upload', $config);
        // $this->upload->initialize($config);
        // $this->upload->do_upload('site_logo');
        // $logo = $this->upload->data();
        // $lastid = $this->db->insert_id();
        // $logo['file_name'];
        // print_r($this->input->post());
        foreach ($this->input->post() as $k => $v) {
            // echo $k .'</br>';
            // does $k exist in the db?
            // if so, update it.
            if (!$this->db->where('name', $k)->update('settings', ['value' => $v])) {

                // no, someone adding stuff to the
                // post()?  fail and bail!
                return false;
            }
            // return false;
        }

        $header = $this->_uploadImage('site_header');
        $header ? $this->db->where('name', 'site_header')->update('settings', ['value' => $header]) : '';
        // $header ? getnameimg('../asset/settings/' . setting('site_header'), 'settings') : '';
        $logo = $this->_uploadImage('site_logo');
        // $logo ? getnameimg('../asset/settings/' . setting('site_logo'), 'settings') : '';
        $logo ? $this->db->where('name', 'site_logo')->update('settings', ['value' => $logo]) : '';
        $favicon = $this->_uploadImage('site_favicon');
        // $logo ? getnameimg('../asset/settings/' . setting('site_logo'), 'settings') : '';
        $favicon ? $this->db->where('name', 'site_favicon')->update('settings', ['value' => $favicon]) : '';
        $bg1 = $this->_uploadImage('site_bg1');
        // $logo ? getnameimg('../asset/settings/' . setting('site_logo'), 'settings') : '';
        $bg1 ? $this->db->where('name', 'site_bg1')->update('settings', ['value' => $bg1]) : '';
        $site_background = $this->_uploadImage('site_background');
        // $logo ? getnameimg('../asset/settings/' . setting('site_logo'), 'settings') : '';
        $site_background ? $this->db->where('name', 'site_background')->update('settings', ['value' => $site_background]) : '';

        // something's gone wrong, fail and bail
        return false;
    }
    private function _uploadImage($name)
    {
        // $oldimage = setting($name);
        $config['upload_path']          = '../asset/settings/';
        $config['allowed_types']        = 'ico|gif|jpg|png|JPG|JPEG|jpeg';
        // $config['file_name']            = 'logowebsite';
        // $new_name = $name . '_' . $_FILES[$name]['name'];
        // $config['file_name'] = $name . '_' . $_FILES[$name]['name']; //$new_name;
        $config['overwrite']            = true;
        $config['max_size']             = 30024; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);
        $settingsku = $this->db->where('name', $name)->limit(1)->get('settings')->row();
        if ($this->upload->do_upload($name)) {
            // getnameimg('../asset/settings/' . $oldimage, 'foto_berita');
            // getnameimg('../asset/settings/' . $settingsku->value, 'settings');
            return $this->upload->data("file_name");
        }
        // $new_name = '';
        unset($new_name);
        unset($new_name);
        unset($name);
        unset($settingsku);
        // return "default.jpg";
    }

    /**
     * get_required_settings
     * 
     * provides an array of required settings items
     *
     * @access  public
     * @author  Enliven Applications
     * @version 3.0
     * 
     * @return  bool|object
     */
    public function get_required_settings()
    {
        return $this->db->where('required', 1)->get('settings')->result();
    }
}
