<?php
class Model_utama_sertifikat extends CI_model{
    function sertifikat_detail($id){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM sertifikat a JOIN users b ON a.username=b.username where a.slug='".$this->db->escape_str($id)."'");
    }
    function sertifikat_update_count($id){
        return $this->db->query("UPDATE sertifikat SET sertifikat_views=sertifikat_views+1 where slug='".$this->db->escape_str($id)."'");
    }
    function semua_sertifikat_categories($start, $limit,$cat_id,$sort='DESC'){
        $this->db->order_by('id_sertifikat', $sort);
        $query = $this->db->get_where('sertifikat',array('id_categories' => $cat_id), $start, $limit);
        return $query;
        //return $this->db->query("SELECT * FROM sertifikat where id_categories='$cat_id' LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM sertifikat where id_categories='$cat_id' ORDER BY id_sertifikat $sort LIMIT $start,$limit");

        //return $this->db->query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT $start,$limit");
    }
    function get_hitung_sertifikat_tags($post_type='berita', $tags_id){

        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
        $hasil = $this->db->query('SELECT b.*
                    FROM sertifikat_tagmap bt, '.$post_type.' b, sertifikat_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_sertifikat
                    GROUP BY b.id_'.$post_type.'');
        return $hasil;
    }
    function get_detail_sertifikat_tags($post_type='berita',$tags_id,$dari,$sampai){
        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_berita DESC LIMIT $dari,$sampai");
        $hasil = $this->db->query('SELECT b.*
                    FROM sertifikat_tagmap bt, '.$post_type.' b, sertifikat_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_sertifikat
                    GROUP BY b.id_'.$post_type.'');
        return $hasil;
    }
    function hitungsertifikatcategories($kat){
        return $this->db->query("SELECT * FROM sertifikat where id_categories='".$this->db->escape_str($kat)."'");
    }

    function hitungsertifikattags($kat){
        return $this->db->query("SELECT * FROM sertifikat where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
    }
    function detail_sertifikat_categories($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM sertifikat where id_categories='".$this->db->escape_str($id)."' ORDER BY id_sertifikat DESC LIMIT $dari,$sampai");
    }
    function detail_sertifikat_tags($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM sertifikat where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_sertifikat DESC LIMIT $dari,$sampai");
    }
    function hitungsertifikat(){
        return $this->db->query("SELECT * FROM sertifikat");
    }
    function sertifikat($start, $limit){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM sertifikat a JOIN users b ON a.username=b.username ORDER BY a.id_sertifikat DESC LIMIT $start, $limit");
    }
}
