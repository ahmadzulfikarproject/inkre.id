<?php
class Model_utama_gallery extends CI_model{
    function gallery_detail($id){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM gallery a JOIN users b ON a.username=b.username where a.slug='".$this->db->escape_str($id)."'");
    }
    function getRows_gallery($id = ''){
        $this->db->select('*');
        $this->db->from('files');
        if($id){
            $this->db->where('id_post',$id);
            $query = $this->db->get();
            $result = $query->result_array();
        }else{
            $this->db->order_by('uploaded_on','desc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result)?$result:false;
    }
    function gallery_update_count($id){
        return $this->db->query("UPDATE gallery SET gallery_views=gallery_views+1 where slug='".$this->db->escape_str($id)."'");
    }
    function semua_gallery_categories($start, $limit,$cat_id,$sort='DESC'){
        $this->db->order_by('id_gallery', $sort);
        $query = $this->db->get_where('gallery',array('id_categories' => $cat_id), $start, $limit);
        return $query;
        //return $this->db->query("SELECT * FROM gallery where id_categories='$cat_id' LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM gallery where id_categories='$cat_id' ORDER BY id_gallery $sort LIMIT $start,$limit");

        //return $this->db->query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT $start,$limit");
    }
    function get_hitung_gallery_tags($post_type='berita', $tags_id){

        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
        $hasil = $this->db->query('SELECT b.*
                    FROM gallery_tagmap bt, '.$post_type.' b, gallery_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_gallery
                    GROUP BY b.id_'.$post_type.'');
        return $hasil;
    }
    function get_detail_gallery_tags($post_type='berita',$tags_id,$dari,$sampai){
        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_berita DESC LIMIT $dari,$sampai");
        $hasil = $this->db->query('SELECT b.*
                    FROM gallery_tagmap bt, '.$post_type.' b, gallery_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_gallery
                    GROUP BY b.id_'.$post_type.'');
        return $hasil;
    }
    function hitunggallerycategories($kat){
        return $this->db->query("SELECT * FROM gallery where id_categories='".$this->db->escape_str($kat)."'");
    }

    function hitunggallerytags($kat){
        return $this->db->query("SELECT * FROM gallery where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
    }
    function detail_gallery_categories($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM gallery where id_categories='".$this->db->escape_str($id)."' ORDER BY id_gallery DESC LIMIT $dari,$sampai");
    }
    function detail_gallery_tags($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM gallery where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_gallery DESC LIMIT $dari,$sampai");
    }
    function hitunggallery(){
        return $this->db->query("SELECT * FROM gallery");
    }
    function gallery($start, $limit){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM gallery a JOIN users b ON a.username=b.username ORDER BY a.id_gallery DESC LIMIT $start, $limit");
    }
}
