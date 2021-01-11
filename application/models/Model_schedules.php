<?php 
class Model_schedules extends CI_model{
    function kategori_schedules(){
        return $this->db->query("SELECT * FROM kategori ORDER BY id_kategori DESC");
    }

    function kategori_schedules_tambah(){
        $datadb = array('nama_kategori'=>$this->db->escape_str($this->input->post('a')),
                        'kategori_seo'=>seo_title($this->input->post('a')),
                        'aktif'=>$this->db->escape_str($this->input->post('b')));
        $this->db->insert('kategori',$datadb);
    }

    function kategori_schedules_edit($id){
        return $this->db->query("SELECT * FROM kategori where id_kategori='$id'");
    }

    function kategori_schedules_update(){
        $datadb = array('nama_kategori'=>$this->db->escape_str($this->input->post('a')),
                        'kategori_seo'=>seo_title($this->input->post('a')),
                        'aktif'=>$this->db->escape_str($this->input->post('b')));
        $this->db->where('id_kategori',$this->input->post('id'));
        $this->db->update('kategori',$datadb);
    }

    function kategori_schedules_delete($id){
        return $this->db->query("DELETE FROM kategori where id_kategori='$id'");
    }


    function sensorkata(){
        return $this->db->query("SELECT * FROM katajelek ORDER BY id_jelek DESC");
    }

    function sensorkata_tambah(){
        $datadb = array('kata'=>$this->db->escape_str($this->input->post('a')),
                        'ganti'=>$this->db->escape_str($this->input->post('b')));
        $this->db->insert('katajelek',$datadb);
    }

    function sensorkata_edit($id){
        return $this->db->query("SELECT * FROM katajelek where id_jelek='$id'");
    }

    function sensorkata_update(){
        $datadb = array('kata'=>$this->db->escape_str($this->input->post('a')),
                        'ganti'=>$this->db->escape_str($this->input->post('b')));
        $this->db->where('id_jelek',$this->input->post('id'));
        $this->db->update('katajelek',$datadb);
    }

    function sensorkata_delete($id){
        return $this->db->query("DELETE FROM katajelek where id_jelek='$id'");
    }



    function tag_schedules(){
        return $this->db->query("SELECT * FROM tag ORDER BY id_tag DESC");
    }

