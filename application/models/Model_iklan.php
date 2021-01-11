<?php 
class Model_iklan extends CI_model{
    function banner(){
        return $this->db->query("SELECT * FROM banner");
    }

    function banner_tambah(){
    	$config['upload_path'] = 'asset/foto_banner/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
	        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
	                        'url'=>$this->input->post('b'),
	                        'tgl_posting'=>date('Y-m-d'));
	    }else{
	        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
	                        'url'=>$this->input->post('b'),
	                        'gambar'=>$hasil['file_name'],
	                        'tgl_posting'=>date('Y-m-d'));
	    }
        $this->db->insert('banner',$datadb);
    }

    function banner_edit($id){
        return $this->db->query("SELECT * FROM banner where id_banner='$id'");
    }

    function banner_update(){
    	$config['upload_path'] = 'asset/foto_banner/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        if ($hasil['file_name']==''){
	        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
	                        'url'=>$this->input->post('b'),
	                        'tgl_posting'=>date('Y-m-d'));
	    }else{
	        $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
	                        'url'=>$this->input->post('b'),
	                        'gambar'=>$hasil['file_name'],
	                        'tgl_posting'=>date('Y-m-d'));
	    }
        $this->db->where('id_banner',$this->input->post('id'));
        $this->db->update('banner',$datadb);
    }

    function banner_delete($id){
        return $this->db->query("DELETE FROM banner where id_banner='$id'");
    }
}