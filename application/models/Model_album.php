<?php 
class Model_album extends CI_model{
    function album(){
        return $this->db->query("SELECT * FROM album ORDER BY id_album DESC");
    }

    function album_tambah(){
        $config['upload_path'] = 'asset/img_album/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('b');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('jdl_album'=>$this->db->escape_str($this->input->post('a')),
                            'album_seo'=>seo_title($this->input->post('a')),
                            'aktif'=>'Y');
        }else{
        	$datadb = array('jdl_album'=>$this->db->escape_str($this->input->post('a')),
                            'album_seo'=>seo_title($this->input->post('a')),
                            'gbr_album'=>$hasil['file_name'],
                            'aktif'=>'Y');
        }
        $this->db->insert('album',$datadb);
    }

    function album_edit($id){
        return $this->db->query("SELECT * FROM album where id_album='$id'");
    }

    function album_update(){
        $config['upload_path'] = 'asset/img_album/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('b');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('jdl_album'=>$this->db->escape_str($this->input->post('a')),
                            'album_seo'=>seo_title($this->input->post('a')),
                            'aktif'=>$this->db->escape_str($this->input->post('d')),);
        }else{
            $datadb = array('jdl_album'=>$this->db->escape_str($this->input->post('a')),
                            'album_seo'=>seo_title($this->input->post('a')),
                            'gbr_album'=>$hasil['file_name'],
                            'aktif'=>$this->db->escape_str($this->input->post('d')),);
        }
        $this->db->where('id_album',$this->input->post('id'));
        $this->db->update('album',$datadb);
    }

    function album_delete($id){
        return $this->db->query("DELETE FROM album where id_album='$id'");
    }




    function galeri(){
        return $this->db->query("SELECT a.*, b.jdl_album FROM gallery a JOIN album b ON a.id_album=b.id_album ORDER BY a.id_gallery DESC");
    }

    function galeri_tambah(){
        $config['upload_path'] = 'asset/img_galeri/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('d');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('id_album'=>$this->db->escape_str($this->input->post('a')),
                            'jdl_gallery'=>$this->db->escape_str($this->input->post('b')),
                            'gallery_seo'=>seo_title($this->input->post('b')),
                            'keterangan'=>$this->input->post('c'));
        }else{
            $datadb = array('id_album'=>$this->db->escape_str($this->input->post('a')),
                            'jdl_gallery'=>$this->db->escape_str($this->input->post('b')),
                            'gallery_seo'=>seo_title($this->input->post('b')),
                            'keterangan'=>$this->input->post('c'),
                            'gbr_gallery'=>$hasil['file_name']);
        }
        $this->db->insert('gallery',$datadb);
    }

    function galeri_edit($id){
        return $this->db->query("SELECT * FROM gallery where id_gallery='$id'");
    }

    function galeri_update(){
        $config['upload_path'] = 'asset/img_galeri/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('d');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
            $datadb = array('id_album'=>$this->db->escape_str($this->input->post('a')),
                            'jdl_gallery'=>$this->db->escape_str($this->input->post('b')),
                            'gallery_seo'=>seo_title($this->input->post('b')),
                            'keterangan'=>$this->input->post('c'));
        }else{
            $datadb = array('id_album'=>$this->db->escape_str($this->input->post('a')),
                            'jdl_gallery'=>$this->db->escape_str($this->input->post('b')),
                            'gallery_seo'=>seo_title($this->input->post('b')),
                            'keterangan'=>$this->input->post('c'),
                            'gbr_gallery'=>$hasil['file_name']);
        }
        $this->db->where('id_gallery',$this->input->post('id'));
        $this->db->update('gallery',$datadb);
    }

    function galeri_delete($id){
        return $this->db->query("DELETE FROM gallery where id_gallery='$id'");
    }
}