    function tag_schedules_tambah(){
        $datadb = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
                        'tag_seo'=>seo_title($this->input->post('a')),
                        'count'=>'0');
        $this->db->insert('tag',$datadb);
    }

    function tag_schedules_edit($id){
        return $this->db->query("SELECT * FROM tag where id_tag='$id'");
    }

    function tag_schedules_update(){
        $datadb = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
                        'tag_seo'=>seo_title($this->input->post('a')));
        $this->db->where('id_tag',$this->input->post('id'));
        $this->db->update('tag',$datadb);
    }

    function tag_schedules_delete($id){
        return $this->db->query("DELETE FROM tag where id_tag='$id'");
    }

    function komentar_schedules($id_schedules){
        return $this->db->query("SELECT * FROM komentar where id_schedules = '$id_schedules' AND aktif='Y'");
    }

    function kirim_komentar(){
        $datadb = array('id_schedules'=>cetak($this->input->post('a')),
                                'nama_komentar'=>cetak($this->input->post('b')),
                                'url'=>cetak($this->input->post('c')),
                                'isi_komentar'=>cetak($this->input->post('d')),
                                'tgl'=>date('Y-m-d'),
                                'jam_komentar'=>date('H:i:s'),
                                'aktif'=>'N');
        $this->db->insert('komentar',$datadb);
    }

    function list_schedules_rss(){
        return $this->db->query("SELECT a.*, b.nama_kategori FROM schedules a LEFT JOIN kategori b ON a.id_kategori=b.id_kategori ORDER BY a.id_schedules DESC LIMIT 10");
    }

    function list_schedules(){
        return $this->db->query("SELECT a.*, b.nama_kategori FROM schedules a LEFT JOIN kategori b ON a.id_kategori=b.id_kategori ORDER BY a.id_schedules DESC");
    }

    
    function list_schedules_tambah(){
            $config['upload_path'] = webconfig('asset').'/foto_schedules/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $new_name = substr(md5(uniqid(mt_rand())),0,10).'_'.time().'_'.$_FILES["gambar"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $hasil=$this->upload->data();
            if ($this->input->post('j')!=''){
                $tag_seo = $this->input->post('j');
                $tag=implode(',',$tag_seo);
            }else{
                $tag = '';
            }
            //fikar
            $config = array(
                'field' => 'slug',
                'title' => 'judul',
                'table' => 'schedules',
                'id' => 'id_schedules',
            );
            $this->load->library('slug', $config);
            // create the slug
            //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
            //fikar z
            if ($_FILES["gambar"]['name']==''){
                    $datadb = array('judul'=>$this->db->escape_str($this->input->post('judul')),
                                    'slug'=> $this->slug->create_uri($this->input->post('judul')),
                                    'isi_schedules'=>$this->input->post('isi_schedules'),
                                    'meta_title'=>$this->input->post('meta_title'),
                                    'meta_keywords'=>$this->input->post('meta_keywords'),
                                    'meta_description'=>$this->input->post('meta_description'),
                                    'lokasi'=>$this->input->post('lokasi'),
                                    //'tgl_mulai'=>$this->input->post('tgl_mulai'),
                                    //'tgl_selesai'=>$this->input->post('tgl_selesai'),
                                    'tgl_mulai'=>tanggalindo($this->input->post('tgl_mulai'),"Y-m-d"),
                                    'tgl_selesai'=>tanggalindo($this->input->post('tgl_selesai'),"Y-m-d"),
                                    'jam_mulai'=>$this->input->post('jam_mulai'),
                                    'hari'=>hari_ini(date('w')),
                                    'tanggal'=>date('Y-m-d'),
                                    'jam'=>date('H:i:s'),
                                    'dibaca'=>'0',
                                    'tag'=>$tag,
                                    'username'=>$this->session->username,
                                    'id_kategori'=>$this->db->escape_str($this->input->post('id_kategori')));
            }else{
                    $datadb = array('judul'=>$this->db->escape_str($this->input->post('judul')),
                                    'slug'=> $this->slug->create_uri($this->input->post('judul')),
                                    'meta_title'=>$this->input->post('meta_title'),
                                    'meta_keywords'=>$this->input->post('meta_keywords'),
                                    'meta_description'=>$this->input->post('meta_description'),
                                    'isi_schedules'=>$this->input->post('isi_schedules'),
                                    'lokasi'=>$this->input->post('lokasi'),
                                    //'tgl_mulai'=>$this->input->post('tgl_mulai'),
                                    //'tgl_selesai'=>$this->input->post('tgl_selesai'),
                                    'tgl_mulai'=>tanggalindo($this->input->post('tgl_mulai'),"Y-m-d"),
                                    'tgl_selesai'=>tanggalindo($this->input->post('tgl_selesai'),"Y-m-d"),
                                    'jam_mulai'=>$this->input->post('jam_mulai'),
                                    'hari'=>hari_ini(date('w')),
                                    'tanggal'=>date('Y-m-d'),
                                    'jam'=>date('H:i:s'),
                                    'dibaca'=>'0',
                                    'tag'=>$tag,
                                    'username'=>$this->session->username,
                                    'id_kategori'=>$this->db->escape_str($this->input->post('id_kategori')),
                                    'gambar'=>$hasil['file_name']);
                    
            }

        if ($this->db->insert('schedules',$datadb)){
            //if(file_exists(webconfig('asset').'/foto_schedules/'.$hasil['file_name'])){
                thumb(webconfig('asset').'/foto_schedules/'.$hasil['file_name'],'400','200');
            //}
        }
    }


    function list_schedules_edit($id){
        return $this->db->query("SELECT * FROM schedules where id_schedules='$id'");
    }

    function list_schedules_update(){
        $config['upload_path'] = webconfig('asset').'/foto_schedules/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $new_name = substr(md5(uniqid(mt_rand())),0,10).'_'.time().'_'.$_FILES["gambar"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        $this->upload->do_upload('gambar');
        $hasil=$this->upload->data();
        //fikar
            $config = array(
                'field' => 'slug',
                'title' => 'judul',
                'table' => 'schedules',
                'id' => 'id_schedules',
            );
            $this->load->library('slug', $config);
            // create the slug
            //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
            //fikar z
            $page = $this->db->where('id_schedules', $this->input->post('id'))->limit(1)->get('schedules')->row();
            if ( $this->db->escape_str($this->input->post('judul')) != $page->judul ){
                //$slugku = $page->slug;
                $new_slug = true;
            }
            else{
                //$slugku = $this->slug->create_uri($this->input->post('a'));
                $new_slug = false;
            }

            if ($this->input->post('j')!=''){
                $tag_seo = $this->input->post('j');
                $tag=implode(',',$tag_seo);
            }else{
                $tag = '';
            }
            if ($_FILES["gambar"]['name']==''){
                $imgupdate = false;
                $datadb = array('id_kategori'=>$this->db->escape_str($this->input->post('id_kategori')),
                                //'username'=>$this->db->escape_str($this->input->post('username')),
                                'judul'=>$this->db->escape_str($this->input->post('judul')),
                                'judul_seo'=>seo_title($this->input->post('judul')),
                                'headline'=>$this->db->escape_str($this->input->post('headline')),
                                'isi_schedules'=>$this->input->post('isi_schedules'),
                                'meta_title'=>$this->input->post('meta_title'),
                                'meta_keywords'=>$this->input->post('meta_keywords'),
                                'meta_description'=>$this->input->post('meta_description'),
                                'lokasi'=>$this->input->post('lokasi'),
                                'tgl_mulai'=>tanggalindo($this->input->post('tgl_mulai'),"Y-m-d"),
                                'tgl_selesai'=>tanggalindo($this->input->post('tgl_selesai'),"Y-m-d"),
                                'jam_mulai'=>$this->input->post('jam_mulai'),
                                'hari'=>hari_ini(date('w')),
                                'tanggal'=>date('Y-m-d'),
                                'jam'=>date('H:i:s'),
                                'username'=>$this->session->username,
                                'dibaca'=>'0',
                                'tag'=>$tag);
            }else{
                $imgupdate = true;
                $datadb = array('id_kategori'=>$this->db->escape_str($this->input->post('id_kategori')),
                                //'username'=>$this->db->escape_str($this->input->post('username')),
                                'judul'=>$this->db->escape_str($this->input->post('judul')),
                                'judul_seo'=>seo_title($this->input->post('judul')),
                                'headline'=>$this->db->escape_str($this->input->post('headline')),
                                'isi_schedules'=>$this->input->post('isi_schedules'),
                                'meta_title'=>$this->input->post('meta_title'),
                                'meta_keywords'=>$this->input->post('meta_keywords'),
                                'meta_description'=>$this->input->post('meta_description'),
                                'lokasi'=>$this->input->post('lokasi'),
                                //'tgl_mulai'=>date_format(date_create($this->input->post('tgl_mulai')),"Y/m/d"),
                                //'tgl_selesai'=>date_format(date_create($this->input->post('tgl_selesai')),"Y/m/d"),
                                'tgl_mulai'=>tanggalindo($this->input->post('tgl_mulai'),"Y-m-d"),
                                'tgl_selesai'=>tanggalindo($this->input->post('tgl_selesai'),"Y-m-d"),
                                'jam_mulai'=>$this->input->post('jam_mulai'),
                                'hari'=>hari_ini(date('w')),
                                'tanggal'=>date('Y-m-d'),
                                'jam'=>date('H:i:s'),
                                'username'=>$this->session->username,
                                'gambar'=>$hasil['file_name'],
                                'dibaca'=>'0',
                                'tag'=>$tag);

                getnameimg(webconfig('asset').'/foto_schedules/'.$page->gambar,'foto_schedules');
                //unlink('asset/foto_schedules/'.$page->gambar);
            }
            if ($new_slug){
                $datadb['slug'] = $this->slug->create_uri($this->input->post('judul'));
            }
        $this->db->where('id_schedules',$this->input->post('id'));
        
        if ($this->db->update('schedules',$datadb)){
            if ($imgupdate == true){
                //if(file_exists(webconfig('asset').'/foto_schedules/'.$hasil['file_name'])){
                    thumb(webconfig('asset').'/foto_schedules/'.$hasil['file_name'],'400','200');
                //}
            }
        }
    }

    function list_schedules_delete($id){
        $page = $this->db->where('id_schedules', $id)->limit(1)->get('schedules')->row();
        //print_r($page);
        getnameimg('asset/foto_schedules/'.$page->gambar,'foto_schedules');
        return $this->db->query("DELETE FROM schedules where id_schedules='$id'");
    }


    function komentar(){
        return $this->db->query("SELECT * FROM komentar ORDER BY id_komentar DESC");
    }

    function komentar_edit($id){
        return $this->db->query("SELECT * FROM komentar where id_komentar='$id'");
    }

    function komentar_update(){
        $datadb = array('nama_komentar'=>$this->db->escape_str($this->input->post('a')),
                        'url'=>$this->db->escape_str($this->input->post('b')),
                        'isi_komentar'=>$this->input->post('c'),
                        'aktif'=>$this->input->post('d'));
        $this->db->where('id_komentar',$this->input->post('id'));
        $this->db->update('komentar',$datadb);
    }

    function komentar_delete($id){
        return $this->db->query("DELETE FROM komentar where id_komentar='$id'");
    }
}