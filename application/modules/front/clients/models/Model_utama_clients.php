<?php
class Model_utama_clients extends CI_model{
    function clients_detail($id){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM clients a JOIN users b ON a.username=b.username where a.slug='".$this->db->escape_str($id)."'");
    }
    function clients_update_count($id){
        return $this->db->query("UPDATE clients SET clients_views=clients_views+1 where slug='".$this->db->escape_str($id)."'");
    }
    function semua_clients_categories($start, $limit,$cat_id,$sort='DESC'){
        $this->db->order_by('id_clients', $sort);
        $query = $this->db->get_where('clients',array('id_categories' => $cat_id), $start, $limit);
        return $query;
        //return $this->db->query("SELECT * FROM clients where id_categories='$cat_id' LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM clients where id_categories='$cat_id' ORDER BY id_clients $sort LIMIT $start,$limit");

        //return $this->db->query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT $start,$limit");
    }
    function get_hitung_clients_tags($post_type='berita', $tags_id){

        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
        $hasil = $this->db->query('SELECT b.*
                    FROM clients_tagmap bt, '.$post_type.' b, clients_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_clients
                    GROUP BY b.id_'.$post_type.'');
        return $hasil;
    }
    function get_detail_clients_tags($post_type='berita',$tags_id,$dari,$sampai){
        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_berita DESC LIMIT $dari,$sampai");
        $hasil = $this->db->query('SELECT b.*
                    FROM clients_tagmap bt, '.$post_type.' b, clients_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_clients
                    GROUP BY b.id_'.$post_type.'');
        return $hasil;
    }
    function hitungclientscategories($kat){
        return $this->db->query("SELECT * FROM clients where id_categories='".$this->db->escape_str($kat)."'");
    }

    function hitungclientstags($kat){
        return $this->db->query("SELECT * FROM clients where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
    }
    function detail_clients_categories($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM clients where id_categories='".$this->db->escape_str($id)."' ORDER BY id_clients DESC LIMIT $dari,$sampai");
    }
    function detail_clients_tags($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM clients where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_clients DESC LIMIT $dari,$sampai");
    }
    function hitungclients(){
        return $this->db->query("SELECT * FROM clients");
    }
    function clients($start, $limit){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM clients a JOIN users b ON a.username=b.username ORDER BY a.id_clients DESC LIMIT $start, $limit");
    }
}
