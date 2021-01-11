<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Make instance of CodeIgniter to use its resources
$CI = &get_instance();
$data['total_inbox'] = 'jumlah inbox pesan akuuuuuuuuuuuuuuuuu';
// Load data into CodeIgniter
$CI->load->vars($data);
$CI->load->helper('globals');
Globals::setAuthenticatedMemeberId('999');
//echo Globals::authenticatedMemeberId();
date_default_timezone_set('Asia/Jakarta');
function containsWord($str, $word)
{
    if (strpos($word, $str) == true) {
        // car found
        return true;
    } else {
        return false;
    }
    //return !!preg_match('#\\b' . preg_quote($word, '#') . '\\b#i', $str);
}
function home_url($link = null)
{
    if (strpos(base_url(), "administrator/") !== false) {
        // car found
        return str_replace('administrator/', '', base_url($link));
    } else {
        return base_url($link);
    }
}
function is_admin()
{
    if (strpos(base_url(), "administrator/") !== false) {
        // car found
        return true;
    } else {
        return false;
    }
}
function is_admin_home()
{
    $ci = &get_instance();
    if ($ci->uri->segment(1) == 'dashboard') {
        // car found
        return true;
    } else {
        return false;
    }
}
function is_website()
{
    //echo isset($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : $_SERVER['HTTP_HOST'];
    if (isset($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : $_SERVER['HTTP_HOST'] != 'localhost') {
        # code...
        //echo "web local";

        if (strpos(base_url(), "pt-cmp.com") == false) {
            //die();
        }
    }
}
function is_home()
{
    $ci = &get_instance();
    if ($ci->uri->segment(1) == '') {
        // car found
        return true;
    } else {
        return false;
    }
}
function cek_session_admin()
{
    $ci = &get_instance();
    $session = $ci->session->userdata('level');
    $user = $ci->ion_auth->user()->row();

    if (!$ci->ion_auth->logged_in()) {
        // redirect them to the login page
        redirect('auth/login', 'refresh');
    } else if (!$ci->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
    {
        // redirect them to the home page because they must be an administrator to view this
        show_error('You must be an administrator to view this page.');
    } else {
    }
    //echo "session ku ini".$session."berhasil";
    //print_r($ci->session->userdata('nama'));
    //print_r($ci->session->all_userdata());
    if ($session == '') {
        //redirect(base_url());
    }
    if (!containsWord('administrator/', base_url())) {
        # code...
        //echo 'ini halaman admin';
        //redirect(base_url());
    }
}
function block_app()
{
    $ci = &get_instance();
    // $session = $ci->session->userdata('level');
    // $user = $ci->ion_auth->user()->row();
    $appblocked = $ci->router->fetch_class();
    $blokedlist = array('posts', 'sertifikat', 'tags', 'welcome');
    if (in_array($appblocked, $blokedlist)) {
        // die;
        redirect(base_url());
    }
}
function cek_session_level($level = 'admin')
{
    $ci = &get_instance();
    $session = $ci->session->userdata('level');
    //echo "session ku ini".$session."berhasil";
    //print_r($ci->session->userdata('nama'));
    //print_r($ci->session->all_userdata());
    if ($session != $level) {
        //redirect(base_url().'administrator/home');
    }
}

function cek_session_akses($link, $id)
{
    $ci = &get_instance();
    $session = $ci->db->query("SELECT * FROM modul,users_modul WHERE modul.id_modul=users_modul.id_modul AND users_modul.id_session='$id' AND modul.link='$link'")->num_rows();
    if ($session == '0' and $ci->session->userdata('level') != 'admin') {
        redirect(base_url() . 'administrator/home');
    }
}

//fikarsession underconstruction
function cek_session_front()
{
    $ci = &get_instance();
    $session = $ci->session->userdata('level');
    //echo "session ku ini".$session."berhasil";
    //print_r($ci->session->userdata('nama'));
    //print_r($ci->session->all_userdata());

    if ((!$ci->ion_auth->logged_in()) && (webconfig('offline') == true)) {
        redirect(base_url() . 'underconstruction');
    }
}
function cek_session_offline()
{
    $ci = &get_instance();
    $session = $ci->session->userdata('level');
    $user = $ci->ion_auth->user()->row();

    if (($ci->ion_auth->logged_in()) && (webconfig('offline') == true)) {
        redirect(base_url());
    } elseif ((!containsWord('underconstruction/', base_url())) && (webconfig('offline') == false)) {
        # code...
        //echo 'ini halaman admin';
        redirect(base_url());
    }
}
function administrator_only()
{
    $ci = &get_instance();
    $session = $ci->session->userdata('level');
    $user = $ci->ion_auth->user()->row();

    if (!containsWord('administrator/', base_url())) {
        redirect(base_url('administrator/dashboard'));
    }
}

function cek_session_logged()
{
    $ci = &get_instance();
    $session = $ci->session->userdata('level');
    //echo "session ku ini".$session."berhasil";
    //print_r($ci->session->userdata('nama'));
    //print_r($ci->session->all_userdata());

    if ($session != '') {
        return true;
    }
}
function if_offline_robot()
{
    $ci = &get_instance();
    $session = $ci->session->userdata('level');
    //echo "session ku ini".$session."berhasil";
    //print_r($ci->session->userdata('nama'));
    //print_r($ci->session->all_userdata());

    if (webconfig('offline') == true) {
        return 'noindex, nofollow';
    } else {
        return 'index, follow';
    }
}
function is_level($level = null)
{
    $ci = &get_instance();
    $session = $ci->session->userdata('level');
    //echo "session ku ini".$session."berhasil";
    //print_r($ci->session->userdata('nama'));
    //print_r($ci->session->all_userdata());

    if (($session != '') && ($level == $session)) {
        return true;
    }
}
function template()
{
    $ci = &get_instance();
    $query = $ci->db->query("SELECT folder FROM templates where aktif='Y'");
    $tmp = $query->row_array();

    if (($query->num_rows() >= 1) && (is_dir('templates/' . $tmp['folder'] . '/'))) {
        return $tmp['folder'];
    } else {
        return 'default';
    }
}
function pagebreak($string)
{
    $splittedstring = explode("<!-- pagebreak -->", $string);
    foreach ($splittedstring as $key => $value) {
        //echo "splittedstring[".$key."] = ".$value."<br>";
        if ($key == 0) {
            echo $value;
        }
    }
}
//fungsi logo
function logo()
{
    $ci = &get_instance();
    $query = $ci->db->query("SELECT logo FROM identitas where id_identitas='1'");
    $tmp = $query->row_array();
    if ($query->num_rows() >= 1) {
        return $tmp['logo'];
    } else {
        return 'errors';
    }
}
function imgheader()
{
    $ci = &get_instance();
    $query = $ci->db->query("SELECT header FROM identitas where id_identitas='1'");
    $tmp = $query->row_array();
    if ($query->num_rows() >= 1) {
        return $tmp['header'];
    } else {
        return 'errors';
    }
}
function idwebsite($nama)
{
    $ci = &get_instance();
    //$query = $ci->db->query("SELECT header FROM identitas where id_identitas='1'");
    $idwebsite = $ci->db->query("SELECT $nama FROM identitas")->row_array();
    return $idwebsite[$nama];
}
function contactwebsite($nama)
{
    $ci = &get_instance();
    //$query = $ci->db->query("SELECT header FROM identitas where id_identitas='1'");
    $contactwebsite = $ci->db->query("SELECT * FROM contact where id_contact=1")->row_array();
    return $contactwebsite[$nama];
}
function administrator()
{
    return base_url() . 'administrator/';
}
function webconfig($item)
{
    $ci = &get_instance();
    $ci->config->load('websettings', TRUE);
    $web_config = $ci->config->item('websettings');
    $site_config = $web_config[$item];
    return $site_config;
}
//fungsi tanggal
function tanggalindo($tanggal, $format)
{
    $date = date_create($tanggal);
    return date_format($date, $format);
}
function namahari($tanggal)
{
    $date = date_create($tanggal);
    //return date_format($date,'D');
    $hariku = gethari(date_format($date, 'D'));
    return $hariku;
}
function gethari($hari)
{
    switch ($hari) {
        case 'Sun':
            return "Minggu";
            break;
        case 'Mon':
            return "Senin";
            break;
        case 'Tue':
            return "Selasa";
            break;
        case 'Wed':
            return "Rabu";
            break;
        case 'Thu':
            return "Kamis";
            break;
        case 'Fri':
            return "Jumat";
            break;
        case 'Sat':
            return "Sabtu";
            break;
    }
}


function totaldata($table)
{
    $ci = &get_instance();
    //$query = $ci->db->query("SELECT header FROM identitas where id_identitas='1'");
    $totaldata = $ci->db->query("SELECT * FROM $table")->num_rows();
    return $totaldata;
}
function kategori($id)
{
    $ci = &get_instance();
    //$query = $ci->db->query("SELECT header FROM identitas where id_identitas='1'");
    $kategori = $ci->db->query("SELECT * FROM kategori WHERE id_kategori='$id'")->row_array();
    //return $kategori['nama_kategori'];
    return '<a target="_blank" href="' . home_url('berita/kategori/') . $kategori['kategori_seo'] . '">' . $kategori['nama_kategori'] . '</a>';
}
function categories($id, $type = 'products')
{
    $ci = &get_instance();
    //$query = $ci->db->query("SELECT header FROM identitas where id_identitas='1'");
    $categories = $ci->db->query("SELECT * FROM categories_lists WHERE id='$id'")->row_array();
    //return $categories['nama_categories'];
    return '<a target="_blank" href="' . home_url($type . '/categories/') . $categories['slug'] . '">' . $categories['name'] . '</a>';
}
function alert($msg = 'errors !')
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
function listitem($data, $tipe = 'list')
{
    echo '<ul class="list-unstyled">';
    $lists = explode(',', $data);
    foreach ($lists as $value) {
        # code...
        switch ($tipe) {
            case "link":
                $value = '<a target="_blank" href="' . $value . '">' . $value . '</a>';
                break;
            case "email":
                $value = '<a target="_blank" href="mailto:' . $value . '">' . $value . '</a>';
                break;
            case "wa":
                $value = '<a target="_blank" href="https://api.whatsapp.com/send?phone=62' . $value . '">' . $value . '</a>';
                break;
            default:
                $value;
        }
        echo '<li>' . $value . '</li>';
    }
    echo '</ul>';
}
function departement_name($id, $type = 'staffs')
{
    $ci = &get_instance();
    //$query = $ci->db->query("SELECT header FROM identitas where id_identitas='1'");
    $departement = $ci->db->query("SELECT * FROM departement WHERE id_departement='$id'")->row_array();
    //return $departement['nama_departement'];
    return '<a target="_blank" href="' . base_url('departement/edit/') . $departement['id_departement'] . '">' . $departement['name'] . '</a>';
}
function jabatan_name($id, $type = 'staffs')
{
    $ci = &get_instance();
    //$query = $ci->db->query("SELECT header FROM identitas where id_identitas='1'");
    $jabatan = $ci->db->query("SELECT * FROM jabatan WHERE id_jabatan='$id'")->row_array();
    //return $jabatan['nama_jabatan'];
    return '<a target="_blank" href="' . base_url('jabatan/edit/') . $jabatan['id_jabatan'] . '">' . $jabatan['name'] . '</a>';
}
function status_karyawan_name($id, $type = 'staffs')
{
    $ci = &get_instance();
    //$query = $ci->db->query("SELECT header FROM identitas where id_identitas='1'");
    $status_karyawan = $ci->db->query("SELECT * FROM status_karyawan WHERE id_status_karyawan='$id'")->row_array();
    //return $status_karyawan['nama_status_karyawan'];
    return '<a target="_blank" href="' . base_url('status_karyawan/edit/') . $status_karyawan['id_status_karyawan'] . '">' . $status_karyawan['name'] . '</a>';
}
function absen_status_name($id, $type = 'absen')
{
    $ci = &get_instance();
    //$query = $ci->db->query("SELECT header FROM identitas where id_identitas='1'");
    $absen_status = $ci->db->query("SELECT * FROM absen_status WHERE id_absen_status='$id'")->row_array();
    //return $departement['nama_departement'];
    return $absen_status['name'];
}
function clear_html($text)
{
    $stripped = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $text);
    return $stripped;
}
function setting($nama)
{
    $ci = &get_instance();
    //$query = $ci->db->query("SELECT header FROM identitas where id_identitas='1'");
    $idwebsite = $ci->db->query("SELECT * FROM settings WHERE name='$nama'")->row_array();
    return $idwebsite['value'];
    // return $idwebsite;
}
