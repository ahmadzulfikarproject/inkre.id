<?php 
class Model_berita extends CI_model{

    function getberita($params = array()){
        $this->db->select('*');
        $this->db->from('berita');
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('judul',$params['search']['keywords']);
        }
        if(!empty($params['search']['kategori'])){
            $this->db->like('id_kategori',$params['search']['kategori']);
        }
        //related product
        if(!empty($params['berita_id'])){
            $this->db->where('id_berita !=', $params['berita_id']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            //$this->db->order_by('judul',$params['search']['sortBy']);
            $sortByparams = $params['search']['sortBy'];
            switch ($sortByparams) {
                // pilih type order
                case 'titleasc':
                    echo 'titleasc';
                    $name = 'judul';
                    $sortBy = 'asc';
                    break;
                case 'titledesc':
                    echo 'titledesc'; 
                    $name = 'judul';
                    $sortBy = 'desc';  
                    break;
                case 'dateasc':
                    echo 'dateasc'; 
                    $name = 'id_berita';
                    $sortBy = 'asc';  
                    break;
                case 'datedesc':
                    echo 'datedesc'; 
                    $name = 'id_berita';
                    $sortBy = 'desc';  
                    break;
                default:
                    echo 'default';
                    $name = 'id_berita';
                    $sortBy = 'desc';
                    break;
            }
            $this->db->order_by($name,$sortBy);
        }else{
            $this->db->order_by('id_berita','desc');
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
 
        $config['upload_path'] = '../asset/upload/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = '3000'; // kb
        //$new_name = $_FILES["filexl"]['name'];

        $this->load->library('upload', $config);
        //$this->upload->do_upload('c');
        //$hasil=$this->upload->data();
        //fikar
        $config = array(
            'field' => 'slug',
            'title' => 'judul',
            'table' => 'berita',
            'id' => 'id_berita',
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
                
                //$content  = $rowData[0][3].'<p><!-- pagebreak --></p>'.$rowData[0][4];
                $content  = $rowData[0][3];
                if ($rowData[0][4] != '') {
                    $content  .= '<p><!-- pagebreak --></p>';
                    $content  .= $rowData[0][4];
                };
                
                $ssrc = $rowData[0][19];
                $cutstring = "C:\\xampp\htdocs\pt-cmp.comr1\media\k2\items\src\\";

                if (strpos($ssrc, $cutstring) !== false){
                // car found
                    $ssrcimg = str_replace($cutstring,'',$ssrc);
                }
                else{
                    $ssrcimg = $ssrc;

                }
                $realpath = "../media/k2/items/src/".$ssrcimg;
                $targetpath = "../asset/foto_berita/".$ssrcimg;
                //upload gambar
                /*
                unset($config);
                //icon
                $config['upload_path'] = '../asset/foto_berita/';
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
                copy($realpath, $targetpath);
                $data = array(
                    //"id_berita"     => $rowData[0][0],
                    "username"      => 'admin',
                    "judul"         => $rowData[0][1],
                    "slug"          => $rowData[0][2],
                    "isi_berita"    => $content,
                    "gambar"        => $this->db->escape_str($ssrcimg),//$rowData[0][20],
                    "berita_views"  => $rowData[0][13],
                    //"meta_description"  => $rowData[0][23],
                    //"meta_keywords"  => $rowData[0][25],
                    //"id_kategori"   => $rowData[0][33],
                    "tanggal"          => \PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][11], 'd-m-Y H:i:s'),
                );
                unset($config);
                if ($this->db->insert("berita",$data)) {
                    # code...
                    $data['error'] = FALSE;
                }
            } 
            echo json_encode($data); 
            //echo "berahasil";
            //redirect('data');
            //=======

        }
        
        
        
    }
    function kategori_berita(){
        return $this->db->query("SELECT * FROM kategori ORDER BY id_kategori DESC");
    }

    function kategori_berita_tambah(){
        $datadb = array('nama_kategori'=>$this->db->escape_str($this->input->post('a')),
                        'kategori_seo'=>seo_title($this->input->post('a')),
                        'aktif'=>$this->db->escape_str($this->input->post('b')));
        $this->db->insert('kategori',$datadb);
    }

    function kategori_berita_edit($id){
        return $this->db->query("SELECT * FROM kategori where id_kategori='$id'");
    }

    function kategori_berita_update(){
        $datadb = array('nama_kategori'=>$this->db->escape_str($this->input->post('a')),
                        'kategori_seo'=>seo_title($this->input->post('a')),
                        'aktif'=>$this->db->escape_str($this->input->post('b')));
        $this->db->where('id_kategori',$this->input->post('id'));
        $this->db->update('kategori',$datadb);
    }

    function kategori_berita_delete($id){
        return $this->db->query("DELETE FROM kategori where id_kategori='$id'");
    }


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



    function tag_berita(){
        return $this->db->query("SELECT * FROM tag ORDER BY id_tag DESC");
    }
    //toxi tag
    function tags_berita($post_id){
        //return $this->db->query("SELECT * FROM tag ORDER BY id_tag DESC");
        //$hasil = $this->db->query("SELECT t.slug FROM tagmap bt, berita b, tags t WHERE bt.tags_id = t.tags_id AND b.id_berita = '$post_id' GROUP BY t.tags_id");
        //$tagsdata = implode(',',$hasil);
        $hasil = $this->db->query("SELECT t.slug
                                    FROM tagmap bt, tags t, berita b
                                    WHERE bt.id_berita = '$post_id'
                                    AND t.tags_id = bt.tags_id
                                    GROUP BY t.tags_id");
        return $hasil;
    }
    function get_berita_id($slug){
        return $this->db->query("SELECT * FROM berita where slug='$slug'")->result_array();
    }
    //toxi tag end
    function tag_berita_tambah(){
        $datadb = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
                        'tag_seo'=>seo_title($this->input->post('a')),
                        'count'=>'0');
        $this->db->insert('tag',$datadb);
    }

    function tag_berita_edit($id){
        return $this->db->query("SELECT * FROM tag where id_tag='$id'");
    }

    function tag_berita_update(){
        $datadb = array('nama_tag'=>$this->db->escape_str($this->input->post('a')),
                        'tag_seo'=>seo_title($this->input->post('a')));
        $this->db->where('id_tag',$this->input->post('id'));
        $this->db->update('tag',$datadb);
    }

    function tag_berita_delete($id){
        return $this->db->query("DELETE FROM tag where id_tag='$id'");
    }

    function komentar_berita($id_berita){
        return $this->db->query("SELECT * FROM komentar where id_berita = '$id_berita' AND aktif='Y'");
    }

    function kirim_komentar(){
        $datadb = array('id_berita'=>cetak($this->input->post('a')),
                                'nama_komentar'=>cetak($this->input->post('b')),
                                'url'=>cetak($this->input->post('c')),
                                'isi_komentar'=>cetak($this->input->post('d')),
                                'tgl'=>date('Y-m-d'),
                                'jam_komentar'=>date('H:i:s'),
                                'aktif'=>'N');
        $this->db->insert('komentar',$datadb);
    }

    function list_berita_rss(){
        return $this->db->query("SELECT a.*, b.nama_kategori FROM berita a LEFT JOIN kategori b ON a.id_kategori=b.id_kategori ORDER BY a.id_berita DESC LIMIT 10");
    }

    function list_berita_rss_tags(){
        return $this->db->query("SELECT * FROM tags ORDER BY tags_id DESC");
    }


    function list_berita(){
        return $this->db->query("SELECT a.*, b.nama_kategori FROM berita a LEFT JOIN kategori b ON a.id_kategori=b.id_kategori ORDER BY a.id_berita DESC");
    }
    //fikar
    function semua_beritaterbaru(){
        return $this->db->query("SELECT * FROM berita ORDER BY id_berita DESC ");
    }
    function update_beritaku($data = array()){
        // Check so incoming data is actually an array and not empty
        if (is_array($data) && ! empty($data))
        {
            // We already have a correctly formatted array from the controller,
            // so no need to do anything else here, just update.
            
            // Update rows in database
            $this->db->update_batch('berita', $data, 'id_berita');
        }
        /*
        $data = $this->db->query("SELECT * FROM berita ORDER BY id_berita DESC");
        foreach ($data->result_array() as $key => $value) {
            print_r($value);
            $data[$key]['site_id'] = $value['site_id'];
            # code...
        }
        */
       // return $this->db->query("SELECT * FROM berita ORDER BY id_berita DESC");
    }
    //=========
    
    function list_berita_tambah(){
            $config['upload_path'] = '../asset/foto_berita/';
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
                'table' => 'berita',
                'id' => 'id_berita',
            );
            $this->load->library('slug', $config);
            $slugberita = $this->slug->create_uri($this->input->post('judul'));
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
            if (! empty($this->input->post('id_kategorihasil'))) {
                # code...
                $datadb['id_kategori'] = $this->db->escape_str($this->input->post('id_kategorihasil'));
            }

            if ($_FILES["gambar"]['name']==''){
                    $datadb = array('judul'=>$this->db->escape_str($this->input->post('judul')),
                                    'slug'=> $this->slug->create_uri($this->input->post('judul')),
                                    'isi_berita'=>$this->input->post('isi_berita'),
                                    'headline'=>$this->db->escape_str($this->input->post('c')),
                                    'meta_title'=>$this->input->post('meta_title'),
                                    'meta_keywords'=>$this->input->post('meta_keywords'),
                                    'meta_description'=>$this->input->post('meta_description'),
                                    'hari'=>hari_ini(date('w')),
                                    //'tanggal'=>date("Y-m-d H:i:s"),//date('Y-m-d'),
                                    'jam'=>date('H:i:s'),
                                    'dibaca'=>'0',
                                    //'tag'=>$tag,
                                    //'id_tag'=>$tagsdata,
                                    'username'=>$this->db->escape_str($this->input->post('u')),
                                    //'id_kategori'=>$this->db->escape_str($this->input->post('id_kategorihasil'))
                                    //'id_kategori'=>$this->db->escape_str($this->input->post('id_kategorihasil'))

                                );
            }else{
                    $datadb = array('judul'=>$this->db->escape_str($this->input->post('judul')),
                                    'slug'=> $this->slug->create_uri($this->input->post('judul')),
                                    'meta_title'=>$this->input->post('meta_title'),
                                    'meta_keywords'=>$this->input->post('meta_keywords'),
                                    'meta_description'=>$this->input->post('meta_description'),
                                    'isi_berita'=>$this->input->post('isi_berita'),
                                    'headline'=>$this->db->escape_str($this->input->post('c')),
                                    'hari'=>hari_ini(date('w')),
                                    //'tanggal'=>date("Y-m-d H:i:s"), //date('Y-m-d'),
                                    'jam'=>date('H:i:s'),
                                    'dibaca'=>'0',
                                    //'tag'=>$tag,
                                    //'id_tag'=>$tagsdata,
                                    'username'=>$this->db->escape_str($this->input->post('u')),
                                    //'id_kategori'=>$this->db->escape_str($this->input->post('id_kategorihasil')),
                                    //'id_kategori'=>$this->db->escape_str($this->input->post('id_kategorihasil')),
                                    'gambar'=>$hasil['file_name']);
                    
            }
            if (! empty($this->db->escape_str($this->input->post('id_kategorihasil')))) {
                # code...
                $datadb['id_kategori'] = $this->db->escape_str($this->input->post('id_kategorihasil'));
            }
            if ($this->db->insert('berita',$datadb)){
                if(file_exists('../asset/foto_berita/'.$hasil['file_name'])){
                    thumb('../asset/foto_berita/'.$hasil['file_name'],'400','200');
                }
            }
            //fikar tag toxi
            //$ci=& get_instance();
            //$ci->load->model('Tags_model');
            //$this->load->model('Tags_model','tags');
            $datpost = $this->get_berita_id($slugberita);
            $idpost = $datpost[0]['id_berita'];
            $tags = $this->db->escape_str($this->input->post('tagshasil'));
            $this->tags_model->insert_tagsdb($tags);
            $this->tags_model->insert_tagsmap($tags,$idpost);
            //print_r($datpost);
            //echo $idpost;
            //end tag toxi

    }


    function list_berita_edit($id){
        return $this->db->query("SELECT * FROM berita where id_berita='$id'");
    }

    function list_berita_update(){
        $config['upload_path'] = '../asset/foto_berita/';
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
                'table' => 'berita',
                'id' => 'id_berita',
            );
            $this->load->library('slug', $config);
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

            $page = $this->db->where('id_berita', $this->input->post('id'))->limit(1)->get('berita')->row();
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
            $datadb = array();
            if ($_FILES["gambar"]['name']==''){
                $imgupdate = false;
                $datadb = array(
                                //'id_kategori'=>$this->db->escape_str($this->input->post('id_kategorihasil')),
                                'username'=>$this->db->escape_str($this->input->post('u')),
                                'judul'=>$this->db->escape_str($this->input->post('judul')),
                                //'slug'=> $this->slug->create_uri($this->input->post('judul')),
                                'headline'=>$this->db->escape_str($this->input->post('c')),
                                'isi_berita'=>$this->input->post('isi_berita'),
                                'meta_title'=>$this->input->post('meta_title'),
                                'meta_keywords'=>$this->input->post('meta_keywords'),
                                'meta_description'=>$this->input->post('meta_description'),
                                'hari'=>hari_ini(date('w')),
                                'tanggal'=>date('Y-m-d'),
                                'jam'=>date('H:i:s'),
                                //'dibaca'=>'0',
                                //'tag'=>$tag),
                                //'id_tag'=>$tagsdata
                            );
            }else{
                $imgupdate = true;
                $datadb = array(
                                //'id_kategori'=>$this->db->escape_str($this->input->post('id_kategorihasil')),
                                'username'=>$this->db->escape_str($this->input->post('u')),
                                'judul'=>$this->db->escape_str($this->input->post('judul')),
                                //'slug'=> $this->slug->create_uri($this->input->post('judul')),
                                'headline'=>$this->db->escape_str($this->input->post('c')),
                                'isi_berita'=>$this->input->post('isi_berita'),
                                'meta_title'=>$this->input->post('meta_title'),
                                'meta_keywords'=>$this->input->post('meta_keywords'),
                                'meta_description'=>$this->input->post('meta_description'),
                                'hari'=>hari_ini(date('w')),
                                'tanggal'=>date('Y-m-d'),
                                'jam'=>date('H:i:s'),
                                'gambar'=>$hasil['file_name'],
                                //'dibaca'=>'0',
                                //'tag'=>$tag)
                                //'id_tag'=>$tagsdata
                            );

                getnameimg('../asset/foto_berita/'.$page->gambar,'foto_berita');
                //unlink('../asset/foto_berita/'.$page->gambar);
            }
            if (! empty($this->db->escape_str($this->input->post('id_kategorihasil')))) {
                # code...
                $datadb['id_kategori'] = $this->db->escape_str($this->input->post('id_kategorihasil'));
            }
            if ($new_slug){
                $datadb['slug'] = $this->slug->create_uri($this->input->post('judul'));
            }
        $this->db->where('id_berita',$this->input->post('id'));
        
        if ($this->db->update('berita',$datadb)){
            if ($imgupdate == true){
                if(file_exists('../asset/foto_berita/'.$hasil['file_name'])){
                    thumb('../asset/foto_berita/'.$hasil['file_name'],'400','200');
                }
            }
        }
    }

    function list_berita_delete($id){
        return $this->db->query("DELETE FROM berita where id_berita='$id'");
    }
    function tagmap_berita_delete($id){
        return $this->db->query("DELETE FROM tagmap where id_berita='$id'");
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
}