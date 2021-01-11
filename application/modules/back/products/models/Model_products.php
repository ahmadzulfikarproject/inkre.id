<?php
class Model_products extends CI_model
{
    function getproducts($params = array())
    {
        $this->db->select('*');
        $this->db->from('products');
        //filter data by searched keywords
        if (!empty($params['search']['keywords'])) {
            $this->db->like('judul', $params['search']['keywords']);
        }
        if (!empty($params['search']['kategori'])) {
            $this->db->like('id_categories', $params['search']['kategori']);
        }
        //sort data by ascending or desceding order
        if (!empty($params['search']['sortBy'])) {
            //$this->db->order_by('judul',$params['search']['sortBy']);
            $sortByparams = $params['search']['sortBy'];
            switch ($sortByparams) {
                    // pilih type order
                case 'titleasc':
                    //echo 'titleasc';
                    $name = 'judul';
                    $sortBy = 'asc';
                    break;
                case 'titledesc':
                    //echo 'titledesc'; 
                    $name = 'judul';
                    $sortBy = 'desc';
                    break;
                case 'dateasc':
                    //echo 'dateasc'; 
                    $name = 'id_products';
                    $sortBy = 'asc';
                    break;
                case 'datedesc':
                    //echo 'datedesc'; 
                    $name = 'id_products';
                    $sortBy = 'desc';
                    break;
                default:
                    //echo 'default';
                    $name = 'id_products';
                    $sortBy = 'desc';
                    break;
            }
            $this->db->order_by($name, $sortBy);
        } else {
            $this->db->order_by('id_products', 'desc');
        }
        //set start and limit
        if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0) ? $query->result_array() : array();
    }
    function upload_data()
    {
        if (!is_level('admin')) {
            die();
        }
        $this->reset_db_products();
        //$this->db->query("TRUNCATE TABLE products");
        //$this->db->query("TRUNCATE TABLE products_tagmap");
        //$this->db->query("TRUNCATE TABLE products_tags");
        $config['upload_path'] = '../asset/upload/';
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = '3000'; // kb
        //$new_name = $_FILES["filexl"]['name'];
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $this->load->library('upload', $config);
        //$this->upload->do_upload('c');
        //$hasil=$this->upload->data();
        //fikar
        $config = array(
            'field' => 'slug',
            'title' => 'judul',
            'table' => 'products',
            'id' => 'id_products',
        );
        $this->load->library('slug', $config);
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        $this->upload->do_upload('file');

        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            //echo $error['error'];
            $data['error'] = TRUE;
            echo json_encode($data);
        } else {
            $media = $this->upload->data();
            $inputFileName = '../asset/upload/' . $media['file_name'];

            if ($media['file_ext'] == '.csv') {
                # code...
                $file_data = $this->csvimport->get_array($inputFileName);

                foreach ($file_data as $row) {
                    $ssrc = $row["Image"];
                    if ($ssrc != '') {
                        # code...

                        $cutstring = "C:\\xampp\htdocs\pt-cmp.comr1\media\k2\items\src\\";

                        if (strpos($ssrc, $cutstring) !== false) {
                            // car found
                            $ssrcimg = str_replace($cutstring, '', $ssrc);
                        } else {
                            $ssrcimg = $ssrc;
                        }
                        $realpath = "../media/k2/items/src/" . $ssrcimg;
                        $targetpath = "../asset/foto_products/" . $ssrcimg;
                        if (!is_dir('../asset/foto_products/')) {
                            mkdir('../asset/foto_products/', 0777, TRUE);
                        }
                        //upload gambar
                        /*
                        unset($config);
                        //icon
                        $config['upload_path'] = '../asset/foto_products/';
                        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
                        $config['max_size'] = '20000'; // kb
                        //$new_name = substr(md5(uniqid(mt_rand())),0,10).'_'.time().'_'.$_FILES["icon"]['name'];
                        //$config['file_name'] = $new_name;
                        //$this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        $this->upload->do_upload($realpath);
                        $gambardata=$this->upload->data();
                        */
                        //move_uploaded_file($realpath, $targetpath);
                        if (file_exists($realpath)) {
                            copy($realpath, $targetpath);
                        }
                    }
                    $data = array(
                        "username"      => 'admin',
                        "judul"         => $row["Title"],
                        "slug"          => $row["Alias"],
                        "isi_products"    => $row["Introtext"] . $row["Fulltext"],
                        "gambar"        => $this->db->escape_str($ssrcimg), //$rowData[0][20],
                        "products_views"  => $row["Hits"],
                        "meta_description"  => $row["Meta Description"],
                        "meta_keywords"  => $row["Meta Keywords"],
                        //"id_categories"   => $row["Category Name"],
                        "tgl_posting"          => $row["Created"],
                        //'judul' => $row["Title"],
                        //'first_name' => $row["First Name"],
                        //      'last_name'  => $row["Last Name"],
                        //     'phone'   => $row["Phone"],
                        //     'email'   => $row["Email"]
                    );

                    //$this->csv_import_model->insert($data);
                    if ($this->db->insert("products", $data)) {
                        # code...
                        $data['error'] = FALSE;
                        $slugproducts = $row["Alias"]; //$this->slug->create_uri($this->input->post('judul'));
                        //toxy categories
                        //$this->load->model('Tags_model','tags');
                        $datpost = $this->get_products_id($slugproducts);
                        $idpost = $datpost[0]['id_products'];
                        $tags = $row["Tags"]; //$this->db->escape_str($this->input->post('tagshasil'));
                        if ($tags != '') {
                            $this->model_products_tags->insert_products_tagsdb($tags);
                            $this->model_products_tags->insert_products_tagsmap($tags, $idpost, 'products');
                        }
                        $Category = $row["Category Name"];
                        if ($Category != '') {
                            $this->model_products_categories->insert_products_categoriesdb($Category);
                            //$this->model_products_categories->insert_products_categoriesmap($Category,$idpost,'products'); //multi cat
                            $this->model_products_categories->insert_products_categoriesid($Category, $idpost, 'products'); //single cat
                        }
                        //toxy categories
                        //$this->load->model('Categories_model','categories');
                        //$datpost = $this->get_products_id($slugproducts);
                        //$idpost = $datpost[0]['id_products'];
                        //$cats = $rowData[0][6];//$this->db->escape_str($this->input->post('tagshasil'));
                        //$this->categories_model->insert_categoriesdb($cats);
                        //$this->categories_model->insert_categoriesmap($cats,$idpost,'products');
                    }
                }


                $data['error'] = TRUE;
                $data['datafile'] = $media['file_ext'];
                //$data['hasilcsv'] = $file_data;

                echo json_encode($data);
            } else {
                try {
                    $inputFileType = IOFactory::identify($inputFileName);
                    $objReader = IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                } catch (Exception $e) {
                    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                }
                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                for ($row = 2; $row <= $highestRow; $row++) {
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                    $rowData[0] = array_combine(range(1, count($rowData[0])), array_values($rowData[0]));

                    //$content  = $rowData[0][3].'<p><!-- pagebreak --></p>'.$rowData[0][4];
                    $content  = $rowData[0][4];
                    if ($rowData[0][5] != '') {
                        $content  .= '<p><!-- pagebreak --></p>';
                        $content  .= $rowData[0][5];
                    };

                    $ssrc = $rowData[0][20];
                    if ($ssrc != '') {
                        # code...

                        $cutstring = "C:\\xampp\htdocs\pt-cmp.comr1\media\k2\items\src\\";

                        if (strpos($ssrc, $cutstring) !== false) {
                            // car found
                            $ssrcimg = str_replace($cutstring, '', $ssrc);
                        } else {
                            $ssrcimg = $ssrc;
                        }
                        $realpath = "../media/k2/items/src/" . $ssrcimg;
                        $targetpath = "../asset/foto_products/" . $ssrcimg;
                        if (!is_dir('../asset/foto_products/')) {
                            mkdir('../asset/foto_products/', 0777, TRUE);
                        }
                        //upload gambar
                        /*
                        unset($config);
                        //icon
                        $config['upload_path'] = '../asset/foto_products/';
                        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
                        $config['max_size'] = '20000'; // kb
                        //$new_name = substr(md5(uniqid(mt_rand())),0,10).'_'.time().'_'.$_FILES["icon"]['name'];
                        //$config['file_name'] = $new_name;
                        //$this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        $this->upload->do_upload($realpath);
                        $gambardata=$this->upload->data();
                        */
                        //move_uploaded_file($realpath, $targetpath);
                        if (file_exists($realpath)) {
                            copy($realpath, $targetpath);
                        }
                    }
                    $data = array(
                        //"id_products"     => $rowData[0][0],
                        "username"      => 'admin',
                        "judul"         => $rowData[0][2],
                        "slug"          => $rowData[0][3],
                        "isi_products"    => $content,
                        "gambar"        => $this->db->escape_str($ssrcimg), //$rowData[0][20],
                        "products_views"  => $rowData[0][14],
                        "meta_description"  => $rowData[0][21],
                        "meta_keywords"  => $rowData[0][22],
                        "id_categories"   => $rowData[0][13],
                        "tgl_posting"          => \PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][12], 'd-m-Y H:i:s'),
                    );
                    unset($config);
                    if ($this->db->insert("products", $data)) {
                        # code...
                        $data['error'] = FALSE;
                        $slugproducts = $rowData[0][3]; //$this->slug->create_uri($this->input->post('judul'));
                        //toxy categories
                        //$this->load->model('Tags_model','tags');
                        $datpost = $this->get_products_id($slugproducts);
                        $idpost = $datpost[0]['id_products'];
                        $tags = $rowData[0][6]; //$this->db->escape_str($this->input->post('tagshasil'));
                        if ($tags != '') {
                            $this->model_products_tags->insert_products_tagsdb($tags);
                            $this->model_products_tags->insert_products_tagsmap($tags, $idpost, 'products');
                        }
                        $Category = $row["Category Name"];
                        if ($Category != '') {
                            $this->model_products_categories->insert_products_categoriesdb($Category);
                            //$this->model_products_categories->insert_products_categoriesmap($Category,$idpost,'products'); //multi cat
                            $this->model_products_categories->insert_products_categoriesid($Category, $idpost, 'products'); //single cat
                        }
                        //toxy categories
                        //$this->load->model('Categories_model','categories');
                        //$datpost = $this->get_products_id($slugproducts);
                        //$idpost = $datpost[0]['id_products'];
                        //$cats = $rowData[0][6];//$this->db->escape_str($this->input->post('tagshasil'));
                        //$this->categories_model->insert_categoriesdb($cats);
                        //$this->categories_model->insert_categoriesmap($cats,$idpost,'products');
                    }
                }
                $data['datafile'] = $media['file_ext'];
                echo json_encode($data);
                //echo "berahasil";
                //redirect('data');
                //=======

            }
        }
    }
    function reset_db_products()
    {
        $this->db->truncate('products');
        $this->db->truncate('products_tagmap');
        $this->db->truncate('products_tags');

        $tables = array('categories_lists');
        $this->db->where('group_id', '5');
        $this->db->delete($tables);
        //$this->db->query("TRUNCATE TABLE products");
        //$this->db->query("TRUNCATE TABLE products_tagmap");
        //$this->db->query("TRUNCATE TABLE products_tags");
        foreach (glob('../asset/foto_products/*') as $rowimg) {
            if ((file_exists($rowimg)) && ($rowimg != '../asset/foto_products/nophoto.jpg')) {
                //if ($rowimg != $src ) {
                unlink($rowimg);
                //}

            }
        }
    }
    function kategori_products()
    {
        return $this->db->query("SELECT * FROM kategori ORDER BY id_kategori DESC");
    }

    function kategori_products_tambah()
    {
        $datadb = array(
            'nama_kategori' => $this->db->escape_str($this->input->post('a')),
            'kategori_seo' => seo_title($this->input->post('a')),
            'aktif' => $this->db->escape_str($this->input->post('b'))
        );
        $this->db->insert('kategori', $datadb);
    }

    function kategori_products_edit($id)
    {
        return $this->db->query("SELECT * FROM kategori where id_kategori='$id'");
    }

    function kategori_products_update()
    {
        $datadb = array(
            'nama_kategori' => $this->db->escape_str($this->input->post('a')),
            'kategori_seo' => seo_title($this->input->post('a')),
            'aktif' => $this->db->escape_str($this->input->post('b'))
        );
        $this->db->where('id_kategori', $this->input->post('id'));
        $this->db->update('kategori', $datadb);
    }

    function kategori_products_delete($id)
    {
        return $this->db->query("DELETE FROM kategori where id_kategori='$id'");
    }

    //categories
    function categories_products()
    {
        return $this->db->query("SELECT * FROM categories_lists where group_id=5 ORDER BY id DESC");
    }
    //
    function sensorkata()
    {
        return $this->db->query("SELECT * FROM katajelek ORDER BY id_jelek DESC");
    }

    function sensorkata_tambah()
    {
        $datadb = array(
            'kata' => $this->db->escape_str($this->input->post('a')),
            'ganti' => $this->db->escape_str($this->input->post('b'))
        );
        $this->db->insert('katajelek', $datadb);
    }

    function sensorkata_edit($id)
    {
        return $this->db->query("SELECT * FROM katajelek where id_jelek='$id'");
    }

    function sensorkata_update()
    {
        $datadb = array(
            'kata' => $this->db->escape_str($this->input->post('a')),
            'ganti' => $this->db->escape_str($this->input->post('b'))
        );
        $this->db->where('id_jelek', $this->input->post('id'));
        $this->db->update('katajelek', $datadb);
    }

    function sensorkata_delete($id)
    {
        return $this->db->query("DELETE FROM katajelek where id_jelek='$id'");
    }



    function tag_products()
    {
        return $this->db->query("SELECT * FROM tag ORDER BY id_tag DESC");
    }
    //toxi tag
    function tags_products($post_id)
    {
        //return $this->db->query("SELECT * FROM tag ORDER BY id_tag DESC");
        //$hasil = $this->db->query("SELECT t.slug FROM tagmap bt, products b, tags t WHERE bt.tags_id = t.tags_id AND b.id_products = '$post_id' GROUP BY t.tags_id");
        //$tagsdata = implode(',',$hasil);
        $hasil = $this->db->query("SELECT t.slug
                                    FROM products_tagmap bt, products_tags t, products b
                                    WHERE bt.id_products = '$post_id'
                                    AND t.tags_id = bt.tags_id
                                    GROUP BY t.tags_id");
        return $hasil;
    }
    function get_products_id($slug)
    {
        return $this->db->query("SELECT * FROM products where slug='$slug'")->result_array();
    }
    //toxi tag end
    function tag_products_tambah()
    {
        $datadb = array(
            'nama_tag' => $this->db->escape_str($this->input->post('a')),
            'tag_seo' => seo_title($this->input->post('a')),
            'count' => '0'
        );
        $this->db->insert('tag', $datadb);
    }

    function tag_products_edit($id)
    {
        return $this->db->query("SELECT * FROM tag where id_tag='$id'");
    }

    function tag_products_update()
    {
        $datadb = array(
            'nama_tag' => $this->db->escape_str($this->input->post('a')),
            'tag_seo' => seo_title($this->input->post('a'))
        );
        $this->db->where('id_tag', $this->input->post('id'));
        $this->db->update('tag', $datadb);
    }

    function tag_products_delete($id)
    {
        return $this->db->query("DELETE FROM tag where id_tag='$id'");
    }

    function komentar_products($id_products)
    {
        return $this->db->query("SELECT * FROM komentar where id_products = '$id_products' AND aktif='Y'");
    }

    function kirim_komentar()
    {
        $datadb = array(
            'id_products' => cetak($this->input->post('a')),
            'nama_komentar' => cetak($this->input->post('b')),
            'url' => cetak($this->input->post('c')),
            'isi_komentar' => cetak($this->input->post('d')),
            'tgl' => date('Y-m-d'),
            'jam_komentar' => date('H:i:s'),
            'aktif' => 'N'
        );
        $this->db->insert('komentar', $datadb);
    }
    /*
    function list_products_rss(){
        return $this->db->query("SELECT a.*, b.nama_kategori FROM products a LEFT JOIN kategori b ON a.id_kategori=b.id_kategori ORDER BY a.id_products DESC LIMIT 10");
    }

    function list_products(){
        return $this->db->query("SELECT a.*, b.nama_kategori FROM products a LEFT JOIN kategori b ON a.id_kategori=b.id_kategori ORDER BY a.id_products DESC");
    }
    */
    function list_products_rss()
    {
        return $this->db->query("SELECT a.*, b.name FROM products a LEFT JOIN categories_lists b ON a.id_categories=b.id ORDER BY a.id_products DESC LIMIT 10");
    }

    function list_products()
    {
        return $this->db->query("SELECT a.*, b.name FROM products a LEFT JOIN categories_lists b ON a.id_categories=b.id ORDER BY a.id_products DESC");
    }
    function featured_products()
    {
        $this->db->select('*');
        $this->db->from('products');
        //filter data by searched keywords
        $this->db->like('featured', 'on');
        $this->db->order_by('position', 'asc');
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0) ? $query->result_array() : array();
    }
    public function reorder_featured($list)
    {
        $position = 1;

        $this->db->trans_start();
        foreach ($list as $id) {
            $this->db->where('id_products', $id)->set('position', $position)->update('products');
            $position++;
        }
        $this->db->trans_complete();

        return $this->db->trans_status();
        $data['error'] = $this->db->trans_status();
        //$data['datafile'] = $media['file_ext'];
        //$data['hasilcsv'] = $file_data;

        echo json_encode($data);
    }

    function list_products_tambah()
    {
        $config['upload_path'] = '../asset/foto_products/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $new_name = substr(md5(uniqid(mt_rand())), 0, 10) . '_' . time() . '_' . $_FILES["gambar"]['name'];
        $config['remove_spaces'] = true;
        $config['file_name'] = preg_replace("/[^a-zA-Z0-9.]/", "_", $new_name);
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $this->load->library('upload', $config);
        $this->upload->do_upload('gambar');
        $hasil = $this->upload->data();
        if ($this->input->post('j') != '') {
            $tag_seo = $this->input->post('j');
            $tag = implode(',', $tag_seo);
        } else {
            $tag = '';
        }
        //fikar

        $config = array(
            'field' => 'slug',
            'title' => 'judul',
            'table' => 'products',
            'id' => 'id_products',
        );
        $this->load->library('slug', $config);
        $slugproducts = $this->slug->create_uri($this->input->post('judul'));
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        //fikar z
        if (!empty($this->db->escape_str($this->input->post('tagshasil')))) {
            $strtags = $this->db->escape_str($this->input->post('tagshasil'));
            $arrtags = explode(",", $strtags);
            foreach ($arrtags as &$value) {
                $value = $this->slug->create_uri(trim($value));
                # code...
            }
            $tagsdata = implode(',', $arrtags);
        } else {
            $tagsdata = '';
        }


        if ($_FILES["gambar"]['name'] == '') {
            $datadb = array(
                'judul' => $this->db->escape_str($this->input->post('judul')),
                'slug' => $this->slug->create_uri($this->input->post('judul')),
                'isi_products' => $this->input->post('isi_products'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'price' => clean_number($this->db->escape_str($this->input->post('price'))),
                //'lokasi'=>$this->input->post('lokasi'),
                //'tgl_mulai'=>tanggalindo($this->input->post('tgl_mulai'),"Y-m-d"),
                //'tgl_selesai'=>tanggalindo($this->input->post('tgl_selesai'),"Y-m-d"),
                //'jam_mulai'=>$this->input->post('jam_mulai'),
                //'hari'=>hari_ini(date('w')),
                //'tgl_posting'=>date('Y-m-d'),
                //'jam'=>date('H:i:s'),
                'products_views' => '0',
                //'id_tag'=>$tagsdata,
                'username' => $this->session->username,
                'id_categories' => $this->db->escape_str($this->input->post('id_kategorihasil'))
            );
        } else {
            $datadb = array(
                'judul' => $this->db->escape_str($this->input->post('judul')),
                'slug' => $this->slug->create_uri($this->input->post('judul')),
                'meta_title' => $this->input->post('meta_title'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'isi_products' => $this->input->post('isi_products'),
                'price' => clean_number($this->db->escape_str($this->input->post('price'))),
                //'lokasi'=>$this->input->post('lokasi'),

                //'tgl_mulai'=>tanggalindo($this->input->post('tgl_mulai'),"Y-m-d"),
                //'tgl_selesai'=>tanggalindo($this->input->post('tgl_selesai'),"Y-m-d"),
                //'jam_mulai'=>$this->input->post('jam_mulai'),
                //'hari'=>hari_ini(date('w')),
                //'tgl_posting'=>date('Y-m-d'),
                //'jam'=>date('H:i:s'),
                'products_views' => '0',
                //'id_tag'=>$tagsdata,
                'username' => $this->session->username,
                'id_categories' => $this->db->escape_str($this->input->post('id_kategorihasil')),
                'gambar' => $hasil['file_name']
            );
        }

        if ($this->db->insert('products', $datadb)) {
            //if(file_exists('../asset/foto_products/'.$hasil['file_name'])){
            if ($this->db->escape_str($this->input->post('watermark')) == 'on') {
                $wm = true;
            } else {
                $wm = false;
            }
            thumb('../asset/foto_products/' . $hasil['file_name'], '400', '200', $wm);

            //}
        }
        //fikar tag toxi
        //$ci=& get_instance();
        //$ci->load->model('Tags_model');
        $this->load->model('Tags_model', 'tags');
        $datpost = $this->get_products_id($slugproducts);
        $idpost = $datpost[0]['id_products'];
        $tags = $this->db->escape_str($this->input->post('tagshasil'));
        if (!empty($tags)) {
            $this->model_products_tags->insert_products_tagsdb($tags);
            $this->model_products_tags->insert_products_tagsmap($tags, $idpost, 'products');
        }
        //print_r($datpost);
        //echo $idpost;
        //end tag toxi
    }

    function list_products_edit($id)
    {
        return $this->db->query("SELECT * FROM products where id_products='$id'");
    }

    function list_products_update()
    {
        $config['upload_path'] = '../asset/foto_products/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $new_name = substr(md5(uniqid(mt_rand())), 0, 10) . '_' . time() . '_' . $_FILES["gambar"]['name'];
        $config['remove_spaces'] = true;
        $config['file_name'] = preg_replace("/[^a-zA-Z0-9.]/", "_", $new_name);
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        $this->load->library('upload', $config);
        $this->upload->do_upload('gambar');
        $hasil = $this->upload->data();
        //fikar
        $config = array(
            'field' => 'slug',
            'title' => 'judul',
            'table' => 'products',
            'id' => 'id_products',
        );
        $this->load->library('slug', $config);
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        //fikar z
        $page = $this->db->where('id_products', $this->input->post('id'))->limit(1)->get('products')->row();
        if ($this->db->escape_str($this->input->post('judul')) != $page->judul) {
            //$slugku = $page->slug;
            $new_slug = true;
        } else {
            //$slugku = $this->slug->create_uri($this->input->post('a'));
            $new_slug = false;
        }

        if ($this->input->post('j') != '') {
            $tag_seo = $this->input->post('j');
            $tag = implode(',', $tag_seo);
        } else {
            $tag = '';
        }
        //fikar tags

        if (!empty($this->db->escape_str($this->input->post('tagshasil')))) {
            $strtags = $this->db->escape_str($this->input->post('tagshasil'));
            $arrtags = explode(",", $strtags);
            foreach ($arrtags as &$value) {
                $value = $this->slug->create_uri(trim($value));
                # code...
            }
            $tagsdata = implode(',', $arrtags);
        } else {
            $tagsdata = '';
        }
        $datadb = array();
        //end fikar tags
        if ($_FILES["gambar"]['name'] == '') {
            $imgupdate = false;
            $datadb = array(
                //'id_kategori'=>$this->db->escape_str($this->input->post('id_kategorihasil')),
                //'username'=>$this->db->escape_str($this->input->post('username')),
                'judul' => $this->db->escape_str($this->input->post('judul')),
                //'judul_seo'=>seo_title($this->input->post('judul')),
                //'headline'=>$this->db->escape_str($this->input->post('headline')),
                'isi_products' => $this->input->post('isi_products'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'price' => clean_number($this->db->escape_str($this->input->post('price'))),
                //'lokasi'=>$this->input->post('lokasi'),
                //'tgl_mulai'=>tanggalindo($this->input->post('tgl_mulai'),"Y-m-d"),
                //'tgl_selesai'=>tanggalindo($this->input->post('tgl_selesai'),"Y-m-d"),
                //'jam_mulai'=>$this->input->post('jam_mulai'),
                //'hari'=>hari_ini(date('w')),
                //'tgl_posting'=>date('Y-m-d'),
                //'jam'=>date('H:i:s'),
                'username' => $this->session->username,
                //'products_views'=>'0',
                //'id_tag'=>$this->db->escape_str($this->input->post('tagshasil')),
                //'id_tag'=>$tagsdata,

            );
        } else {
            $imgupdate = true;
            $datadb = array(
                //'id_kategori'=>$this->db->escape_str($this->input->post('id_kategorihasil')),
                //'username'=>$this->db->escape_str($this->input->post('username')),
                'judul' => $this->db->escape_str($this->input->post('judul')),
                //'judul_seo'=>seo_title($this->input->post('judul')),
                //'headline'=>$this->db->escape_str($this->input->post('headline')),
                'isi_products' => $this->input->post('isi_products'),
                'meta_title' => $this->input->post('meta_title'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'meta_description' => $this->input->post('meta_description'),
                'price' => clean_number($this->db->escape_str($this->input->post('price'))),
                //'lokasi'=>$this->input->post('lokasi'),
                //'tgl_mulai'=>tanggalindo($this->input->post('tgl_mulai'),"Y-m-d"),
                //'tgl_selesai'=>tanggalindo($this->input->post('tgl_selesai'),"Y-m-d"),
                //'jam_mulai'=>$this->input->post('jam_mulai'),
                //'hari'=>hari_ini(date('w')),
                //'tgl_posting'=>date('Y-m-d'),
                //'jam'=>date('H:i:s'),
                'username' => $this->session->username,
                'gambar' => $hasil['file_name'],
                //'products_views'=>'0',
                //'id_tag'=>$this->db->escape_str($this->input->post('tagshasil')),
                //'id_tag'=>$tagsdata,


            );

            getnameimg('../asset/foto_products/' . $page->gambar, 'foto_products');
            //unlink('../asset/foto_products/'.$page->gambar);
        }
        //$datadb['attachment'] = $this->db->escape_str($this->input->post('attachment'));

        $datadb['featured'] = $this->db->escape_str($this->input->post('featured'));

        //if (! empty($this->db->escape_str($this->input->post('id_kategorihasil')))) {
        # code...
        $datadb['id_categories'] = $this->db->escape_str($this->input->post('id_kategori')); //$this->db->escape_str($this->input->post('id_kategorihasil'));
        //}
        if ($new_slug) {
            $datadb['slug'] = $this->slug->create_uri($this->input->post('judul'));
        }
        $this->db->where('id_products', $this->input->post('id'));

        if ($this->db->update('products', $datadb)) {
            if ($imgupdate == true) {
                //if(file_exists('../asset/foto_products/'.$hasil['file_name'])){
                if ($this->db->escape_str($this->input->post('watermark')) == 'on') {
                    $wm = true;
                } else {
                    $wm = false;
                }
                thumb('../asset/foto_products/' . $hasil['file_name'], '400', '200', $wm);
                //}
            }
        }
        //echo $this->db->escape_str($this->input->post('featured'));
    }

    function list_products_delete($id)
    {
        $this->list_products_deleteimg($id, 'products');
        $page = $this->db->where('id_products', $id)->limit(1)->get('products')->row();
        //print_r($page);
        getnameimg('../asset/foto_products/' . $page->gambar, 'foto_products');
        return $this->db->query("DELETE FROM products where id_products='$id'");
    }

    function list_products_uploadimg($id, $type = 'products')
    {

        /*
        $datalama = $this->getRows_products($this->input->post('id'));
        $folderimg = '../asset/foto_products/products/';
        //print_r($datalama);
        foreach ($datalama as $file) {
            # code...
            if (file_exists($folderimg.$file['file_name'])) {
                //unlink($folderimg.$file['file_name']);
                delete_thumb('../asset/foto_products/products/'.$file['file_name'],'foto_products/products/');
            }
        }
        $tables = array('files');
        $this->db->where('id_post', $this->input->post('id'));
        $this->db->delete($tables);
        */

        // If file upload form submitted

        if (!empty($_FILES['pro-image']['name'])) {
            $filesCount = count($_FILES['pro-image']['name']);
            for ($i = 0; $i < $filesCount; $i++) {
                $_FILES['file']['name']     = $_FILES['pro-image']['name'][$i];
                $_FILES['file']['type']     = $_FILES['pro-image']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['pro-image']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['pro-image']['error'][$i];
                $_FILES['file']['size']     = $_FILES['pro-image']['size'][$i];

                // File upload configuration
                $config['upload_path'] = '../asset/foto_products/products/';
                $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
                $config['max_size'] = '3000'; // kb
                $new_name = substr(md5(uniqid(mt_rand())), 0, 10) . '_' . time() . '_' . $_FILES["file"]['name'];
                $config['remove_spaces'] = true;
                $config['file_name'] = preg_replace("/[^a-zA-Z0-9.]/", "_", $new_name);
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }


                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    if ($this->db->escape_str($this->input->post('watermark')) == 'on') {
                        $wm = true;
                    } else {
                        $wm = false;
                    }

                    thumb('../asset/foto_products/products/' . $fileData['file_name'], '400', '200', $wm);
                    $uploadData[$i]['id_post'] = $this->input->post('id');
                    $uploadData[$i]['post_type'] = $type;
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                }
            }

            if (!empty($uploadData)) {
                //print_r($uploadData);
                // echo implode(",",$uploadData);
                // Insert files data into the database
                $this->list_products_deleteimg($id, $type);
                $insert = $this->insert_products_db($uploadData);

                // Upload status message
                $statusMsg = $insert ? 'Files uploaded successfully.' : 'Some problem occurred, please try again.';
                $this->session->set_flashdata('statusMsg', $statusMsg);
            }
        }
    }
    function list_products_deleteimg($id, $type = 'products')
    {

        $datalama = $this->getRows_products($this->input->post('id'), $type);
        $folderimg = '../asset/foto_products/products/';
        //print_r($datalama);
        if (!empty($datalama)) {
            foreach ($datalama as $file) {
                # code...
                if (file_exists($folderimg . $file['file_name'])) {
                    //unlink($folderimg.$file['file_name']);
                    delete_thumb('../asset/foto_products/products/' . $file['file_name'], 'foto_products/products/');
                }
            }
            //$tables = array('files');
            //$this->db->where('id_post', $this->input->post('id'));
            //$this->db->delete($tables);

        }
        return $this->db->query("DELETE FROM files where id_post='$id' and post_type='$type' ");
        //echo $id;
        //echo $type;


    }
    function insert_products_db($data = array())
    {
        $insert = $this->db->insert_batch('files', $data);
        return $insert ? true : false;
    }
    function getRows_products($id = '', $post_type = 'products')
    {
        $this->db->select('*');
        $this->db->from('files');
        if ($id) {
            $this->db->where('id_post', $id);
            $this->db->where('post_type', $post_type);
            $query = $this->db->get();
            $result = $query->result_array();
        } else {
            $this->db->order_by('uploaded_on', 'desc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result) ? $result : false;
    }

    function komentar()
    {
        return $this->db->query("SELECT * FROM komentar ORDER BY id_komentar DESC");
    }

    function komentar_edit($id)
    {
        return $this->db->query("SELECT * FROM komentar where id_komentar='$id'");
    }

    function komentar_update()
    {
        $datadb = array(
            'nama_komentar' => $this->db->escape_str($this->input->post('a')),
            'url' => $this->db->escape_str($this->input->post('b')),
            'isi_komentar' => $this->input->post('c'),
            'aktif' => $this->input->post('d')
        );
        $this->db->where('id_komentar', $this->input->post('id'));
        $this->db->update('komentar', $datadb);
    }

    function komentar_delete($id)
    {
        return $this->db->query("DELETE FROM komentar where id_komentar='$id'");
    }

    function update_products($data = array())
    {
        // Check so incoming data is actually an array and not empty
        if (is_array($data) && !empty($data)) {
            // We already have a correctly formatted array from the controller,
            // so no need to do anything else here, just update.

            // Update rows in database
            $this->db->update_batch('products', $data, 'id_products');
        }
    }
}
