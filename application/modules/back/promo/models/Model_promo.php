<?php
class Model_promo extends CI_model
{
    var $table = 'promo';
    var $wm = false;
    var $new_slug = false;
    var $wide = 400;
    var $height = 200;
    function promo()
    {
        return $this->db->query("SELECT * FROM promo ORDER BY position DESC");
    }
    function promo_add()
    {
        $config['upload_path'] = '../asset/foto_promo/';
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
            'id' => 'id_promo',
        );
        $this->load->library('slug', $config);
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        //fikar z
        $datadb = array(
            'judul' => $this->db->escape_str($this->input->post('a')),
            'slug' => $this->slug->create_uri($this->input->post('a')),
            'isi_promo' => $this->input->post('b'),
            'position' => $this->db->count_all($this->table) + 1,
            // 'username' => Globals::authenticatedMemeberId()->username,
            // 'meta_title' => $this->input->post('meta_title'),
            // 'meta_keywords' => $this->input->post('meta_keywords'),
            // 'meta_description' => $this->input->post('meta_description'),
            // 'created_time' => date('Y-m-d H:i:s')
        );
        $this->hasil ? $datadb['gambar'] = $this->hasil['file_name'] : '';
        // $datadb['id_categories'] = $this->db->escape_str($this->input->post('category'));
        if ($this->db->insert($this->table, $datadb)) {
            if ($this->db->escape_str($this->input->post('watermark')) == 'on') {
                $this->wm = true;
            }
            if (($datadb['gambar']) && (file_exists('../asset/foto_promo/' . $datadb['gambar']))) {
                thumb('../asset/foto_promo/' . $datadb['gambar'], $this->wide, $this->height, $this->wm);
            }
        }
    }
    function promo_edit($id)
    {
        return $this->db->query("SELECT * FROM promo where id_promo='$id'");
    }

    function promo_update()
    {
        $config['upload_path'] = '../asset/foto_promo/';
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
            'id' => 'id_promo',
        );
        $this->load->library('slug', $config);
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        //fikar z
        $page = $this->db->where('id_promo', $this->input->post('id'))->limit(1)->get($this->table)->row();
        if ($this->db->escape_str($this->input->post('a')) != $page->judul) {
            //$slugku = $page->slug;
            $this->new_slug = true;
        }
        $datadb = array(
            'judul' => $this->db->escape_str($this->input->post('a')),
            // 'slug' => $this->slug->create_uri($this->input->post('a')),
            'isi_promo' => $this->input->post('b'),
            // 'username' => Globals::authenticatedMemeberId()->username,
            'meta_title' => $this->input->post('meta_title'),
            'meta_keywords' => $this->input->post('meta_keywords'),
            'meta_description' => $this->input->post('meta_description'),
            // 'created_time' => date('Y-m-d H:i:s')
        );
        $this->hasil ? $datadb['gambar'] = $this->hasil['file_name'] : '';
        $this->new_slug ? $datadb['slug'] = $this->slug->create_uri($this->input->post('a')) : '';
        $this->db->where('id_promo', $this->input->post('id'));
        if ($this->db->update($this->table, $datadb)) {
            if ($this->hasil) {
                getnameimg('../asset/foto_promo/' . $page->gambar, 'foto_promo');
                if ($this->db->escape_str($this->input->post('watermark')) == 'on') {
                    $this->wm = true;
                }
                if (($datadb['gambar']) && (file_exists('../asset/foto_promo/' . $datadb['gambar']))) {
                    thumb('../asset/foto_promo/' . $datadb['gambar'], $this->wide, $this->height, $this->wm);
                }
            }
        }
    }
    function promo_delete($id)
    {
        //$data['rows'] = $this->model_promo->promo_edit($id)->row_array();
        $page = $this->db->where('id_promo', $id)->limit(1)->get('promo')->row();
        //print_r($page);
        getnameimg('../asset/foto_promo/' . $page->gambar, 'foto_promo');
        //unlink('asset/foto_promo/'.$page->gambar);
        return $this->db->query("DELETE FROM promo where id_promo='$id'");
    }
    public function reorder_promo($list)
    {
        // print_r(krsort($list));
        $position = $this->db->count_all($this->table);
        $this->db->trans_start();
        foreach ($list as $id => $item) {
            $this->db->where('id_promo', $id)->set('position', $position)->update('promo');
            $position--;
            echo $id . '-';
            echo $item;
        }
        $this->db->trans_complete();

        return $this->db->trans_status();
        $data['error'] = $this->db->trans_status();
        $data['hasil'] = $list;
        //$data['datafile'] = $media['file_ext'];
        //$data['hasilcsv'] = $file_data;
        echo json_encode($data);
    }
}
