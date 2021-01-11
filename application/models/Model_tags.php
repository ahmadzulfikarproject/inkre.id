<?php 
class Model_tags extends CI_model{
    
    function tags($query){
    	//SELECT name FROM tags WHERE name LIKE '%".$_GET['query']."%'LIMIT 10
		return $this->db->query("SELECT name FROM tags WHERE name LIKE '%".$query."%' LIMIT 10");
        //return $this->db->query("SELECT * FROM tag ORDER BY id_tag DESC");
    }

    function tags_tambah(){
        $datadb = array('name'=>$this->db->escape_str($this->input->post('a')),
                        'tag_seo'=>seo_title($this->input->post('a')),
                        'count'=>'0');
        $this->db->insert('tag',$datadb);
    }

    function tags_edit($id){
        return $this->db->query("SELECT * FROM tag where id_tag='$id'");
    }

    function tags_update(){
        $datadb = array('name'=>$this->db->escape_str($this->input->post('a')),
                        'tag_seo'=>seo_title($this->input->post('a')));
        $this->db->where('id_tag',$this->input->post('id'));
        $this->db->update('tag',$datadb);
    }

    function tags_delete($id){
        return $this->db->query("DELETE FROM tag where id_tag='$id'");
    }

    //fikar
    function search_tags($tags){
        $this->db->like('name', $title , 'both');
        $this->db->order_by('name', 'ASC');
        $this->db->limit(10);
        return $this->db->get('tags')->result();
    }
 

    
}