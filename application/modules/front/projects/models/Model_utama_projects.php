<?php
class Model_utama_projects extends CI_model{
    function projects_detail($id){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM projects a JOIN users b ON a.username=b.username where a.slug='".$this->db->escape_str($id)."'");
    }
    function projects_update_count($id){
        return $this->db->query("UPDATE projects SET projects_views=projects_views+1 where slug='".$this->db->escape_str($id)."'");
    }
    function semua_projects_categories($start, $limit,$cat_id,$sort='DESC'){
        $this->db->order_by('id_projects', $sort);
        $query = $this->db->get_where('projects',array('id_categories' => $cat_id), $start, $limit);
        return $query;
        //return $this->db->query("SELECT * FROM projects where id_categories='$cat_id' LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM projects where id_categories='$cat_id' ORDER BY id_projects $sort LIMIT $start,$limit");

        //return $this->db->query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT $start,$limit");
    }
    function get_hitung_projects_tags($post_type='berita', $tags_id){

        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
        $hasil = $this->db->query('SELECT b.*
                    FROM projects_tagmap bt, '.$post_type.' b, projects_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_projects
                    GROUP BY b.id_'.$post_type.'');
        return $hasil;
    }
    function get_detail_projects_tags($post_type='berita',$tags_id,$dari,$sampai){
        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_berita DESC LIMIT $dari,$sampai");
        $hasil = $this->db->query('SELECT b.*
                    FROM projects_tagmap bt, '.$post_type.' b, projects_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_projects
                    GROUP BY b.id_'.$post_type.'');
        return $hasil;
    }
    function hitungprojectscategories($kat){
        return $this->db->query("SELECT * FROM projects where id_categories='".$this->db->escape_str($kat)."'");
    }

    function hitungprojectstags($kat){
        return $this->db->query("SELECT * FROM projects where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
    }
    function detail_projects_categories($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM projects where id_categories='".$this->db->escape_str($id)."' ORDER BY id_projects DESC LIMIT $dari,$sampai");
    }
    function detail_projects_tags($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM projects where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_projects DESC LIMIT $dari,$sampai");
    }
    function hitungprojects(){
        return $this->db->query("SELECT * FROM projects");
    }
    function projects($start, $limit){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM projects a JOIN users b ON a.username=b.username ORDER BY a.id_projects DESC LIMIT $start, $limit");
    }
    function getRows_projects($id = ''){
        $this->db->select('*');
        $this->db->from('files');
        if($id){
            $this->db->where('id_post',$id);
            $this->db->where('post_type','projects');
            $query = $this->db->get();
            $result = $query->result_array();
        }else{
            $this->db->order_by('uploaded_on','desc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result)?$result:false;
    }
}
