<?php 
class Model_clients extends CI_model{
    function getclients($params = array()){
        $this->db->select('*');
        $this->db->from('clients');
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('judul',$params['search']['keywords']);
        }
        if(!empty($params['search']['kategori'])){
            $this->db->like('id_categories',$params['search']['kategori']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            //$this->db->order_by('judul',$params['search']['sortBy']);
            $sortByparams = $params['search']['sortBy'];
            switch ($sortByparams) {
                // pilih type order
                case 'titleasc':
                   // echo 'titleasc';
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
                    $name = 'id_clients';
                    $sortBy = 'asc';  
                    break;
                case 'datedesc':
                    //echo 'datedesc'; 
                    $name = 'id_clients';
                    $sortBy = 'desc';  
                    break;
                default:
                    //echo 'default';
                    $name = 'id_clients';
                    $sortBy = 'desc';
                    break;
            }
            $this->db->order_by($name,$sortBy);
        }else{
            $this->db->order_by('id_clients','desc');
        }
        //related product
        if(!empty($params['products_id'])){
            $this->db->where('id_products !=', $params['products_id']);
        }
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array():array();
    }
    function upload_data(){
        $this->reset_db_clients();
        //$this->db->query("TRUNCATE TABLE clients");
        //$this->db->query("TRUNCATE TABLE clients_tagmap");
        //$this->db->query("TRUNCATE TABLE clients_tags");
        $config['upload_path'] = '../asset/upload/';
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = '3000'; // kb
        //$new_name = $_FILES["filexl"]['name'];

        $this->load->library('upload', $config);
        //$this->upload->do_upload('c');
        //$hasil=$this->upload->data();
        //fikar
        $config = array(
            'field' => 'slug',
            'title' => 'judul',
            'table' => 'clients',
            'id' => 'id_clients',
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
        }
        else{
            $media = $this->upload->data();
            $inputFileName = '../asset/upload/'.$media['file_name'];

            if ($media['file_ext'] == '.csv') {
                # code...
                $file_data = $this->csvimport->get_array($inputFileName);
                
                foreach($file_data as $row)
                {
                    $ssrc = $row["Image"];
                    if ($ssrc != '') {
                        # code...
                    
                        $cutstring = "C:\\xampp\htdocs\pt-cmp.comr1\media\k2\items\src\\";

                        if (strpos($ssrc, $cutstring) !== false){
                        // car found
                            $ssrcimg = str_replace($cutstring,'',$ssrc);
                        }
                        else{
                            $ssrcimg = $ssrc;

                        }
                        $realpath = "../media/k2/items/src/".$ssrcimg;
                        $targetpath = "../asset/foto_clients/".$ssrcimg;
                        //upload gambar
                        /*
                        unset($config);
                        //icon
                        $config['upload_path'] = '../asset/foto_clients/';
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
                        if(file_exists($realpath)){
                            copy($realpath, $targetpath);
                        }
                    }
                    $data = array(
                    "username"      => 'admin',
                    "judul"         => $row["Title"],
                    "slug"          => $row["Alias"],
                    "isi_clients"    => $row["Introtext"].$row["Fulltext"],
                    "gambar"        => $this->db->escape_str($ssrcimg),//$rowData[0][20],
                    "clients_views"  => $row["Hits"],
                    "meta_description"  => $row["Meta Description"],
                    "meta_keywords"  => $row["Meta Keywords"],
                    //"id_categories"   => $row["Category Name"],
                    "created_time"          => $row["Created"],
                    //'judul' => $row["Title"],
                    //'first_name' => $row["First Name"],
                    //      'last_name'  => $row["Last Name"],
                     //     'phone'   => $row["Phone"],
                     //     'email'   => $row["Email"]
                    );

                    //$this->csv_import_model->insert($data);
                    if ($this->db->insert("clients",$data)) {
                        # code...
                        $data['error'] = FALSE;
                        $slugclients = $row["Alias"];//$this->slug->create_uri($this->input->post('judul'));
                        //toxy categories
                        //$this->load->model('Tags_model','tags');
                        $datpost = $this->get_clients_id($slugclients);
                        $idpost = $datpost[0]['id_clients'];
                        $tags = $row["Tags"];//$this->db->escape_str($this->input->post('tagshasil'));
                        if ($tags != '') {
                            $this->model_clients_tags->insert_clients_tagsdb($tags);
                            $this->model_clients_tags->insert_clients_tagsmap($tags,$idpost,'clients');
                        }
                        $Category = $row["Category Name"];
                        if ($Category != '') {
                            $this->model_clients_categories->insert_clients_categoriesdb($Category);
                            //$this->model_clients_categories->insert_clients_categoriesmap($Category,$idpost,'clients'); //multi cat
                            $this->model_clients_categories->insert_clients_categoriesid($Category,$idpost,'clients'); //single cat
                        }
                        //toxy categories
                        //$this->load->model('Categories_model','categories');
                        //$datpost = $this->get_clients_id($slugclients);
                        //$idpost = $datpost[0]['id_clients'];
                        //$cats = $rowData[0][6];//$this->db->escape_str($this->input->post('tagshasil'));
                        //$this->categories_model->insert_categoriesdb($cats);
                        //$this->categories_model->insert_categoriesmap($cats,$idpost,'clients');
                    }

                }
                

                $data['error'] = TRUE;
                $data['datafile'] = $media['file_ext'];
                //$data['hasilcsv'] = $file_data;

                echo json_encode($data); 
            }
            else{
                try {
                    $inputFileType = IOFactory::identify($inputFileName);
                    $objReader = IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                }
                catch(Exception $e) {
                    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                }
                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                for ($row = 2; $row <= $highestRow; $row++){  
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
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

                        if (strpos($ssrc, $cutstring) !== false){
                        // car found
                            $ssrcimg = str_replace($cutstring,'',$ssrc);
                        }
                        else{
                            $ssrcimg = $ssrc;

                        }
                        $realpath = "../media/k2/items/src/".$ssrcimg;
                        $targetpath = "../asset/foto_clients/".$ssrcimg;
                        //upload gambar
                        /*
                        unset($config);
                        //icon
                        $config['upload_path'] = '../asset/foto_clients/';
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
                        if(file_exists($realpath)){
                            copy($realpath, $targetpath);
                        }
                    }
                    $data = array(
                        //"id_clients"     => $rowData[0][0],
                        "username"      => 'admin',
                        "judul"         => $rowData[0][2],
                        "slug"          => $rowData[0][3],
                        "isi_clients"    => $content,
                        "gambar"        => $this->db->escape_str($ssrcimg),//$rowData[0][20],
                        "clients_views"  => $rowData[0][14],
                        "meta_description"  => $rowData[0][21],
                        "meta_keywords"  => $rowData[0][22],
                        "id_categories"   => $rowData[0][13],
                        "created_time"          => \PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][12], 'd-m-Y H:i:s'),
                    );
                    unset($config);
                    if ($this->db->insert("clients",$data)) {
                        # code...
                        $data['error'] = FALSE;
                        $slugclients = $rowData[0][3];//$this->slug->create_uri($this->input->post('judul'));
                        //toxy categories
                        //$this->load->model('Tags_model','tags');
                        $datpost = $this->get_clients_id($slugclients);
                        $idpost = $datpost[0]['id_clients'];
                        $tags = $rowData[0][6];//$this->db->escape_str($this->input->post('tagshasil'));
                        if ($tags != '') {
                            $this->model_clients_tags->insert_clients_tagsdb($tags);
                            $this->model_clients_tags->insert_clients_tagsmap($tags,$idpost,'clients');
                        }
                        $Category = $row["Category Name"];
                        if ($Category != '') {
                            $this->model_clients_categories->insert_clients_categoriesdb($Category);
                            //$this->model_clients_categories->insert_clients_categoriesmap($Category,$idpost,'clients'); //multi cat
                            $this->model_clients_categories->insert_clients_categoriesid($Category,$idpost,'clients'); //single cat
                        }
                        //toxy categories
                        //$this->load->model('Categories_model','categories');
                        //$datpost = $this->get_clients_id($slugclients);
                        //$idpost = $datpost[0]['id_clients'];
                        //$cats = $rowData[0][6];//$this->db->escape_str($this->input->post('tagshasil'));
                        //$this->categories_model->insert_categoriesdb($cats);
                        //$this->categories_model->insert_categoriesmap($cats,$idpost,'clients');
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
    function reset_db_clients(){
        $this->db->truncate('clients');
        $this->db->truncate('clients_tagmap');
        $this->db->truncate('clients_tags');
  
        $tables = array('categories_lists');
        $this->db->where('group_id', '8');
        $this->db->delete($tables);
        //$this->db->query("TRUNCATE TABLE clients");
        //$this->db->query("TRUNCATE TABLE clients_tagmap");
        //$this->db->query("TRUNCATE TABLE clients_tags");

    }
    function kategori_clients(){
        return $this->db->query("SELECT * FROM kategori ORDER BY id_kategori DESC");
    }

    function kategori_clients_tambah(){
        $datadb = array('nama_kategori'=>$this->db->escape_str($this->input->post('a')),
                        'kategori_seo'=>seo_title($this->input->post('a')),
                        'aktif'=>$this->db->escape_str($this->input->post('b')));
        $this->db->insert('kategori',$datadb);
    }

    function kategori_clients_edit($id){
        return $this->db->query("SELECT * FROM kategori where id_kategori='$id'");
    }

    function kategori_clients_update(){
        $datadb = array('nama_kategori'=>$this->db->escape_str($this->input->post('a')),
                        'kategori_seo'=>seo_title($this->input->post('a')),
                        'aktif'=>$this->db->escape_str($this->input->post('b')));
        $this->db->where('id_kategori',$this->input->post('id'));
        $this->db->update('kategori',$datadb);
    }

    function kategori_clients_delete($id){
        return $this->db->query("DELETE FROM kategori where id_kategori='$id'");
    }

    //categories
    function categories_clients(){
        return $this->db->query("SELECT * FROM categories_lists where group_id=8 ORDER BY id DESC");
    }
    //
    function sensorkata(){
        return $this->db->query("SELECT * FROM katajelek ORDER BY id_jelek DESC");
    }

    function sensorkata_tambah(){
        $datadb = array('kata'=>$this->db->escape_str($this->input->post('a')),
                        'ganti'=>$this->db->escape_str($this->input->post('b')));
        $this->db->insert('katajelek',$datadb);
    }

    function sensorkata_edit($id){
        return $this->db->query("SELECT * FROM katajelek where id_jelek='$id'");
    }

    function sensorkata_update(){
        $datadb = array('kata'=>$this->db->escape_str($this->input->post('a')),
                        'ganti'=>$this->db->escape_str($this->input->post('b')));
        $this->db->where('id_jelek',$this->input->post('id'));
        $this->db->update('katajelek',$datadb);
    }

    function sensorkata_delete($id){
        return $this->db->query("DELETE FROM katajelek where id_jelek='$id'");
    }



    function tag_clients(){
        return $this->db->query("SELECT * FROM tag ORDER BY id_tag DESC");
    }
    //toxi tag
    function tags_clients($post_id){
        //return $this->db->query("SELECT * FROM tag ORDER BY id_tag DESC");
        //$hasil = $this->db->query("SELECT t.slug FROM tagmap bt, clients b, tags t WHERE bt.tags_id = t.tags_id AND b.id_clients = '$post_id' GROUP BY t.tags_id");
        //$tagsdata = implode(',',$hasil);
        $hasil = $this->db->query("SELECT t.slug
                                    FROM clients_tagmap bt, clients_tags t, clients b
                                    WHERE bt.id_clients = '$post_id'
                                    AND t.tags_id = bt.tags_id
                                    GROUP BY t.tags_id");
        return $hasil;
    }
    function get_clients_id($slug){
        return $this->db->query("SELECT * FROM clients where slug='$slug'")->result_array();
    }
    //toxi tag end
    function tag_clients_tambah(){
        $datadb = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
                        'tag_seo'=>seo_title($this->input->post('a')),
                        'count'=>'0');
        $this->db->insert('tag',$datadb);
    }

    function tag_clients_edit($id){
        return $this->db->query("SELECT * FROM tag where id_tag='$id'");
    }

    function tag_clients_update(){
        $datadb = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
                        'tag_seo'=>seo_title($this->input->post('a')));
        $this->db->where('id_tag',$this->input->post('id'));
        $this->db->update('tag',$datadb);
    }

    function tag_clients_delete($id){
        return $this->db->query("DELETE FROM tag where id_tag='$id'");
    }

    function komentar_clients($id_clients){
        return $this->db->query("SELECT * FROM komentar where id_clients = '$id_clients' AND aktif='Y'");
    }

    function kirim_komentar(){
        $datadb = array('id_clients'=>cetak($this->input->post('a')),
                                'nama_komentar'=>cetak($this->input->post('b')),
                                'url'=>cetak($this->input->post('c')),
                                'isi_komentar'=>cetak($this->input->post('d')),
                                'tgl'=>date('Y-m-d'),
                                'jam_komentar'=>date('H:i:s'),
                                'aktif'=>'N');
        $this->db->insert('komentar',$datadb);
    }
    /*
    function list_clients_rss(){
        return $this->db->query("SELECT a.*, b.nama_kategori FROM clients a LEFT JOIN kategori b ON a.id_kategori=b.id_kategori ORDER BY a.id_clients DESC LIMIT 10");
    }

    function list_clients(){
        return $this->db->query("SELECT a.*, b.nama_kategori FROM clients a LEFT JOIN kategori b ON a.id_kategori=b.id_kategori ORDER BY a.id_clients DESC");
    }
    */
    function list_clients_rss(){
        return $this->db->query("SELECT a.*, b.name FROM clients a LEFT JOIN categories_lists b ON a.id_categories=b.id ORDER BY a.id_clients DESC LIMIT 10");
    }

    function list_clients(){
        return $this->db->query("SELECT a.*, b.name FROM clients a LEFT JOIN categories_lists b ON a.id_categories=b.id ORDER BY a.id_clients DESC");
    }

    
    function list_clients_tambah(){
            $config['upload_path'] = '../asset/foto_clients/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '3000'; // kb
            $new_name = substr(md5(uniqid(mt_rand())),0,10).'_'.time().'_'.$_FILES["gambar"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $hasil=$this->upload->data();
            if ($this->input->post('j')!=''){
                $tag_seo = $this->input->post('j');
                $tag=implode(',',$tag_seo);
            }else{
                $tag = '';
            }
            //fikar

            $config = array(
                'field' => 'slug',
                'title' => 'judul',
                'table' => 'clients',
                'id' => 'id_clients',
            );
            $this->load->library('slug', $config);
            $slugclients = $this->slug->create_uri($this->input->post('judul'));
            // create the slug
            //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
            //fikar z
            if (! empty($this->db->escape_str($this->input->post('tagshasil'))))
            {
                $strtags = $this->db->escape_str($this->input->post('tagshasil'));
                $arrtags = explode(",",$strtags);
                foreach ($arrtags as &$value)
                {
                    $value = $this->slug->create_uri(trim($value));
                    # code...
                }
                $tagsdata = implode(',',$arrtags);

            }
            else
            {
                $tagsdata = '';
            }
            

            if ($_FILES["gambar"]['name']==''){
                    $datadb = array('judul'=>$this->db->escape_str($this->input->post('judul')),
                                    'slug'=> $this->slug->create_uri($this->input->post('judul')),
                                    'isi_clients'=>$this->input->post('isi_clients'),
                                    'meta_title'=>$this->input->post('meta_title'),
                                    'meta_keywords'=>$this->input->post('meta_keywords'),
                                    'meta_description'=>$this->input->post('meta_description'),
                                    'price'=>clean_number($this->db->escape_str($this->input->post('price'))),
                                    //'lokasi'=>$this->input->post('lokasi'),
                                    //'tgl_mulai'=>tanggalindo($this->input->post('tgl_mulai'),"Y-m-d"),
                                    //'tgl_selesai'=>tanggalindo($this->input->post('tgl_selesai'),"Y-m-d"),
                                    //'jam_mulai'=>$this->input->post('jam_mulai'),
                                    //'hari'=>hari_ini(date('w')),
                                    'created_time'=>date('Y-m-d'),
                                    //'jam'=>date('H:i:s'),
                                    'clients_views'=>'0',
                                    //'id_tag'=>$tagsdata,
                                    'username'=>$this->session->username,
                                    'id_categories'=>$this->db->escape_str($this->input->post('id_kategorihasil')));
            }else{
                    $datadb = array('judul'=>$this->db->escape_str($this->input->post('judul')),
                                    'slug'=> $this->slug->create_uri($this->input->post('judul')),
                                    'meta_title'=>$this->input->post('meta_title'),
                                    'meta_keywords'=>$this->input->post('meta_keywords'),
                                    'meta_description'=>$this->input->post('meta_description'),
                                    'isi_clients'=>$this->input->post('isi_clients'),
                                    'price'=>clean_number($this->db->escape_str($this->input->post('price'))),
                                    //'lokasi'=>$this->input->post('lokasi'),
                                    
                                    //'tgl_mulai'=>tanggalindo($this->input->post('tgl_mulai'),"Y-m-d"),
                                    //'tgl_selesai'=>tanggalindo($this->input->post('tgl_selesai'),"Y-m-d"),
                                    //'jam_mulai'=>$this->input->post('jam_mulai'),
                                    //'hari'=>hari_ini(date('w')),
                                    'created_time'=>date('Y-m-d'),
                                    //'jam'=>date('H:i:s'),
                                    'clients_views'=>'0',
                                    //'id_tag'=>$tagsdata,
                                    'username'=>$this->session->username,
                                    'id_categories'=>$this->db->escape_str($this->input->post('id_kategorihasil')),
                                    'gambar'=>$hasil['file_name']);
                    
            }

        if ($this->db->insert('clients',$datadb)){
            //if(file_exists('../asset/foto_clients/'.$hasil['file_name'])){
                thumb('../asset/foto_clients/'.$hasil['file_name'],'400','200');
            //}
        }
        //fikar tag toxi
        //$ci=& get_instance();
        //$ci->load->model('Tags_model');
        $this->load->model('Tags_model','tags');
        $datpost = $this->get_clients_id($slugclients);
        $idpost = $datpost[0]['id_clients'];
        $tags = $this->db->escape_str($this->input->post('tagshasil'));
        $this->model_clients_tags->insert_clients_tagsdb($tags);
        $this->model_clients_tags->insert_clients_tagsmap($tags,$idpost,'clients');
        //print_r($datpost);
        //echo $idpost;
        //end tag toxi
    }

    function list_clients_edit($id){
        return $this->db->query("SELECT * FROM clients where id_clients='$id'");
    }

    function list_clients_update(){
        $config['upload_path'] = '../asset/foto_clients/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '3000'; // kb
        $new_name = substr(md5(uniqid(mt_rand())),0,10).'_'.time().'_'.$_FILES["gambar"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        $this->upload->do_upload('gambar');
        $hasil=$this->upload->data();
        //fikar
            $config = array(
                'field' => 'slug',
                'title' => 'judul',
                'table' => 'clients',
                'id' => 'id_clients',
            );
            $this->load->library('slug', $config);
            // create the slug
            //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
            //fikar z
            $page = $this->db->where('id_clients', $this->input->post('id'))->limit(1)->get('clients')->row();
            if ( $this->db->escape_str($this->input->post('judul')) != $page->judul ){
                //$slugku = $page->slug;
                $new_slug = true;
            }
            else{
                //$slugku = $this->slug->create_uri($this->input->post('a'));
                $new_slug = false;
            }

            if ($this->input->post('j')!=''){
                $tag_seo = $this->input->post('j');
                $tag=implode(',',$tag_seo);
            }else{
                $tag = '';
            }
            //fikar tags
            
            if (! empty($this->db->escape_str($this->input->post('tagshasil'))))
            {
                $strtags = $this->db->escape_str($this->input->post('tagshasil'));
                $arrtags = explode(",",$strtags);
                foreach ($arrtags as &$value)
                {
                    $value = $this->slug->create_uri(trim($value));
                    # code...
                }
                $tagsdata = implode(',',$arrtags);

            }
            else
            {
                $tagsdata = '';
            }
            $datadb = array();
            //end fikar tags
            if ($_FILES["gambar"]['name']==''){
                $imgupdate = false;
                $datadb = array(
                                //'id_kategori'=>$this->db->escape_str($this->input->post('id_kategorihasil')),
                                //'username'=>$this->db->escape_str($this->input->post('username')),
                                'judul'=>$this->db->escape_str($this->input->post('judul')),
                                //'judul_seo'=>seo_title($this->input->post('judul')),
                                //'headline'=>$this->db->escape_str($this->input->post('headline')),
                                'isi_clients'=>$this->input->post('isi_clients'),
                                'meta_title'=>$this->input->post('meta_title'),
                                'meta_keywords'=>$this->input->post('meta_keywords'),
                                'meta_description'=>$this->input->post('meta_description'),
                                'price'=>clean_number($this->db->escape_str($this->input->post('price'))),
                                //'lokasi'=>$this->input->post('lokasi'),
                                //'tgl_mulai'=>tanggalindo($this->input->post('tgl_mulai'),"Y-m-d"),
                                //'tgl_selesai'=>tanggalindo($this->input->post('tgl_selesai'),"Y-m-d"),
                                //'jam_mulai'=>$this->input->post('jam_mulai'),
                                //'hari'=>hari_ini(date('w')),
                                'created_time'=>date('Y-m-d'),
                                //'jam'=>date('H:i:s'),
                                'username'=>$this->session->username,
                                //'clients_views'=>'0',
                                //'id_tag'=>$this->db->escape_str($this->input->post('tagshasil')),
                                //'id_tag'=>$tagsdata,

                            );


            }else{
                $imgupdate = true;
                $datadb = array(
                                //'id_kategori'=>$this->db->escape_str($this->input->post('id_kategorihasil')),
                                //'username'=>$this->db->escape_str($this->input->post('username')),
                                'judul'=>$this->db->escape_str($this->input->post('judul')),
                                //'judul_seo'=>seo_title($this->input->post('judul')),
                                //'headline'=>$this->db->escape_str($this->input->post('headline')),
                                'isi_clients'=>$this->input->post('isi_clients'),
                                'meta_title'=>$this->input->post('meta_title'),
                                'meta_keywords'=>$this->input->post('meta_keywords'),
                                'meta_description'=>$this->input->post('meta_description'),
                                'price'=>clean_number($this->db->escape_str($this->input->post('price'))),
                                //'lokasi'=>$this->input->post('lokasi'),
                                //'tgl_mulai'=>tanggalindo($this->input->post('tgl_mulai'),"Y-m-d"),
                                //'tgl_selesai'=>tanggalindo($this->input->post('tgl_selesai'),"Y-m-d"),
                                //'jam_mulai'=>$this->input->post('jam_mulai'),
                                //'hari'=>hari_ini(date('w')),
                                'created_time'=>date('Y-m-d'),
                                //'jam'=>date('H:i:s'),
                                'username'=>$this->session->username,
                                'gambar'=>$hasil['file_name'],
                                //'clients_views'=>'0',
                                //'id_tag'=>$this->db->escape_str($this->input->post('tagshasil')),
                                //'id_tag'=>$tagsdata,


                            );

                getnameimg('../asset/foto_clients/'.$page->gambar,'foto_clients');
                //unlink('../asset/foto_clients/'.$page->gambar);
            }
            if (! empty($this->db->escape_str($this->input->post('id_kategorihasil')))) {
                # code...
                $datadb['id_categories'] = $this->db->escape_str($this->input->post('id_kategorihasil'));
            }
            if ($new_slug){
                $datadb['slug'] = $this->slug->create_uri($this->input->post('judul'));
            }
        $this->db->where('id_clients',$this->input->post('id'));
        
        if ($this->db->update('clients',$datadb)){
            if ($imgupdate == true){
                //if(file_exists('../asset/foto_clients/'.$hasil['file_name'])){
                    thumb('../asset/foto_clients/'.$hasil['file_name'],'400','200');
                //}
            }
        }
    }

    function list_clients_delete($id){
        $page = $this->db->where('id_clients', $id)->limit(1)->get('clients')->row();
        //print_r($page);
        getnameimg('../asset/foto_clients/'.$page->gambar,'foto_clients');
        return $this->db->query("DELETE FROM clients where id_clients='$id'");
    }


    function komentar(){
        return $this->db->query("SELECT * FROM komentar ORDER BY id_komentar DESC");
    }

    function komentar_edit($id){
        return $this->db->query("SELECT * FROM komentar where id_komentar='$id'");
    }

    function komentar_update(){
        $datadb = array('nama_komentar'=>$this->db->escape_str($this->input->post('a')),
                        'url'=>$this->db->escape_str($this->input->post('b')),
                        'isi_komentar'=>$this->input->post('c'),
                        'aktif'=>$this->input->post('d'));
        $this->db->where('id_komentar',$this->input->post('id'));
        $this->db->update('komentar',$datadb);
    }

    function komentar_delete($id){
        return $this->db->query("DELETE FROM komentar where id_komentar='$id'");
    }

    function update_clients($data = array()){
        // Check so incoming data is actually an array and not empty
        if (is_array($data) && ! empty($data))
        {
            // We already have a correctly formatted array from the controller,
            // so no need to do anything else here, just update.
            
            // Update rows in database
            $this->db->update_batch('clients', $data, 'id_clients');
        }
    }
}