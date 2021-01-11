<?php
class Model_utama_berita extends CI_model{
    function berita_detail($id){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM berita a JOIN users b ON a.username=b.username where a.slug='".$this->db->escape_str($id)."'");
    }
    function berita_update_count($id){
        return $this->db->query("UPDATE berita SET berita_views=berita_views+1 where slug='".$this->db->escape_str($id)."'");
    }
    function semua_berita_categories($start, $limit,$cat_id,$sort='DESC'){
        $this->db->order_by('id_berita', $sort);
        $query = $this->db->get_where('berita',array('id_categories' => $cat_id), $start, $limit);
        return $query;
        //return $this->db->query("SELECT * FROM berita where id_categories='$cat_id' LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM berita where id_categories='$cat_id' ORDER BY id_berita $sort LIMIT $start,$limit");

        //return $this->db->query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT $start,$limit");
    }
    function get_hitung_berita_tags($post_type='berita', $tags_id){

        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
        $hasil = $this->db->query('SELECT b.*
                    FROM berita_tagmap bt, '.$post_type.' b, berita_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_berita
                    GROUP BY b.id_'.$post_type.'');
        return $hasil;
    }
    function get_detail_berita_tags($post_type='berita',$tags_id,$dari,$sampai){
        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_berita DESC LIMIT $dari,$sampai");
        $hasil = $this->db->query('SELECT b.*
                    FROM berita_tagmap bt, '.$post_type.' b, berita_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_berita
                    GROUP BY b.id_'.$post_type.'');
        return $hasil;
    }
    function hitungberitacategories($kat){
        return $this->db->query("SELECT * FROM berita where id_categories='".$this->db->escape_str($kat)."'");
    }

    function hitungberitatags($kat){
        return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
    }
    function detail_berita_categories($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM berita where id_categories='".$this->db->escape_str($id)."' ORDER BY id_berita DESC LIMIT $dari,$sampai");
    }
    function detail_berita_tags($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_berita DESC LIMIT $dari,$sampai");
    }
    function getRows_berita($id = ''){
        $this->db->select('*');
        $this->db->from('files');
        if($id){
            $this->db->where('id_post',$id);
            $this->db->where('post_type','berita');
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
