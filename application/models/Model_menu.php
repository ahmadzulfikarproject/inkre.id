<?php 
class Model_menu extends CI_model{
    function menuutama(){
        //$this->db->order_by('arrange DESC');
        return $this->db->query("SELECT * FROM mainmenu ORDER BY `arrange` ASC");

    }

    function menuutama_tambah(){
            $datadb = array('nama_menu'=>$this->db->escape_str($this->input->post('a')),
                            'link'=>$this->db->escape_str($this->input->post('b')),
                            'aktif'=>$this->db->escape_str($this->input->post('c')),
                            'adminmenu'=>$this->db->escape_str($this->input->post('d')),
                            'arrange'=>$this->db->escape_str($this->input->post('arrange')));
        $this->db->insert('mainmenu',$datadb);
    }

    function menuutama_update(){
            $datadb = array('nama_menu'=>$this->db->escape_str($this->input->post('a')),
                            'link'=>$this->db->escape_str($this->input->post('b')),
                            'aktif'=>$this->db->escape_str($this->input->post('c')),
                            'adminmenu'=>$this->db->escape_str($this->input->post('d')),
                            'arrange'=>$this->db->escape_str($this->input->post('arrange')));
        $this->db->where('id_main',$this->input->post('id'));
        $this->db->update('mainmenu',$datadb);
    }

    function menuutama_edit($id){
        return $this->db->query("SELECT * FROM mainmenu where id_main='$id'");
    }

    function menuutama_delete($id){
        return $this->db->query("DELETE FROM mainmenu where id_main='$id'");
    }




    function submenu(){
        return $this->db->query("SELECT a.*, b.nama_menu FROM submenu a LEFT JOIN mainmenu b ON a.id_main=b.id_main");
    }

    function cek_menuutama(){
        return $this->db->query("SELECT * FROM mainmenu where aktif='Y' ORDER BY arrange ASC");
    }

    function cek_submenu(){
        return $this->db->query("SELECT * FROM submenu where aktif='Y' ORDER BY arrange ASC");
    }

    function submenu_tambah(){
        $datadb = array('nama_sub'=>$this->db->escape_str($this->input->post('a')),
                        'link_sub'=>$this->db->escape_str($this->input->post('d')),
                        'id_main'=>$this->db->escape_str($this->input->post('b')),
                        'id_submain'=>$this->db->escape_str($this->input->post('c')),
                        'aktif'=>$this->db->escape_str($this->input->post('e')),
                        'adminsubmenu'=>$this->db->escape_str($this->input->post('f')));
        $this->db->insert('submenu',$datadb);
    }

    function submenu_update(){
        $datadb = array('nama_sub'=>$this->db->escape_str($this->input->post('a')),
                        'link_sub'=>$this->db->escape_str($this->input->post('d')),
                        'id_main'=>$this->db->escape_str($this->input->post('b')),
                        'id_submain'=>$this->db->escape_str($this->input->post('c')),
                        'aktif'=>$this->db->escape_str($this->input->post('e')),
                        'adminsubmenu'=>$this->db->escape_str($this->input->post('f')));
        $this->db->where('id_sub',$this->input->post('id'));
        $this->db->update('submenu',$datadb);
    }

    function submenu_edit($id){
        return $this->db->query("SELECT * FROM submenu where id_sub='$id'");
    }

    function submenu_delete($id){
        return $this->db->query("DELETE FROM submenu where id_sub='$id'");
    }

    function mainmenu_admin(){
        return $this->db->query("SELECT * FROM mainmenu WHERE aktif = 'N' AND adminmenu= 'Y' ORDER BY arrange ASC");
    }

    function submenu_admin($id_main){
        return $this->db->query("SELECT * FROM submenu, mainmenu WHERE submenu.id_main = mainmenu.id_main AND submenu.id_main='$id_main' AND submenu.aktif='N'");
    }

    function mainmenu_user(){
        return $this->db->query("SELECT * FROM modul where status='user' and aktif='Y' order by urutan");
    }

}