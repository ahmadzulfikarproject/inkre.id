<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_contact extends CI_model
{
    var $table = 'contact';
    var $column_order = array(null,null, 'nama', null,null,'tgl_posting',null); //set column field database for datatable orderable
    var $column_search = array('nama', 'id_contact'); //set column field database for datatable searchable 
    var $order = array('id_contact' => 'desc'); // default order 
    var $hasil = array();
    var $wm = false;
    var $new_slug = false;
    var $wide = 400;
    var $height = 200;

    function contact_detail($id)
    {
        return $this->db->query("SELECT * FROM contact where slug='" . $this->db->escape_str($id) . "'");
    }

    function contactstatis()
    {
        return $this->db->query("SELECT * FROM halamanstatis ORDER BY id_halaman DESC");
    }

    function list_contact_rss()
    {
        //return $this->db->query("SELECT a.*, FROM contact a  ORDER BY a.id_contact DESC LIMIT 10");

        return $this->db->query("SELECT * FROM contact ORDER BY id_contact DESC LIMIT 10");
    }

    function list_contact()
    {
        //return $this->db->query("SELECT a.*, FROM contact a  ORDER BY a.id_contact DESC");
        return $this->db->query("SELECT * FROM contact ORDER BY id_contact DESC");
    }

    function list_contact_tambah()
    {
        $config['upload_path'] = '../asset/foto_contact/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg';
        $config['max_size'] = '30000'; // kb
        $new_name = substr(md5(uniqid(mt_rand())), 0, 10) . '_' . time() . '_' . $_FILES["gambar"]['name'];
        $config['remove_spaces'] = true;
        $config['file_name'] = preg_replace("/[^a-zA-Z0-9.]/", "_", $new_name);
        $this->load->library('upload', $config);
        $this->upload->do_upload('gambar');
        $hasil = $this->upload->data();

        //fikar
        $config = array(
            'field' => 'slug',
            'title' => 'nama',
            'table' => 'contact',
            'id' => 'id_contact',
        );
        $this->load->library('slug', $config);
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        //fikar z
        if ($_FILES["gambar"]['name'] == '') {
            $datadb = array(
                'nama' => $this->db->escape_str($this->input->post('nama')),
                'slug' => $this->slug->create_uri($this->input->post('nama')),
                'alamat' => $this->input->post('alamat'),
                'phone' => $this->input->post('phone'),
                'mobile' => $this->input->post('mobile'),
                'fax' => $this->input->post('fax'),
                'email' => $this->input->post('email'),
                'link' => $this->input->post('link'),
                'lokasi' => $this->input->post('lokasi'),
                'info' => $this->input->post('info'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'wa' => $this->input->post('wa'),
                'fb' => $this->input->post('fb'),
                'ig' => $this->input->post('ig'),
                'twitter' => $this->input->post('twitter'),
                'tgl_posting' => date('Y-m-d')
            );
        } else {
            $datadb = array(
                'nama' => $this->db->escape_str($this->input->post('nama')),
                'slug' => $this->slug->create_uri($this->input->post('nama')),
                'alamat' => $this->input->post('alamat'),
                'phone' => $this->input->post('phone'),
                'mobile' => $this->input->post('mobile'),
                'fax' => $this->input->post('fax'),
                'email' => $this->input->post('email'),
                'link' => $this->input->post('link'),
                'lokasi' => $this->input->post('lokasi'),
                'info' => $this->input->post('info'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'wa' => $this->input->post('wa'),
                'fb' => $this->input->post('fb'),
                'ig' => $this->input->post('ig'),
                'twitter' => $this->input->post('twitter'),
                'tgl_posting' => date('Y-m-d'),


                'gambar' => $hasil['file_name']
            );
        }

        if ($this->db->insert('contact', $datadb)) {
            if (file_exists('../asset/foto_contact/' . $hasil['file_name'])) {
                //thumb('../asset/foto_contact/'.$hasil['file_name'],'400','200');
            }
        }
    }

    function list_contact_edit($id)
    {
        return $this->db->query("SELECT * FROM contact where id_contact='$id'");
    }

    function list_contact_update()
    {
        $config['upload_path'] = '../asset/foto_contact/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg';
        $config['max_size'] = '30000'; // kb
        //$nmfile = "file_".time();
        //$config['file_name'] = $nmfile; //nama yang terupload nantinya
        //$filename = md5(uniqid(mt_rand())).$this->file_ext;
        $new_name = substr(md5(uniqid(mt_rand())), 0, 10) . '_' . time() . '_' . $_FILES["c"]['name'];
        $config['remove_spaces'] = true;
        $config['file_name'] = preg_replace("/[^a-zA-Z0-9.]/", "_", $new_name);
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('c')) {
            $this->hasil = $this->upload->data();
        }
        //fikar
        $config = array(
            'field' => 'slug',
            'title' => 'nama',
            'table' => $this->table,
            'id' => 'id_contact',
        );
        $this->load->library('slug', $config);
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        //fikar z
        $page = $this->db->where('id_contact', $this->input->post('id'))->limit(1)->get($this->table)->row();
        if ($this->db->escape_str($this->input->post('nama')) != $page->nama) {
            //$slugku = $page->slug;
            $this->new_slug = true;
        }
        $datadb = array(
            'nama' => $this->db->escape_str($this->input->post('nama')),
            // 'slug' => $this->slug->create_uri($this->input->post('nama')),
            'alamat' => $this->input->post('alamat'),
            'phone' => $this->input->post('phone'),
            'mobile' => $this->input->post('mobile'),
            'fax' => $this->input->post('fax'),
            'email' => $this->input->post('email'),
            'link' => $this->input->post('link'),
            'lokasi' => $this->input->post('lokasi'),
            'info' => $this->input->post('info'),
            'meta_title' => $this->input->post('meta_title'),
            'meta_keywords' => $this->input->post('meta_keywords'),
            'meta_description' => $this->input->post('meta_description'),
            'wa' => $this->input->post('wa'),
            'fb' => $this->input->post('fb'),
            'ig' => $this->input->post('ig'),
            'twitter' => $this->input->post('twitter'),
            'tgl_posting' => date('Y-m-d'),
        );
        $this->hasil ? $datadb['gambar'] = $this->hasil['file_name'] : '';
        $this->new_slug ? $datadb['slug'] = $this->slug->create_uri($this->input->post('nama')) : '';
        // $datadb['id_categories'] = $this->db->escape_str($this->input->post('category'));
        $this->db->where('id_contact', $this->input->post('id'));
        if ($this->db->update($this->table, $datadb)) {
            if ($this->hasil) {
                getnameimg('../asset/foto_contact/' . $page->gambar, 'foto_contact');
                if ($this->db->escape_str($this->input->post('watermark')) == 'on') {
                    $this->wm = true;
                }
                if (($datadb['gambar']) && (file_exists('../asset/foto_contact/' . $datadb['gambar']))) {
                    thumb('../asset/foto_contact/' . $datadb['gambar'], $this->wide, $this->height, $this->wm);
                }
            }
        }
    }

    function list_contact_delete($id)
    {
        //$data['rows'] = $this->model_client->client_edit($id)->row_array();
        $page = $this->db->where('id_contact', $id)->limit(1)->get('contact')->row();
        //print_r($page);
        getnameimg('../asset/foto_contact/' . $page->gambar, 'foto_contact');
        return $this->db->query("DELETE FROM contact where id_contact='$id'");
    }

    //fungsi simpan pesan
    function kirim_Pesan_inbox()
    {
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        //fikar z
        $datadb = array(
            'nama' => $this->db->escape_str($this->input->post('n')),
            'email' => $this->input->post('e'),
            'phone' => $this->input->post('p'),
            'subjek' => $this->input->post('s'),
            'tanggal' => date('Y-m-d'),
            'pesan' => $this->input->post('m')
        );




        if ($this->db->insert('hubungi', $datadb)) {
            //echo "berhasil";
            if ($this->db->affected_rows()) {
                $this->session->set_flashdata('success', 'berhasil terkirim !');
                return TRUE;
            } else {
                $this->session->set_flashdata('error', 'pesan gagal terkirim !');
                return FALSE;
            }
        }
    }
    //fungsi simpan pesan
    function kirim_Pesan()
    {
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        //fikar z
        $datadb = array(
            'nama' => $this->db->escape_str($this->input->post('n')),
            'email' => $this->input->post('e'),
            'phone' => $this->input->post('p'),
            'subjek' => $this->input->post('s'),
            'tanggal' => date('Y-m-d'),
            'pesan' => $this->input->post('m')
        );




        if ($this->db->insert('hubungi', $datadb)) {
            //echo "berhasil";
            if ($this->db->affected_rows()) {
                $this->session->set_flashdata('success', 'berhasil terkirim !');
                return TRUE;
            } else {
                $this->session->set_flashdata('error', 'pesan gagal terkirim !');
                return FALSE;
            }
        }
    }
    function kirim_email()
    {
        $nama           = $this->db->escape_str($this->input->post('n'));
        $email           = 'fikarcare4u@gmail.com'; //contactwebsite('email');
        $from           = $this->input->post('e');
        $subject         = $this->input->post('s');
        $message         = $this->db->escape_str($this->input->post('n')) . ' - ' . $this->input->post('p') . " <br><hr><br> " . $this->input->post('m');

        /*
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';

        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        */
        /*
        $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'alfajayatehnik@gmail.com',
                'smtp_pass' => 'xxx',
                'mailtype'  => 'html', 
                'charset'   => 'iso-8859-1'
        );
        */

        $rows = $this->model_users->users_edit($this->session->username)->row_array();
        $iden = $this->model_identitas->identitas()->row_array();
        $this->email->from($from, $nama . ' via website ' . $iden['nama_website']);
        $this->email->to($email);
        $this->email->cc('');
        $this->email->bcc('');

        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_mailtype("html");
        $this->email->send();

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        if ($this->email->send()) {
            $this->session->set_flashdata('pesanterkirim', 'email berhasil terkirim !');
            //return TRUE;
        } else {
            $this->session->set_flashdata('pesangagal', 'email tidak terkirim !');
        }
    }
    function pesan_masuk_kirim_admin()
    {
        $nama           = $this->db->escape_str($this->input->post('n'));
        $emailku           = contactwebsite('email');
        $from           = $this->input->post('n');
        $subject         = $this->input->post('s');
        $message         = $this->db->escape_str($this->input->post('n')) . ' - ' . $this->input->post('p') . " <br><hr><br> " . $this->input->post('m');

        //$rows = $this->model_users->users_edit($this->session->username)->row_array();
        //$iden = $this->model_identitas->identitas()->row_array();
        $this->email->from($from, 'via website CV. ALPHA JAYA TEHNIK');
        $this->email->to($emailku);
        $this->email->cc('');
        $this->email->bcc('');

        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_mailtype("html");
        $this->email->send();

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
    }
}
