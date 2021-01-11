<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita_model extends CI_Model
{

    var $table = 'berita';
    var $column_order = array(null, 'judul', 'id_categories'); //set column field database for datatable orderable
    var $column_search = array('judul', 'id_categories'); //set column field database for datatable searchable 
    var $order = array('id_berita' => 'desc'); // default order 
    var $hasil = array();
    var $wm = false;
    var $new_slug = false;
    var $wide = 400;
    var $height = 200;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {

        //add custom filter here
        // $this->db->select('berita.*, categories_lists.slug AS cat_slug,categories_lists.id');
        $this->db->select('berita.*, categories_lists.slug AS cat_slug,categories_lists.id,categories_lists.name AS cat_name');
        if ($this->input->post('category')) {
            $this->db->where('id_categories', $this->input->post('category'));
        }
        if ($this->input->post('judul')) {
            $this->db->like('judul', $this->input->post('judul'));
        }
        if ($this->input->post('date')) {
            $this->db->like('tanggal', $this->input->post('date'));
        }
        $this->db->join('categories_lists', 'categories_lists.id = ' . $this->table . '.id_categories', 'Left');
        $this->db->from($this->table);
        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        // $this->db->query('SELECT name, title, email FROM my_table');

        $this->_get_datatables_query();
        if ($_POST['length'] != -1)

            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // public function get_list_countries()
    // {
    //     $this->db->select('country');
    //     $this->db->from($this->table);
    //     $this->db->order_by('country','asc');
    //     $query = $this->db->get();
    //     $result = $query->result();

    //     $countries = array();
    //     foreach ($result as $row) 
    //     {
    //         $countries[] = $row->country;
    //     }
    //     return $countries;
    // }
    //categories
    function get_list_categories()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('categories_lists', 'categories_lists.id = ' . $this->table . '.id_categories');
        $this->db->order_by('id_categories', 'asc');
        $query = $this->db->get();
        $result = $query->result();

        $categories = array();
        foreach ($result as $row) {
            // $categories[] = $row->id_categories;
            $categories[] = array("cat" => $row->id_categories, "name" => $row->name);
            // $categories[1] = $row->name;
        }
        return $categories;
        // return $this->db->query("SELECT * FROM categories_lists where group_id=9 ORDER BY id DESC");
    }
    function get_all_categories($id = '', $group_id = '9')
    {
        $this->db->select('*');
        $this->db->from('categories_lists');
        $this->db->where('group_id', $group_id);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        $result = $query->result();

        $categories = array();
        foreach ($result as $row) {
            // $categories[] = $row->id_categories;
            if ($id == $row->id) {
                $categories[] = array("cat" => $row->id, "name" => $row->name, "selected" => "selected");
            } else {
                $categories[] = array("cat" => $row->id, "name" => $row->name);
            }
            // $categories[1] = $row->name;
        }
        return $categories;
        // return $this->db->query("SELECT * FROM categories_lists where group_id=9 ORDER BY id DESC");
    }
    //custom model
    function news_add()
    {
        $config['upload_path'] = '../asset/foto_berita/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg';
        $config['max_size'] = '30000'; // kb
        $new_name = substr(md5(uniqid(mt_rand())), 0, 10) . '_' . time() . '_' . $_FILES["c"]['name'];
        $config['remove_spaces'] = true;
        $config['file_name'] = preg_replace("/[^a-zA-Z0-9.]/", "_", $new_name);
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('c')) {
            $this->hasil = $this->upload->data();
        }
        //fikar
        $config = array(
            'field' => 'slug',
            'title' => 'judul',
            'table' => $this->table,
            'id' => 'id_berita',
        );
        $this->load->library('slug', $config);
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        //fikar z
        $datadb = array(
            'judul' => $this->db->escape_str($this->input->post('a')),
            'slug' => $this->slug->create_uri($this->input->post('a')),
            'isi_berita' => $this->input->post('b'),
            'username' => Globals::authenticatedMemeberId()->username,
            'meta_title' => $this->input->post('meta_title'),
            'meta_keywords' => $this->input->post('meta_keywords'),
            'meta_description' => $this->input->post('meta_description'),
            'tanggal' => date('Y-m-d H:i:s')
        );
        $this->hasil ? $datadb['gambar'] = $this->hasil['file_name'] : '';
        $datadb['id_categories'] = $this->db->escape_str($this->input->post('category'));
        if ($this->db->insert($this->table, $datadb)) {
            if ($this->db->escape_str($this->input->post('watermark')) == 'on') {
                $this->wm = true;
            }
            if (($datadb['gambar']) && (file_exists('../asset/foto_berita/' . $datadb['gambar']))) {
                thumb('../asset/foto_berita/' . $datadb['gambar'], $this->wide, $this->height, $this->wm);
            }
        }
    }
    function news_edit($id)
    {
        return $this->db->query("SELECT * FROM $this->table where id_berita='$id'");
    }
    function news_update()
    {
        $config['upload_path'] = '../asset/foto_berita/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg';
        $config['max_size'] = '30000'; // kb
        //$nmfile = "file_".time();
        //$config['file_name'] = $nmfile; //nama yang terupload nantinya
        //$filename = md5(uniqid(mt_rand())).$this->file_ext;
        $new_name = substr(md5(uniqid(mt_rand())), 0, 10) . '_' . time() . '_' . $_FILES["c"]['name'];
        $config['remove_spaces'] = true;
        $config['file_name'] = preg_replace("/[^a-zA-Z0-9.]/", "_", $new_name);
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('c')) {
            $this->hasil = $this->upload->data();
        }
        //fikar
        $config = array(
            'field' => 'slug',
            'title' => 'judul',
            'table' => $this->table,
            'id' => 'id_berita',
        );
        $this->load->library('slug', $config);
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        //fikar z
        $page = $this->db->where('id_berita', $this->input->post('id'))->limit(1)->get($this->table)->row();
        if ($this->db->escape_str($this->input->post('a')) != $page->judul) {
            //$slugku = $page->slug;
            $this->new_slug = true;
        }
        // if ($_FILES["c"]['name'] == '') {
        //     $imgupdate = false;
        //     $datadb = array(
        //         'judul' => $this->db->escape_str($this->input->post('a')),
        //         //'slug'=> $this->slug->create_uri($this->input->post('a')),
        //         //'slug'=> $slugku,
        //         'isi_berita' => $this->input->post('b'),
        //         'meta_title' => $this->input->post('meta_title'),
        //         'meta_keywords' => $this->input->post('meta_keywords'),
        //         'meta_description' => $this->input->post('meta_description'),
        //         'tanggal' => date('Y-m-d H:i:s')
        //     );
        // } else {
        //     $imgupdate = true;
        //     $datadb = array(
        //         'judul' => $this->db->escape_str($this->input->post('a')),
        //         //'slug'=> $this->slug->create_uri($this->input->post('a')),
        //         //'slug'=> $slugku,
        //         'isi_berita' => $this->input->post('b'),
        //         'meta_title' => $this->input->post('meta_title'),
        //         'meta_keywords' => $this->input->post('meta_keywords'),
        //         'meta_description' => $this->input->post('meta_description'),
        //         'tanggal' => date('Y-m-d H:i:s'),
        //         'gambar' => $hasil['file_name']
        //     );
        //     //$page = $this->db->where('id_berita', $this->input->post('id'))->limit(1)->get($this->table)->row();
        //     //unlink('../asset/foto_berita/'.$page->gambar);
        //     getnameimg('../asset/foto_berita/' . $page->gambar, 'foto_berita');
        // }
        $datadb = array(
            'judul' => $this->db->escape_str($this->input->post('a')),
            // 'slug' => $this->slug->create_uri($this->input->post('a')),
            'isi_berita' => $this->input->post('b'),
            'username' => Globals::authenticatedMemeberId()->username,
            'meta_title' => $this->input->post('meta_title'),
            'meta_keywords' => $this->input->post('meta_keywords'),
            'meta_description' => $this->input->post('meta_description'),
            'tanggal' => date('Y-m-d H:i:s')
        );
        $this->hasil ? $datadb['gambar'] = $this->hasil['file_name'] : '';
        $this->new_slug ? $datadb['slug'] = $this->slug->create_uri($this->input->post('a')) : '';
        $datadb['id_categories'] = $this->db->escape_str($this->input->post('category'));
        $this->db->where('id_berita', $this->input->post('id'));
        if ($this->db->update($this->table, $datadb)) {
            if ($this->hasil) {
                getnameimg('../asset/foto_berita/' . $page->gambar, 'foto_berita');
                if ($this->db->escape_str($this->input->post('watermark')) == 'on') {
                    $this->wm = true;
                }
                if (($datadb['gambar']) && (file_exists('../asset/foto_berita/' . $datadb['gambar']))) {
                    thumb('../asset/foto_berita/' . $datadb['gambar'], $this->wide, $this->height, $this->wm);
                }
            }
        }
    }
    function news_delete($id)
    {
        //$data['rows'] = $this->berita->news_edit($id)->row_array();
        $news = $this->db->where('id_berita', $id)->limit(1)->get($this->table)->row();
        //print_r($news);
        getnameimg('../asset/foto_berita/' . $news->gambar, 'foto_berita');
        //unlink('../asset/foto_berita/'.$news->gambar);
        return $this->db->query("DELETE FROM $this->table where id_berita='$id'");
    }
    //toxi tag
    function tags_news($post_id)
    {
        //return $this->db->query("SELECT * FROM tag ORDER BY id_tag DESC");
        //$hasil = $this->db->query("SELECT t.slug FROM tagmap bt, berita b, tags t WHERE bt.tags_id = t.tags_id AND b.id_berita = '$post_id' GROUP BY t.tags_id");
        //$tagsdata = implode(',',$hasil);
        $hasil = $this->db->query("SELECT t.slug
                                    FROM berita_tagmap bt, berita_tags t, berita b
                                    WHERE bt.id_berita = '$post_id'
                                    AND t.tags_id = bt.tags_id
                                    GROUP BY t.tags_id");
        $tags_data = array();
        foreach ($hasil->result_array() as $key => $value) {
            $tags_data[] = $value['slug'];
            # code...
        }

        $tags_value = implode(',', $tags_data);
        return $tags_value;
    }

    function get_berita_id($slug)
    {
        return $this->db->query("SELECT * FROM berita where slug='$slug'")->result_array();
    }
    //toxi tag end
    function reset_db_berita()
    {
        $this->db->truncate('berita');
        $this->db->truncate('berita_tagmap');
        $this->db->truncate('berita_tags');

        $tables = array('categories_lists');
        $this->db->where('group_id', '9');
        $this->db->delete($tables);
        //$this->db->query("TRUNCATE TABLE berita");
        //$this->db->query("TRUNCATE TABLE berita_tagmap");
        //$this->db->query("TRUNCATE TABLE berita_tags");
        foreach (glob('../asset/foto_berita/*') as $rowimg) {
            if (file_exists($rowimg)) {
                //if ($rowimg != $src ) {
                unlink($rowimg);
                //}

            }
        }
    }
}
