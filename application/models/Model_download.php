<?php 
class Model_download extends CI_model{
    function download(){
        return $this->db->query("SELECT * FROM download ORDER BY id_download DESC");
    }

    function download_tambah(){
        $config['upload_path'] = 'asset/files/';
        $config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt';
        $config['max_size'] = '25000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('b');
        $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'tgl_posting'=>date('Y-m-d'),
                                    'hits'=>'0');
            }else{
            		$datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'nama_file'=>$hasil['file_name'],
                                    'tgl_posting'=>date('Y-m-d'),
                                    'hits'=>'0');
            }
        $this->db->insert('download',$datadb);
    }

    function download_edit($id){
        return $this->db->query("SELECT * FROM download where id_download='$id'");
    }

    function download_update(){
        $config['upload_path'] = 'asset/files/';
        $config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt';
        $config['max_size'] = '25000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('b');
        $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'tgl_posting'=>date('Y-m-d'),
                                    'hits'=>'0');
            }else{
            		$datadb = array('judul'=>$this->db->escape_str($this->input->post('a')),
                                    'nama_file'=>$hasil['file_name'],
                                    'tgl_posting'=>date('Y-m-d'),
                                    'hits'=>'0');
            }
        $this->db->where('id_download',$this->input->post('id'));
        $this->db->update('download',$datadb);
    }

    function download_delete($id){
        return $this->db->query("DELETE FROM download where id_download='$id'");
    }
    
    function pegawai(){
        return $this->db->query("SELECT * FROM pegawai ORDER BY id_pegawai DESC");
    }

    function pegawai_tambah(){
        $config['upload_path'] = 'asset/files/';
        $config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt';
        $config['max_size'] = '25000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('d');
        $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $datadb = array('nama_pegawai'=>$this->db->escape_str($this->input->post('a')),
                                    'jabatan'=>$this->db->escape_str($this->input->post('b')),
                                    'atasan_langsung'=>$this->db->escape_str($this->input->post('c')),
                                    'gdrive'=>$this->db->escape_str($this->input->post('e')),
                                    'tgl_posting'=>date('Y-m-d'),
                                    'hits'=>'0');
            }else{
                    $datadb = array('nama_pegawai'=>$this->db->escape_str($this->input->post('a')),
                                    'jabatan'=>$this->db->escape_str($this->input->post('b')),
                                    'atasan_langsung'=>$this->db->escape_str($this->input->post('c')),
                                    'nama_file'=>$hasil['file_name'],
                                    'gdrive'=>$this->db->escape_str($this->input->post('e')),
                                    'tgl_posting'=>date('Y-m-d'),
                                    'hits'=>'0');
            }
        $this->db->insert('pegawai',$datadb);
    }

    function pegawai_edit($id){
        return $this->db->query("SELECT * FROM pegawai where id_pegawai='$id'");
    }

    function pegawai_update(){
        $config['upload_path'] = 'asset/files/';
        $config['allowed_types'] = 'gif|jpg|png|zip|rar|pdf|doc|docx|ppt|pptx|xls|xlsx|txt';
        $config['max_size'] = '25000'; // kb
        $this->load->library('upload', $config);
        $this->upload->do_upload('d');
        $hasil=$this->upload->data();
            if ($hasil['file_name']==''){
                    $datadb = array('nama_pegawai'=>$this->db->escape_str($this->input->post('a')),
                                    'jabatan'=>$this->db->escape_str($this->input->post('b')),
                                    'atasan_langsung'=>$this->db->escape_str($this->input->post('c')),
                                    'gdrive'=>$this->db->escape_str($this->input->post('e')),
                                    'tgl_posting'=>date('Y-m-d'),
                                    'hits'=>'0');
            }else{
                    $datadb = array('nama_pegawai'=>$this->db->escape_str($this->input->post('a')),
                                    'jabatan'=>$this->db->escape_str($this->input->post('b')),
                                    'atasan_langsung'=>$this->db->escape_str($this->input->post('c')),
                                    'nama_file'=>$hasil['file_name'],
                                    'gdrive'=>$this->db->escape_str($this->input->post('e')),
                                    'tgl_posting'=>date('Y-m-d'),
                                    'hits'=>'0');
            }
        $this->db->where('id_pegawai',$this->input->post('id'));
        $this->db->update('pegawai',$datadb);
    }

    function pegawai_delete($id){
        return $this->db->query("DELETE FROM pegawai where id_pegawai='$id'");
    }
}