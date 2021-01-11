<?php
class Model_slide extends CI_model
{
    var $table = 'slide';
    var $wm = false;
    var $new_slug = false;
    var $wide = 400;
    var $height = 200;
    function slide()
    {
        return $this->db->query("SELECT * FROM slide ORDER BY position ASC");
    }
    function slide_add()
    {
        $config['upload_path'] = '../asset/foto_slide/';
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
            'id' => 'id_slide',
        );
        $this->load->library('slug', $config);
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        //fikar z
        $datadb = array(
            'judul' => $this->db->escape_str($this->input->post('a')),
            'slug' => $this->slug->create_uri($this->input->post('a')),
            'isi_slide' => $this->input->post('b'),
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
            if (($datadb['gambar']) && (file_exists('../asset/foto_slide/' . $datadb['gambar']))) {
                thumb('../asset/foto_slide/' . $datadb['gambar'], $this->wide, $this->height, $this->wm);
            }
        }
    }
    function slide_edit($id)
    {
        return $this->db->query("SELECT * FROM slide where id_slide='$id'");
    }

    function slide_update()
    {
        $config['upload_path'] = '../asset/foto_slide/';
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
            'id' => 'id_slide',
        );
        $this->load->library('slug', $config);
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        //fikar z
        $page = $this->db->where('id_slide', $this->input->post('id'))->limit(1)->get($this->table)->row();
        if ($this->db->escape_str($this->input->post('a')) != $page->judul) {
            //$slugku = $page->slug;
            $this->new_slug = true;
        }
        $datadb = array(
            'judul' => $this->db->escape_str($this->input->post('a')),
            // 'slug' => $this->slug->create_uri($this->input->post('a')),
            'isi_slide' => $this->input->post('b'),
            // 'username' => Globals::authenticatedMemeberId()->username,
            'meta_title' => $this->input->post('meta_title'),
            'meta_keywords' => $this->input->post('meta_keywords'),
            'meta_description' => $this->input->post('meta_description'),
            // 'created_time' => date('Y-m-d H:i:s')
        );
        $this->hasil ? $datadb['gambar'] = $this->hasil['file_name'] : '';
        $this->new_slug ? $datadb['slug'] = $this->slug->create_uri($this->input->post('a')) : '';
        $this->db->where('id_slide', $this->input->post('id'));
        if ($this->db->update($this->table, $datadb)) {
            if ($this->hasil) {
                getnameimg('../asset/foto_slide/' . $page->gambar, 'foto_slide');
                if ($this->db->escape_str($this->input->post('watermark')) == 'on') {
                    $this->wm = true;
                }
                if (($datadb['gambar']) && (file_exists('../asset/foto_slide/' . $datadb['gambar']))) {
                    thumb('../asset/foto_slide/' . $datadb['gambar'], $this->wide, $this->height, $this->wm);
                }
            }
        }
    }
    function slide_delete($id)
    {
        //$data['rows'] = $this->model_slide->slide_edit($id)->row_array();
        $page = $this->db->where('id_slide', $id)->limit(1)->get('slide')->row();
        //print_r($page);
        getnameimg('../asset/foto_slide/' . $page->gambar, 'foto_slide');
        //unlink('asset/foto_slide/'.$page->gambar);
        return $this->db->query("DELETE FROM slide where id_slide='$id'");
    }
    public function reorder_slide($list)
    {
        print_r($list);
        $position = 1;

        $this->db->trans_start();
        foreach ($list as $id => $item) {
            $this->db->where('id_slide', $id)->set('position', $position)->update('slide');
            $position++;
            echo $id;
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
