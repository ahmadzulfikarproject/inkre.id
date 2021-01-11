<?php
class Model_utama_services extends CI_model
{

    function semua_services($start, $limit)
    {
        return $this->db->query("SELECT * FROM services ORDER BY id_services DESC LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM services ORDER BY id_services DESC LIMIT $start,$limit");
    }
    function semua_services_categories($start, $limit, $cat_id, $sort = 'DESC')
    {
        $this->db->order_by('id_services', $sort);
        $query = $this->db->get_where('services', array('id_categories' => $cat_id), $start, $limit);
        return $query;
        //return $this->db->query("SELECT * FROM services where id_categories='$cat_id' LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM services where id_categories='$cat_id' ORDER BY id_services $sort LIMIT $start,$limit");

        //return $this->db->query("SELECT * FROM berita ORDER BY id_services DESC LIMIT $start,$limit");
    }
    function semua_services_categories_array($start, $limit, $cat_id, $sort = 'DESC')
    {
        // $ids = array('23', '24');
        if (!empty ($cat_id)) {
            # code...
            $this->db->where_in('id_categories', $cat_id);
        }
        $this->db->order_by('id_services', $sort);
        $query = $this->db->get('services', $start, $limit);
        return $query;
        //return $this->db->query("SELECT * FROM services where id_categories='$cat_id' LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM services where id_categories='$cat_id' ORDER BY id_services $sort LIMIT $start,$limit");

        //return $this->db->query("SELECT * FROM berita ORDER BY id_services DESC LIMIT $start,$limit");
    }

    function detail_services_categories($id, $dari, $sampai)
    {
        return $this->db->query("SELECT * FROM services where id_categories='" . $this->db->escape_str($id) . "' ORDER BY id_services DESC LIMIT $dari,$sampai");
    }

    function hitungservicescategories($kat)
    {
        return $this->db->query("SELECT * FROM services where id_categories='" . $this->db->escape_str($kat) . "'");
    }

    //fikar
    //services
    function services($start, $limit)
    {
        return $this->db->query("SELECT a.*, b.nama_lengkap FROM services a JOIN users b ON a.username=b.username ORDER BY a.id_services DESC LIMIT $start, $limit");
    }
    function hitungservices()
    {
        return $this->db->query("SELECT * FROM services");
    }
    function services_detail($id)
    {
        return $this->db->query("SELECT a.*, b.nama_lengkap FROM services a JOIN users b ON a.username=b.username where a.slug='" . $this->db->escape_str($id) . "'");
    }

    //fikar end
    //toxi tag
    function hitung_services_tags($post_type = 'services', $tags_id)
    {

        //return $this->db->query("SELECT * FROM services where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
        $hasil = $this->db->query('SELECT b.*
                    FROM tagmap bt, services b, tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = ' . $tags_id . '
                    AND b.id_services = bt.id_services
                    GROUP BY b.id_services');
        return $hasil;
    }
    function detail_services_tags($post_type = 'services', $tags_id, $dari, $sampai)
    {
        //return $this->db->query("SELECT * FROM services where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_services DESC LIMIT $dari,$sampai");
        $hasil = $this->db->query('SELECT b.*
                    FROM tagmap bt, services b, tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = ' . $tags_id . '
                    AND b.id_services = bt.id_services
                    GROUP BY b.id_services ORDER BY b.id_services ASC'
                );
        return $hasil;
    }
    //list tags
    function feed_services_tags($post_type = 'services')
    {

        $hasil = $this->db->query('
            SELECT bt.tags_id, bt.post_type, t.* FROM tagmap bt, tags t
            WHERE bt.post_type="services" AND bt.tags_id=t.tags_id

            ');
        return $hasil;
    }
    //toxi tag end

}
