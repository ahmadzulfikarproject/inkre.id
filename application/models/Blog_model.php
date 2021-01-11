<?php
class Blog_model extends CI_Model{

	function get_all_blog(){
		$result=$this->db->get('blog');
		return $result;
	}

	function search_blog($title){
		$this->db->like('blog_title', $title , 'both');
		$this->db->order_by('blog_title', 'ASC');
		$this->db->limit(10);
		return $this->db->get('blog')->result();
	}
	function insert_blogdb($data){
        //return $this->db->query("SELECT * FROM halamanstatis where id_halaman='$id'");
        $this->db->insert('blog',$data);
        //$this->db->insert($this->table, $data);
		return $this->db->insert_id();
    }

}