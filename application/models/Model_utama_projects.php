<?php 
class Model_utama_projects extends CI_model{
    
    function semua_projects($start, $limit){
        return $this->db->query("SELECT * FROM projects ORDER BY id_projects DESC LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM projects ORDER BY id_projects DESC LIMIT $start,$limit");
    }
    function detail_projects_categories($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM projects where id_categories='".$this->db->escape_str($id)."' ORDER BY id_projects DESC LIMIT $dari,$sampai");
    }
    
    function hitungprojectscategories($kat){
        return $this->db->query("SELECT * FROM projects where id_categories='".$this->db->escape_str($kat)."'");
    }

    //fikar
    //projects
    function projects($start, $limit){
        return $this->db->query("SELECT a.*, b.nama_lengkap FROM projects a JOIN users b ON a.username=b.username ORDER BY a.id_projects DESC LIMIT $start, $limit");
    }
    function hitungprojects(){
        return $this->db->query("SELECT * FROM projects");
    }
    function projects_detail($id){
        return $this->db->query("SELECT a.*, b.nama_lengkap FROM projects a JOIN users b ON a.username=b.username where a.slug='".$this->db->escape_str($id)."'");
    }

    //fikar end
     //toxi tag
    function hitung_projects_tags($post_type='projects', $tags_id){

        //return $this->db->query("SELECT * FROM projects where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
        $hasil = $this->db->query('SELECT b.*
                    FROM tagmap bt, projects b, tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_projects = bt.id_berita
                    GROUP BY b.id_projects');
        return $hasil;
    }
    function detail_projects_tags($post_type='projects',$tags_id,$dari,$sampai){
        //return $this->db->query("SELECT * FROM projects where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_projects DESC LIMIT $dari,$sampai");
        $hasil = $this->db->query('SELECT b.*
                    FROM tagmap bt, projects b, tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_projects = bt.id_berita
                    GROUP BY b.id_projects');
        return $hasil;
    }

    //toxi tag end
    
}