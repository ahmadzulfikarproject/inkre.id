<?php
class Model_utama_clients extends CI_model
{

    function semua_clients($start, $limit)
    {
        return $this->db->query("SELECT * FROM clients ORDER BY id_clients DESC LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM clients ORDER BY id_clients DESC LIMIT $start,$limit");
    }
    function semua_clients_categories($start, $limit, $cat_id, $sort = 'DESC')
    {
        $this->db->order_by('id_clients', $sort);
        $query = $this->db->get_where('clients', array('id_categories' => $cat_id), $start, $limit);
        return $query;
        //return $this->db->query("SELECT * FROM clients where id_categories='$cat_id' LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM clients where id_categories='$cat_id' ORDER BY id_clients $sort LIMIT $start,$limit");

        //return $this->db->query("SELECT * FROM berita ORDER BY id_clients DESC LIMIT $start,$limit");
    }
    function semua_clients_categories_array($start, $limit, $cat_id, $sort = 'DESC')
    {
        // $ids = array('23', '24');
        if (!empty ($cat_id)) {
            # code...
            $this->db->where_in('id_categories', $cat_id);
        }
        $this->db->order_by('id_clients', $sort);
        $query = $this->db->get('clients', $start, $limit);
        return $query;
        //return $this->db->query("SELECT * FROM clients where id_categories='$cat_id' LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM clients where id_categories='$cat_id' ORDER BY id_clients $sort LIMIT $start,$limit");

        //return $this->db->query("SELECT * FROM berita ORDER BY id_clients DESC LIMIT $start,$limit");
    }

    function detail_clients_categories($id, $dari, $sampai)
    {
        return $this->db->query("SELECT * FROM clients where id_categories='" . $this->db->escape_str($id) . "' ORDER BY id_clients DESC LIMIT $dari,$sampai");
    }

    function hitungclientscategories($kat)
    {
        return $this->db->query("SELECT * FROM clients where id_categories='" . $this->db->escape_str($kat) . "'");
    }

    //fikar
    //clients
    function clients($start, $limit)
    {
        return $this->db->query("SELECT a.*, b.nama_lengkap FROM clients a JOIN users b ON a.username=b.username ORDER BY a.id_clients DESC LIMIT $start, $limit");
    }
    function hitungclients()
    {
        return $this->db->query("SELECT * FROM clients");
    }
    function clients_detail($id)
    {
        return $this->db->query("SELECT a.*, b.nama_lengkap FROM clients a JOIN users b ON a.username=b.username where a.slug='" . $this->db->escape_str($id) . "'");
    }

    //fikar end
    //toxi tag
    function hitung_clients_tags($post_type = 'clients', $tags_id)
    {

        //return $this->db->query("SELECT * FROM clients where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
        $hasil = $this->db->query('SELECT b.*
                    FROM tagmap bt, clients b, tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = ' . $tags_id . '
                    AND b.id_clients = bt.id_clients
                    GROUP BY b.id_clients');
        return $hasil;
    }
    function detail_clients_tags($post_type = 'clients', $tags_id, $dari, $sampai)
    {
        //return $this->db->query("SELECT * FROM clients where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_clients DESC LIMIT $dari,$sampai");
        $hasil = $this->db->query('SELECT b.*
                    FROM tagmap bt, clients b, tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = ' . $tags_id . '
                    AND b.id_clients = bt.id_clients
                    GROUP BY b.id_clients ORDER BY b.id_clients ASC'
                );
        return $hasil;
    }
    //list tags
    function feed_clients_tags($post_type = 'clients')
    {

        $hasil = $this->db->query('
            SELECT bt.tags_id, bt.post_type, t.* FROM tagmap bt, tags t
            WHERE bt.post_type="clients" AND bt.tags_id=t.tags_id

            ');
        return $hasil;
    }
    //toxi tag end

}
