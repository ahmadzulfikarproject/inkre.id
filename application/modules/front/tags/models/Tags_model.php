<?php
class Tags_model extends CI_Model{

	function get_all_tags(){
		$result=$this->db->get('tags');
		return $result;
	}

	function search_tags($title){
		$this->db->like('tags_title', $title , 'both');
		$this->db->order_by('tags_title', 'ASC');
		$this->db->limit(10);
		return $this->db->get('tags')->result();
	}
	function insert_tagsdb($data){
		/*
		$datadb = array('name'=>$this->db->escape_str($this->input->post('a')),
                        'tag_seo'=>seo_title($this->input->post('a')),
                        'count'=>'0');
        //return $this->db->query("SELECT * FROM halamanstatis where id_halaman='$id'");
        */
        $this->db->insert('tags',$data);
        //$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
    }
    function insert_blogdb($data){
        //return $this->db->query("SELECT * FROM halamanstatis where id_halaman='$id'");
        $this->db->insert('blog',$data);
        //$this->db->insert($this->table, $data);
		return $this->db->insert_id();
    }

}