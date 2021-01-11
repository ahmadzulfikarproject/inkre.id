<?php 
class Model_polling extends CI_model{
    function polling(){
        return $this->db->query("SELECT * FROM poling ORDER BY id_poling DESC");
    }

    function polling_tambah(){
        $datadb = array('pilihan'=>$this->db->escape_str($this->input->post('a')),
                        'status'=>$this->db->escape_str($this->input->post('c')),
                        'rating'=>'0',
                        'aktif'=>$this->db->escape_str($this->input->post('b')));
        $this->db->insert('poling',$datadb);
    }

    function polling_edit($id){
        return $this->db->query("SELECT * FROM poling where id_poling='$id'");
    }

    function polling_update(){
        $datadb = array('pilihan'=>$this->db->escape_str($this->input->post('a')),
                        'status'=>$this->db->escape_str($this->input->post('c')),
                        'aktif'=>$this->db->escape_str($this->input->post('b')));
        $this->db->where('id_poling',$this->input->post('id'));
        $this->db->update('poling',$datadb);
    }

    function polling_delete($id){
        return $this->db->query("DELETE FROM poling where id_poling='$id'");
    }
}