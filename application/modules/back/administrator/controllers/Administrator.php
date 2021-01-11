<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Administrator extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('tags_model');
		$this->load->model('blog_model');
		$this->load->helper('tags');
		error_reporting(0);
	}
	function index(){
		$url = $this->uri->segment(1);
		if ($url != webconfig('adminurl')) {
			redirect(base_url());
			# code...
		}
		if (isset($_POST['submit'])){
			$username = $this->input->post('a');
			$password = md5($this->input->post('b'));
			$cek = $this->model_users->cek_login($username,$password);
		    $row = $cek->row_array();
		    $total = $cek->num_rows();
			if ($total > 0){
				$this->session->set_userdata('upload_image_file_manager',true);
				$this->session->set_userdata(array('username'=>$row['username'],
								   'level'=>$row['level']));
				$this->session->set_userdata('nama', $row['nama_lengkap']);
				//print_r($row);
				//print_r($this->session->userdata('nama'));
				redirect('dashboard');
			}else{
				$data['title'] = 'Administrator &rsaquo; Log In';
				$this->load->view('administrator/view_login',$data);
			}
		}else{
			if ($this->session->level != ''){
				redirect('dashboard');
			}else{
				$data['title'] = 'Administrator &rsaquo; Log In';
				$this->load->view('administrator/view_login',$data);
			}
		}
	}
	/*
	function dashboard(){
		cek_session_admin();
		//print_r($this->session->userdata);
		//print_r($this->session->userdata('nama'));
		//print_r($this->session->all_userdata());
		//print_r($this->session->userdata('logged_in'));
		$this->template->load('administrator/template','administrator/view_home');
	}
	*/
	/*
	function identitaswebsite(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_identitas->identitas_update();
			redirect('administrator/identitaswebsite');
		}else{
			$data['record'] = $this->model_identitas->identitas()->row_array();
			$this->template->load('administrator/template','administrator/mod_identitas/view_identitas',$data);
		}
	}
	*/
