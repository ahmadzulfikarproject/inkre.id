<?php
class Model_utama_gallery extends CI_model
{

    function semua_gallery($start, $limit)
    {
        return $this->db->query("SELECT * FROM gallery ORDER BY id_gallery DESC LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM gallery ORDER BY id_gallery DESC LIMIT $start,$limit");
    }
    function semua_gallery_categories($start, $limit, $cat_id, $sort = 'DESC')
    {
        $this->db->order_by('id_gallery', $sort);
        $query = $this->db->get_where('gallery', array('id_categories' => $cat_id), $start, $limit);
        return $query;
        //return $this->db->query("SELECT * FROM gallery where id_categories='$cat_id' LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM gallery where id_categories='$cat_id' ORDER BY id_gallery $sort LIMIT $start,$limit");

        //return $this->db->query("SELECT * FROM berita ORDER BY id_gallery DESC LIMIT $start,$limit");
    }
    function semua_gallery_categories_array($start, $limit, $cat_id, $sort = 'DESC')
    {
        // $ids = array('23', '24');
        if (!empty ($cat_id)) {
            # code...
            $this->db->where_in('id_categories', $cat_id);
        }
        $this->db->order_by('id_gallery', $sort);
        $query = $this->db->get('gallery', $start, $limit);
        return $query;
        //return $this->db->query("SELECT * FROM gallery where id_categories='$cat_id' LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM gallery where id_categories='$cat_id' ORDER BY id_gallery $sort LIMIT $start,$limit");

        //return $this->db->query("SELECT * FROM berita ORDER BY id_gallery DESC LIMIT $start,$limit");
    }

    function detail_gallery_categories($id, $dari, $sampai)
    {
        return $this->db->query("SELECT * FROM gallery where id_categories='" . $this->db->escape_str($id) . "' ORDER BY id_gallery DESC LIMIT $dari,$sampai");
    }

    function hitunggallerycategories($kat)
    {
        return $this->db->query("SELECT * FROM gallery where id_categories='" . $this->db->escape_str($kat) . "'");
    }

    //fikar
    //gallery
    function gallery($start, $limit)
    {
        return $this->db->query("SELECT a.*, b.nama_lengkap FROM gallery a JOIN users b ON a.username=b.username ORDER BY a.id_gallery DESC LIMIT $start, $limit");
    }
    function hitunggallery()
    {
        return $this->db->query("SELECT * FROM gallery");
    }
    function gallery_detail($id)
    {
        return $this->db->query("SELECT a.*, b.nama_lengkap FROM gallery a JOIN users b ON a.username=b.username where a.slug='" . $this->db->escape_str($id) . "'");
    }

    //fikar end
    //toxi tag
    function hitung_gallery_tags($post_type = 'gallery', $tags_id)
    {

        //return $this->db->query("SELECT * FROM gallery where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
        $hasil = $this->db->query('SELECT b.*
                    FROM tagmap bt, gallery b, tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = ' . $tags_id . '
                    AND b.id_gallery = bt.id_gallery
                    GROUP BY b.id_gallery');
        return $hasil;
    }
    function detail_gallery_tags($post_type = 'gallery', $tags_id, $dari, $sampai)
    {
        //return $this->db->query("SELECT * FROM gallery where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_gallery DESC LIMIT $dari,$sampai");
        $hasil = $this->db->query('SELECT b.*
                    FROM tagmap bt, gallery b, tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = ' . $tags_id . '
                    AND b.id_gallery = bt.id_gallery
                    GROUP BY b.id_gallery ORDER BY b.id_gallery ASC'
                );
        return $hasil;
    }
    //list tags
    function feed_gallery_tags($post_type = 'gallery')
    {

        $hasil = $this->db->query('
            SELECT bt.tags_id, bt.post_type, t.* FROM tagmap bt, tags t
            WHERE bt.post_type="gallery" AND bt.tags_id=t.tags_id

            ');
        return $hasil;
    }
    //toxi tag end

}
