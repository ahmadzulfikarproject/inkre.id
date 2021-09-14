<?php
class Model_utama_products extends CI_model{
    function products_detail($id){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM products a JOIN users b ON a.username=b.username where a.slug='".$this->db->escape_str($id)."'");
    }
    function products_update_count($id){
        return $this->db->query("UPDATE products SET products_views=products_views+1 where slug='".$this->db->escape_str($id)."'");
    }
    function semua_products_categories($start, $limit,$cat_id,$sort='DESC'){
        $this->db->order_by('id_products', $sort);
        $query = $this->db->get_where('products',array('id_categories' => $cat_id), $start, $limit);
        return $query;
        //return $this->db->query("SELECT * FROM products where id_categories='$cat_id' LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM products where id_categories='$cat_id' ORDER BY id_products $sort LIMIT $start,$limit");

        //return $this->db->query("SELECT * FROM berita ORDER BY id_products DESC LIMIT $start,$limit");
    }
    function get_hitung_products_tags($post_type='berita', $tags_id){

        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
        $hasil = $this->db->query('SELECT b.*
                    FROM products_tagmap bt, '.$post_type.' b, products_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_products
                    GROUP BY b.id_'.$post_type.' ORDER BY b.id_products DESC');
        return $hasil;
    }
    function get_detail_products_tags($post_type='berita',$tags_id,$dari,$sampai){
        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_products DESC LIMIT $dari,$sampai");
        $hasil = $this->db->query('SELECT b.*
                    FROM products_tagmap bt, '.$post_type.' b, products_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_products
                    GROUP BY b.id_'.$post_type.' ORDER BY b.id_products DESC');
        return $hasil;
    }
    function hitungproductscategories($kat){
        return $this->db->query("SELECT * FROM products where id_categories='".$this->db->escape_str($kat)."'");
    }

    function hitungproductstags($kat){
        return $this->db->query("SELECT * FROM products where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
    }
    function detail_products_categories($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM products where id_categories='".$this->db->escape_str($id)."' ORDER BY id_products DESC LIMIT $dari,$sampai");
    }
    function detail_products_tags($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM products where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_products DESC LIMIT $dari,$sampai");
    }
    function hitungproducts(){
        return $this->db->query("SELECT * FROM products");
    }
    function products($start, $limit){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM products a JOIN users b ON a.username=b.username ORDER BY a.id_products DESC LIMIT $start, $limit");
    }
    function getRows_products($id = ''){
        $this->db->select('*');
        $this->db->from('files');
        if($id){
            $this->db->where('id_post',$id);
            $this->db->where('post_type','products');
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