// Controller Modul Pegawai

	function pegawai(){
		cek_session_admin();
		$data['record'] = $this->model_download->pegawai();
		$this->template->load('administrator/template','administrator/mod_download/view_pegawai',$data);
	}

	function tambah_pegawai(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_download->pegawai_tambah();
			redirect('administrator/pegawai');
		}else{
			$this->template->load('administrator/template','administrator/mod_download/view_pegawai_tambah');
		}
	}

	function edit_pegawai(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_download->pegawai_update();
			redirect('administrator/pegawai');
		}else{
			$data['rows'] = $this->model_download->pegawai_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_download/view_pegawai_edit',$data);
		}
	}

	function delete_pegawai(){
		$id = $this->uri->segment(3);
		$this->model_download->pegawai_delete($id);
		redirect('administrator/pegawai');
	}

	// Controller Modul Menu Utama

	function menuutama(){
		cek_session_admin();
		$data['record'] = $this->model_menu->menuutama();
		$this->template->load('administrator/template','administrator/mod_menu/view_menu',$data);
	}

	function tambah_menuutama(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_menu->menuutama_tambah();
			redirect('administrator/menuutama');
		}else{
			$this->template->load('administrator/template','administrator/mod_menu/view_menu_tambah');
		}
	}

	function edit_menuutama(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_menu->menuutama_update();
			redirect('administrator/menuutama');
		}else{
			$data['rows'] = $this->model_menu->menuutama_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_menu/view_menu_edit',$data);
		}
	}

	function delete_menuutama(){
		$id = $this->uri->segment(3);
		$this->model_menu->menuutama_delete($id);
		redirect('administrator/menuutama');
	}



	// Controller Modul Sub Menu

	function submenu(){
		cek_session_admin();
		$data['record'] = $this->model_menu->submenu();
		$this->template->load('administrator/template','administrator/mod_submenu/view_submenu',$data);
	}

	function tambah_submenu(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_menu->submenu_tambah();
			redirect('administrator/submenu');
		}else{
			$data['utama'] = $this->model_menu->cek_menuutama();
			$data['submenu'] = $this->model_menu->cek_submenu();
			$this->template->load('administrator/template','administrator/mod_submenu/view_submenu_tambah',$data);
		}
	}

	function edit_submenu(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_menu->submenu_update();
			redirect('administrator/submenu');
		}else{
			$data['rows'] = $this->model_menu->submenu_edit($id)->row_array();
			$data['utama'] = $this->model_menu->cek_menuutama();
			$data['submenu'] = $this->model_menu->cek_submenu();
			$this->template->load('administrator/template','administrator/mod_submenu/view_submenu_edit',$data);
		}
	}

	function delete_submenu(){
		$id = $this->uri->segment(3);
		$this->model_menu->submenu_delete($id);
		redirect('administrator/submenu');
	}


	// Controller Modul Halaman Baru

	function halamanbaru(){
		cek_session_admin();
		$data['record'] = $this->model_halaman->halamanstatis();
		$data['rss'] = $this->model_halaman->list_halaman_rss();
        $data['iden'] = $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        //$this->load->view(template().'/rss',$data);
        //$this->template->loadrss(template().'/rss_page',$data);
		$this->template->load('administrator/template','administrator/mod_halaman/view_halaman',$data);
	}

	function tambah_halamanbaru(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_halaman->halamanstatis_tambah();
			redirect('administrator/halamanbaru');
		}else{
			$this->template->load('administrator/template','administrator/mod_halaman/view_halaman_tambah');
		}
	}

	function edit_halamanbaru(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_halaman->halamanstatis_update();
			redirect('administrator/halamanbaru');
		}else{
			$data['rows'] = $this->model_halaman->halamanstatis_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_halaman/view_halaman_edit',$data);
		}
	}

	function delete_halamanbaru(){
		$id = $this->uri->segment(3);
		$this->model_halaman->halamanstatis_delete($id);
		redirect('administrator/halamanbaru');
	}


	// Controller Modul Iklan Sidebar

	function banner(){
		cek_session_admin();
		$data['record'] = $this->model_iklan->banner();
		$this->template->load('administrator/template','administrator/mod_banner/view_banner',$data);
	}

	function tambah_banner(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_iklan->banner_tambah();
			redirect('administrator/banner');
		}else{
			$this->template->load('administrator/template','administrator/mod_banner/view_banner_tambah');
		}
	}

	function edit_banner(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_iklan->banner_update();
			redirect('administrator/banner');
		}else{
			$data['rows'] = $this->model_iklan->banner_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_banner/view_banner_edit',$data);
		}
	}

	function delete_banner(){
		$id = $this->uri->segment(3);
		$this->model_iklan->banner_delete($id);
		redirect('administrator/banner');
	}







	// Controller Modul Agenda

	function agenda(){
		cek_session_admin();
		$data['record'] = $this->model_agenda->agenda();
		$this->template->load('administrator/template','administrator/mod_agenda/view_agenda',$data);
	}

	function tambah_agenda(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_agenda->agenda_tambah();
			redirect('administrator/agenda');
		}else{
			$this->template->load('administrator/template','administrator/mod_agenda/view_agenda_tambah');
		}
	}

	function edit_agenda(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_agenda->agenda_update();
			redirect('administrator/agenda');
		}else{
			$data['rows'] = $this->model_agenda->agenda_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_agenda/view_agenda_edit',$data);
		}
	}

	function delete_agenda(){
		$id = $this->uri->segment(3);
		$this->model_agenda->agenda_delete($id);
		redirect('administrator/agenda');
	}



	// Controller Modul Pesan Masuk

	function pesanmasuk(){
		cek_session_admin();
		$data['record'] = $this->model_hubungi->pesan_masuk();
		$this->template->load('administrator/template','administrator/mod_pesanmasuk/view_pesanmasuk',$data);
	}

	function detail_pesanmasuk(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_hubungi->pesan_masuk_kirim();
			$data['rows'] = $this->model_hubungi->pesan_masuk_view($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_pesanmasuk/view_pesanmasuk_detail',$data);
		}else{
			$data['rows'] = $this->model_hubungi->pesan_masuk_view($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_pesanmasuk/view_pesanmasuk_detail',$data);
		}
	}
	function delete_pesanmasuk($id){
		cek_session_admin();
		//$id = $this->uri->segment(3);
		$this->model_hubungi->hapus_pesan($id);
		redirect('administrator/pesanmasuk');
	}


	// Controller Modul User

	function manajemenuser(){
		cek_session_admin();
		$data['record'] = $this->model_users->users();
		$this->template->load('administrator/template','administrator/mod_users/view_users',$data);
	}

	function tambah_manajemenuser(){
		cek_session_admin();
		$id = $this->session->username;
		if (isset($_POST['submit'])){
			$this->model_users->users_tambah();
			redirect('administrator/manajemenuser');
		}else{
			$data['mo'] = $this->model_modul->users_modul();
			$data['rows'] = $this->model_users->users_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_users/view_users_tambah',$data);
		}
	}

	function edit_manajemenuser(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_users->users_update($id);
			redirect('administrator/manajemenuser');
		}else{
			$data['mo'] = $this->model_modul->users_modul();
			$data['rows'] = $this->model_users->users_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_users/view_users_edit',$data);
		}
	}

	function delete_manajemenuser(){
		$id = $this->uri->segment(3);
		$this->model_users->users_delete($id);
		redirect('administrator/manajemenuser');
	}




	// Controller Modul Modul
	function manajemenmodul(){
		cek_session_admin();
		$data['record'] = $this->model_modul->modul();
		$this->template->load('administrator/template','administrator/mod_modul/view_modul',$data);
	}

	function tambah_manajemenmodul(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_modul->modul_tambah();
			redirect('administrator/manajemenmodul');
		}else{
			$this->template->load('administrator/template','administrator/mod_modul/view_modul_tambah');
		}
	}

	function edit_manajemenmodul(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_modul->modul_update();
			redirect('administrator/manajemenmodul');
		}else{
			$data['rows'] = $this->model_modul->modul_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_modul/view_modul_edit',$data);
		}
	}

	function delete_manajemenmodul(){
		$id = $this->uri->segment(3);
		$this->model_modul->modul_delete($id);
		redirect('administrator/manajemenmodul');
	}

	function logout(){
		$this->session->sess_destroy();
		alert('logout');
		redirect(base_url());
	}


	// Controller Modul Download

	function download(){
		cek_session_admin();
		$data['record'] = $this->model_download->download();
		$this->template->load('administrator/template','administrator/mod_download/view_download',$data);
	}

	function tambah_download(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_download->download_tambah();
			redirect('administrator/download');
		}else{
			$this->template->load('administrator/template','administrator/mod_download/view_download_tambah');
		}
	}

	function edit_download(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_download->download_update();
			redirect('administrator/download');
		}else{
			$data['rows'] = $this->model_download->download_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_download/view_download_edit',$data);
		}
	}

	function delete_download(){
		$id = $this->uri->segment(3);
		$this->model_download->download_delete($id);
		redirect('administrator/download');
	}


	// Controller Modul Polling

	function polling(){
		cek_session_admin();
		$data['record'] = $this->model_polling->polling();
		$this->template->load('administrator/template','administrator/mod_polling/view_polling',$data);
	}

	function tambah_polling(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_polling->polling_tambah();
			redirect('administrator/polling');
		}else{
			$this->template->load('administrator/template','administrator/mod_polling/view_polling_tambah');
		}
	}

	function edit_polling(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_polling->polling_update();
			redirect('administrator/polling');
		}else{
			$data['rows'] = $this->model_polling->polling_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_polling/view_polling_edit',$data);
		}
	}

	function delete_polling(){
		$id = $this->uri->segment(3);
		$this->model_polling->polling_delete($id);
		redirect('administrator/polling');
	}



	// Controller Modul Sekilas Info

	function sekilasinfo(){
		cek_session_admin();
		$data['record'] = $this->model_sekilasinfo->sekilasinfo();
		$this->template->load('administrator/template','administrator/mod_sekilasinfo/view_sekilasinfo',$data);
	}

	function tambah_sekilasinfo(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_sekilasinfo->sekilasinfo_tambah();
			redirect('administrator/sekilasinfo');
		}else{
			$this->template->load('administrator/template','administrator/mod_sekilasinfo/view_sekilasinfo_tambah');
		}
	}

	function edit_sekilasinfo(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_sekilasinfo->sekilasinfo_update();
			redirect('administrator/sekilasinfo');
		}else{
			$data['rows'] = $this->model_sekilasinfo->sekilasinfo_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_sekilasinfo/view_sekilasinfo_edit',$data);
		}
	}

	function delete_sekilasinfo(){
		$id = $this->uri->segment(3);
		$this->model_sekilasinfo->sekilasinfo_delete($id);
		redirect('administrator/sekilasinfo');
	}


	// Controller Modul Link Terkait

	function linkterkait(){
		cek_session_admin();
		$data['record'] = $this->model_linkterkait->linkterkait();
		$this->template->load('administrator/template','administrator/mod_linkterkait/view_linkterkait',$data);
	}

	function tambah_linkterkait(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_linkterkait->linkterkait_tambah();
			redirect('administrator/linkterkait');
		}else{
			$this->template->load('administrator/template','administrator/mod_linkterkait/view_linkterkait_tambah');
		}
	}

	function edit_linkterkait(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_linkterkait->linkterkait_update();
			redirect('administrator/linkterkait');
		}else{
			$data['rows'] = $this->model_linkterkait->linkterkait_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_linkterkait/view_linkterkait_edit',$data);
		}
	}

	function delete_linkterkait(){
		$id = $this->uri->segment(3);
		$this->model_linkterkait->linkterkait_delete($id);
		redirect('administrator/linkterkait');
	}



	// Controller Modul shoutbox

	function shoutbox(){
		cek_session_admin();
		$data['record'] = $this->model_shoutbox->shoutbox();
		$this->template->load('administrator/template','administrator/mod_shoutbox/view_shoutbox',$data);
	}

	function edit_shoutbox(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_shoutbox->shoutbox_update();
			redirect('administrator/shoutbox');
		}else{
			$data['rows'] = $this->model_shoutbox->shoutbox_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_shoutbox/view_shoutbox_edit',$data);
		}
	}

	function delete_shoutbox(){
		$id = $this->uri->segment(3);
		$this->model_shoutbox->shoutbox_delete($id);
		redirect('administrator/shoutbox');
	}


	// Controller Modul Album

	function album(){
		cek_session_admin();
		$data['record'] = $this->model_album->album();
		$this->template->load('administrator/template','administrator/mod_album/view_album',$data);
	}

	function tambah_album(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_album->album_tambah();
			redirect('administrator/album');
		}else{
			$this->template->load('administrator/template','administrator/mod_album/view_album_tambah');
		}
	}

	function edit_album(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_album->album_update();
			redirect('administrator/album');
		}else{
			$data['rows'] = $this->model_album->album_edit($id)->row_array();
			$this->template->load('administrator/template','administrator/mod_album/view_album_edit',$data);
		}
	}

	function delete_album(){
		$id = $this->uri->segment(3);
		$this->model_album->album_delete($id);
		redirect('administrator/album');
	}


	// Controller Modul Galeri

	function galeri(){
		cek_session_admin();
		$data['record'] = $this->model_album->galeri();
		$this->template->load('administrator/template','administrator/mod_galeri/view_galeri',$data);
	}

	function tambah_galeri(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_album->galeri_tambah();
			redirect('administrator/galeri');
		}else{
			$data['record'] = $this->model_album->album();
			$this->template->load('administrator/template','administrator/mod_galeri/view_galeri_tambah',$data);
		}
	}

	function edit_galeri(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_album->galeri_update();
			redirect('administrator/galeri');
		}else{
			$data['rows'] = $this->model_album->galeri_edit($id)->row_array();
			$data['record'] = $this->model_album->album();
			$this->template->load('administrator/template','administrator/mod_galeri/view_galeri_edit',$data);
		}
	}

	function delete_galeri(){
		$id = $this->uri->segment(3);
		$this->model_album->galeri_delete($id);
		redirect('administrator/galeri');
	}

	//fikar custom component
	// Controller Modul List schedules

	function cepat_schedules(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_schedules->list_schedules_cepat();
			redirect('administrator/schedules');
		}
	}

	function schedules(){
		cek_session_admin();
		$data['record'] = $this->model_schedules->list_schedules();

		$data['rss'] = $this->model_schedules->list_schedules_rss();
        $data['iden'] = $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        //$this->load->view(template().'/schedules-rss',$data);
        //$this->fcore->set_meta($data['rss'], 'schedules');
        //$this->template->loadrss(template().'/schedules-rss',$data);
		$this->template->load('administrator/template','administrator/mod_schedules/view_schedules',$data);
	}

	function tambah_schedules(){
		cek_session_admin();
		if (isset($_POST['submit'])){
			$this->model_schedules->list_schedules_tambah();
			redirect('administrator/schedules');
		}
		elseif (isset($_POST['savenew'])) {
			# code...
			$this->model_schedules->list_schedules_tambah();
			redirect('administrator/tambah_schedules');
		}
		else{
			$data['tag'] = $this->model_schedules->tag_schedules();
			$data['record'] = $this->model_schedules->kategori_schedules();
			$data['users'] = $this->model_users->users();
			$this->template->load('administrator/template','administrator/mod_schedules/view_schedules_tambah',$data);
		}
	}

	function edit_schedules(){
		cek_session_admin();
		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$this->model_schedules->list_schedules_update();
			redirect('administrator/schedules');
		}
		elseif (isset($_POST['update'])) {
			# code...
			$this->model_schedules->list_schedules_update();
			redirect('administrator/edit_schedules/'.$_POST['id']);
		}
		else{
			$data['tag'] = $this->model_schedules->tag_schedules();
			$data['record'] = $this->model_schedules->kategori_schedules();
			$data['rows'] = $this->model_schedules->list_schedules_edit($id)->row_array();
			$data['users'] = $this->model_users->users();
			$this->template->load('administrator/template','administrator/mod_schedules/view_schedules_edit',$data);
		}
	}

	function delete_schedules(){
		$id = $this->uri->segment(3);
		$this->model_schedules->list_schedules_delete($id);
		redirect('administrator/schedules');
	}





}
