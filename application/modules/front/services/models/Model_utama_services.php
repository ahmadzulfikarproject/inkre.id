<?php
class Model_utama_services extends CI_model{
    function services_detail($id){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM services a JOIN users b ON a.username=b.username where a.slug='".$this->db->escape_str($id)."'");
    }
    function services_update_count($id){
        return $this->db->query("UPDATE services SET services_views=services_views+1 where slug='".$this->db->escape_str($id)."'");
    }
    function semua_services_categories($start, $limit,$cat_id,$sort='DESC'){
        $this->db->order_by('id_services', $sort);
        $query = $this->db->get_where('services',array('id_categories' => $cat_id), $start, $limit);
        return $query;
        //return $this->db->query("SELECT * FROM services where id_categories='$cat_id' LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM services where id_categories='$cat_id' ORDER BY id_services $sort LIMIT $start,$limit");

        //return $this->db->query("SELECT * FROM berita ORDER BY id_services DESC LIMIT $start,$limit");
    }
    function get_hitung_services_tags($post_type='berita', $tags_id){

        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
        $hasil = $this->db->query('SELECT b.*
                    FROM services_tagmap bt, '.$post_type.' b, services_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_services
                    GROUP BY b.id_'.$post_type.' ORDER BY b.id_services DESC');
        return $hasil;
    }
    function get_detail_services_tags($post_type='berita',$tags_id,$dari,$sampai){
        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_services DESC LIMIT $dari,$sampai");
        $hasil = $this->db->query('SELECT b.*
                    FROM services_tagmap bt, '.$post_type.' b, services_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_services
                    GROUP BY b.id_'.$post_type.' ORDER BY b.id_services DESC');
        return $hasil;
    }
    function hitungservicescategories($kat){
        return $this->db->query("SELECT * FROM services where id_categories='".$this->db->escape_str($kat)."'");
    }

    function hitungservicestags($kat){
        return $this->db->query("SELECT * FROM services where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
    }
    function detail_services_categories($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM services where id_categories='".$this->db->escape_str($id)."' ORDER BY id_services DESC LIMIT $dari,$sampai");
    }
    function detail_services_tags($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM services where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_services DESC LIMIT $dari,$sampai");
    }
    function hitungservices(){
        return $this->db->query("SELECT * FROM services");
    }
    function services($start, $limit){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM services a JOIN users b ON a.username=b.username ORDER BY a.id_services DESC LIMIT $start, $limit");
    }
    function getRows_services($id = ''){
        $this->db->select('*');
        $this->db->from('files');
        if($id){
            $this->db->where('id_post',$id);
            $this->db->where('post_type','services');
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
