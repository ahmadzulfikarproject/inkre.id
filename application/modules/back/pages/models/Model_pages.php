<?php
class Model_pages extends CI_model
{
    function pages()
    {
        return $this->db->query("SELECT * FROM pages ORDER BY id_pages DESC");
    }

    function pages_tambah()
    {
        $config['upload_path'] = '../asset/foto_statis/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg';
        $config['max_size'] = '30000'; // kb
        $new_name = substr(md5(uniqid(mt_rand())), 0, 10) . '_' . time() . '_' . $_FILES["c"]['name'];
        $config['remove_spaces'] = true;
        $config['file_name'] = preg_replace("/[^a-zA-Z0-9.]/", "_", $new_name);
        $this->load->library('upload', $config);
        $this->upload->do_upload('c');
        $hasil = $this->upload->data();
        //fikar
        $config = array(
            'field' => 'slug',
            'title' => 'judul',
            'table' => 'pages',
            'id' => 'id_pages',
        );
        $this->load->library('slug', $config);
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        //fikar z
        if ($hasil['file_name'] == '') {
            $datadb = array(
                'judul' => $this->db->escape_str($this->input->post('a')),
                'slug' => $this->slug->create_uri($this->input->post('a')),
                'isi_pages' => $this->input->post('b'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'tgl_posting' => date('Y-m-d')
            );
        } else {
            $datadb = array(
                'judul' => $this->db->escape_str($this->input->post('a')),
                'slug' => $this->slug->create_uri($this->input->post('a')),
                'meta_title' => $this->input->post('meta_title'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'isi_pages' => $this->input->post('b'),
                'tgl_posting' => date('Y-m-d'),
                'gambar' => $hasil['file_name']
            );
        }

        if ($this->db->insert('pages', $datadb)) {
            if ($this->db->escape_str($this->input->post('watermark')) == 'on') {
                $wm = true;
            } else {
                $wm = false;
            }
            // thumb('../asset/foto_projects/'.$hasil['file_name'],'400','200',$wm);
            if (file_exists('../asset/foto_statis/' . $hasil['file_name'])) {
                thumb('../asset/foto_statis/' . $hasil['file_name'], '400', '200', $wm);
            }
        }
    }

    function pages_edit($id)
    {
        return $this->db->query("SELECT * FROM pages where id_pages='$id'");
    }

    function pages_update()
    {
        $config['upload_path'] = '../asset/foto_statis/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|jpeg';
        $config['max_size'] = '30000'; // kb
        //$nmfile = "file_".time();
        //$config['file_name'] = $nmfile; //nama yang terupload nantinya
        //$filename = md5(uniqid(mt_rand())).$this->file_ext;
        $new_name = substr(md5(uniqid(mt_rand())), 0, 10) . '_' . time() . '_' . $_FILES["c"]['name'];
        $config['remove_spaces'] = true;
        $config['file_name'] = preg_replace("/[^a-zA-Z0-9.]/", "_", $new_name);
        $this->load->library('upload', $config);

        $this->upload->do_upload('c');
        $hasil = $this->upload->data();
        //fikar
        $config = array(
            'field' => 'slug',
            'title' => 'judul',
            'table' => 'pages',
            'id' => 'id_pages',
        );
        $this->load->library('slug', $config);
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        //fikar z
        $page = $this->db->where('id_pages', $this->input->post('id'))->limit(1)->get('pages')->row();
        if ($this->db->escape_str($this->input->post('a')) != $page->judul) {
            //$slugku = $page->slug;
            $new_slug = true;
        } else {
            //$slugku = $this->slug->create_uri($this->input->post('a'));
            $new_slug = false;
        }
        if ($_FILES["c"]['name'] == '') {
            $imgupdate = false;
            $datadb = array(
                'judul' => $this->db->escape_str($this->input->post('a')),
                //'slug'=> $this->slug->create_uri($this->input->post('a')),
                //'slug'=> $slugku,
                'isi_pages' => $this->input->post('b'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'tgl_posting' => date('Y-m-d')
            );
        } else {
            $imgupdate = true;
            $datadb = array(
                'judul' => $this->db->escape_str($this->input->post('a')),
                //'slug'=> $this->slug->create_uri($this->input->post('a')),
                //'slug'=> $slugku,
                'isi_pages' => $this->input->post('b'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'tgl_posting' => date('Y-m-d'),
                'gambar' => $hasil['file_name']
            );
            //$page = $this->db->where('id_pages', $this->input->post('id'))->limit(1)->get('pages')->row();
            //unlink('../asset/foto_statis/'.$page->gambar);
            getnameimg('../asset/foto_statis/' . $page->gambar, 'foto_statis');
        }
        if ($new_slug) {
            $datadb['slug'] = $this->slug->create_uri($this->input->post('a'));
        }

        $this->db->where('id_pages', $this->input->post('id'));
        if ($this->db->update('pages', $datadb)) {
            if ($imgupdate == true) {
                if ($this->db->escape_str($this->input->post('watermark')) == 'on') {
                    $wm = true;
                } else {
                    $wm = false;
                }
                // thumb('../asset/foto_projects/'.$hasil['file_name'],'400','200',$wm);
                if (file_exists('../asset/foto_statis/' . $hasil['file_name'])) {
                    thumb('../asset/foto_statis/' . $hasil['file_name'], '400', '200', $wm);
                }
            }
        }
    }

    function pages_delete($id)
    {
        //$data['rows'] = $this->model_pages->pages_edit($id)->row_array();
        $page = $this->db->where('id_pages', $id)->limit(1)->get('pages')->row();
        //print_r($page);
        getnameimg('../asset/foto_statis/' . $page->gambar, 'foto_statis');
        //unlink('../asset/foto_statis/'.$page->gambar);
        return $this->db->query("DELETE FROM pages where id_pages='$id'");
    }
    function list_pages_rss()
    {
        return $this->db->query("SELECT * FROM pages ORDER BY id_pages DESC LIMIT 10");
    }
}
