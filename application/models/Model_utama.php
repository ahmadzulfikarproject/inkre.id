<?php
class Model_utama extends CI_model{
    function headline($dari, $jumlah){
        return $this->db->query("SELECT a.*, b.nama_kategori FROM berita a LEFT JOIN kategori b ON a.id_kategori=b.id_kategori where a.headline='Y' ORDER BY a.id_berita DESC LIMIT $dari, $jumlah");
    }

    function kategori($dari, $jumlah){
        return $this->db->query("SELECT * FROM kategori where aktif='Y' ORDER BY id_kategori ASC LIMIT $dari, $jumlah");
    }

    function berita_perkategori($id, $dari, $jumlah){
        return $this->db->query("SELECT a.*, b.nama_kategori FROM berita a LEFT JOIN kategori b ON a.id_kategori=b.id_kategori where a.id_kategori='$id' ORDER BY a.id_berita DESC LIMIT $dari, $jumlah");
    }

    function sekilasinfo(){
        return $this->db->query("SELECT * FROM sekilasinfo ORDER BY id_sekilas DESC LIMIT 5");
    }

    function mainmenu(){
        return $this->db->query("SELECT * FROM mainmenu where aktif='Y' ORDER BY arrange ASC");
    }

    function submenu($id){
        return $this->db->query("SELECT * FROM submenu WHERE id_main='$id' AND aktif='Y' ORDER BY id_sub ASC");
    }

    function submenu1($id){
        return $this->db->query("SELECT * FROM submenu WHERE id_submain='$id' AND id_submain!='0' AND aktif='Y' ORDER BY id_sub ASC");
    }

    function pengumuman($dari, $jumlah){
        return $this->db->query("SELECT * FROM sekilasinfo ORDER BY id_sekilas DESC LIMIT $dari, $jumlah");
    }

    function linkterkait($posisi, $dari, $jumlah){
        return $this->db->query("SELECT * FROM link_terkait where posisi='$posisi' ORDER BY id_link_terkait ASC LIMIT $dari, $jumlah");
    }

    function banner($dari, $jumlah){
        return $this->db->query("SELECT * FROM banner ORDER BY id_banner DESC LIMIT $dari, $jumlah");
    }

    function kunjungan(){
        $ip      = $_SERVER['REMOTE_ADDR'];
        $tanggal = date("Y-m-d");
        $waktu   = time();
        $cekk = $this->db->query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
        $rowh = $cekk->row_array();
        if($cekk->num_rows() == 0){
            $datadb = array('ip'=>$ip, 'tanggal'=>$tanggal, 'hits'=>'1', 'online'=>$waktu);
            $this->db->insert('statistik',$datadb);
        }else{
            $hitss = $rowh['hits'] + 1;
            $datadb = array('ip'=>$ip, 'tanggal'=>$tanggal, 'hits'=>$hitss, 'online'=>$waktu);
            $array = array('ip' => $ip, 'tanggal' => $tanggal);
            $this->db->where($array);
            $this->db->update('statistik',$datadb);
        }
    }

    function grafik_kunjungan(){
        return $this->db->query("SELECT count(*) as jumlah, tanggal FROM statistik GROUP BY tanggal ORDER BY tanggal DESC LIMIT 10");
    }

    function pengunjung(){
        return $this->db->query("SELECT * FROM statistik WHERE tanggal='".date("Y-m-d")."' GROUP BY ip");
    }

    function totalpengunjung(){
        return $this->db->query("SELECT COUNT(hits) as total FROM statistik");
    }

    function hits(){
        return $this->db->query("SELECT SUM(hits) as total FROM statistik WHERE tanggal='".date("Y-m-d")."' GROUP BY tanggal");
    }

    function totalhits(){
        return $this->db->query("SELECT SUM(hits) as total FROM statistik");
    }

    function pengunjungonline(){
        $bataswaktu       = time() - 300;
        return $this->db->query("SELECT * FROM statistik WHERE online > '$bataswaktu'");
    }

    function cek_poling(){
        return $this->db->query("SELECT * from modul where nama_modul='Poling' and publish='Y'");
    }

    function pertanyaan(){
        return $this->db->query("SELECT * FROM poling WHERE aktif='Y' and status='Pertanyaan'");
    }

    function jawaban(){
        return $this->db->query("SELECT * FROM poling WHERE aktif='Y' and status='Jawaban'");
    }

    function semua_berita($start, $limit){
        return $this->db->query("SELECT * FROM berita a JOIN users b on a.username=b.username ORDER BY id_berita DESC LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT $start,$limit");
    }
    function semua_products($start, $limit){
        return $this->db->query("SELECT * FROM products ORDER BY id_products DESC LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT $start,$limit");
    }
    function semua_sertifikat($start, $limit){
        return $this->db->query("SELECT * FROM sertifikat ORDER BY id_sertifikat DESC LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT $start,$limit");
    }
    function semua_products_categories($start, $limit,$cat_id,$sort='DESC'){
        $this->db->order_by('id_products', $sort);
        $query = $this->db->get_where('products',array('id_categories' => $cat_id), $start, $limit);
        return $query;
        //return $this->db->query("SELECT * FROM products where id_categories='$cat_id' LIMIT $start,$limit");
        //return $this->db->query("SELECT * FROM products where id_categories='$cat_id' ORDER BY id_products $sort LIMIT $start,$limit");

        //return $this->db->query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT $start,$limit");
    }
    function tags_berita_detail($post_id,$post_type='products'){
        //return $this->db->query("SELECT * FROM tag ORDER BY id_tag DESC");
        //$hasil = $this->db->query("SELECT t.slug FROM tagmap bt, products b, tags t WHERE bt.tags_id = t.tags_id AND b.id_products = '$post_id' GROUP BY t.tags_id");
        //$tagsdata = implode(',',$hasil);
        $hasil = $this->db->query("SELECT t.slug, t.tags_title
                                    FROM berita_tagmap bt, berita_tags t, $post_type b
                                    WHERE bt.id_berita = '$post_id'
                                    AND t.tags_id = bt.tags_id
                                    AND bt.post_type = '$post_type'
                                    GROUP BY t.tags_id");
        return $hasil;
    }
    function tags_products_detail($post_id,$post_type='products'){
        //return $this->db->query("SELECT * FROM tag ORDER BY id_tag DESC");
        //$hasil = $this->db->query("SELECT t.slug FROM tagmap bt, products b, tags t WHERE bt.tags_id = t.tags_id AND b.id_products = '$post_id' GROUP BY t.tags_id");
        //$tagsdata = implode(',',$hasil);
        $hasil = $this->db->query("SELECT t.slug, t.tags_title
                                    FROM ".$post_type."_tagmap bt, ".$post_type."_tags t, $post_type b
                                    WHERE bt.id_".$post_type." = '$post_id'
                                    AND t.tags_id = bt.tags_id
                                    AND bt.post_type = '$post_type'
                                    GROUP BY t.tags_id");
        return $hasil;
    }

    function feed_products_tags($post_type='products'){

        $hasil = $this->db->query('
            SELECT bt.tags_id, bt.post_type, t.* FROM tagmap bt, tags t
            WHERE bt.post_type="products" AND bt.tags_id=t.tags_id

            ');
        return $hasil;
    }

    function hitungberita(){
        return $this->db->query("SELECT * FROM berita a JOIN users b on a.username=b.username");
    }

    function semua_berita_cari($start, $limit, $kata){
        $pisah_kata = explode(" ",$kata);
        $jml_katakan = (integer)count($pisah_kata);
        $jml_kata = $jml_katakan-1;

        $cari = "SELECT * FROM berita WHERE " ;
            for ($i=0; $i<=$jml_kata; $i++){
              $cari .= "judul OR isi_berita LIKE '%$pisah_kata[$i]%'";
              if ($i < $jml_kata ){
                $cari .= " OR ";
              }
            }
        $cari .= " ORDER BY id_berita DESC LIMIT $start,$limit";

        return $this->db->query($cari);
    }

    function berita_detail($id){
        return $this->db->query("SELECT * FROM berita a LEFT JOIN users b ON a.username=b.username LEFT JOIN kategori c ON a.id_kategori=c.id_kategori where a.id_berita='".$this->db->escape_str($id)."' OR a.slug='".$this->db->escape_str($id)."'");
    }

    function berita_dibaca_update($id){
        return $this->db->query("UPDATE berita SET dibaca=dibaca+1 where id_berita='".$this->db->escape_str($id)."' OR slug='".$this->db->escape_str($id)."'");
    }
    function berita_update_count($id){
        return $this->db->query("UPDATE berita SET berita_views=berita_views+1 where slug='".$this->db->escape_str($id)."'");
    }
    function products_update_count($id){
        return $this->db->query("UPDATE products SET products_views=products_views+1 where slug='".$this->db->escape_str($id)."'");
    }
    function update_counter($slug) {
    // return current article views
        $this->db->where('slug', urldecode($slug));
        $this->db->select('berita_views');
        $count = $this->db->get('berita')->row();
    // then increase by one
        $this->db->where('slug', urldecode($slug));
        $this->db->set('berita_views', ($count->berita_views + 1), FALSE);
        $this->db->update('berita');
    }
    function detail_kategori($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM berita where id_kategori='".$this->db->escape_str($id)."' ORDER BY id_berita DESC LIMIT $dari,$sampai");
    }
    function detail_products_kategori($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM products where id_kategori='".$this->db->escape_str($id)."' ORDER BY id_products DESC LIMIT $dari,$sampai");
    }
    function detail_products_categories($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM products where id_categories='".$this->db->escape_str($id)."' ORDER BY id_products DESC LIMIT $dari,$sampai");
    }
    function detail_berita_categories($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM berita where id_categories='".$this->db->escape_str($id)."' ORDER BY id_berita DESC LIMIT $dari,$sampai");
    }
    function detail_products_tags($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM products where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_products DESC LIMIT $dari,$sampai");
    }



    function detail_berita_tags($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_berita DESC LIMIT $dari,$sampai");
    }
    function info_terkait($limit,$tag,$ids){
        $pisah_kata  = explode(",",$tag);
        $jml_katakan = (integer)count($pisah_kata);
        $jml_kata = $jml_katakan-1;
        $cari = "SELECT * FROM berita WHERE slug!='$ids' AND ";
                for ($i=0; $i<=$jml_kata; $i++){
                  $cari .= "tag LIKE '%$pisah_kata[$i]%'";
                  if ($i < $jml_kata ){
                    $cari .= " OR ";
                  }
                }
        $cari .= " ORDER BY id_berita DESC LIMIT $limit";
        return $this->db->query($cari);
    }

    function hitungberitakategori($kat){
        return $this->db->query("SELECT * FROM berita where id_kategori='".$this->db->escape_str($kat)."'");
    }
    function hitungproductskategori($kat){
        return $this->db->query("SELECT * FROM products where id_kategori='".$this->db->escape_str($kat)."'");
    }
    function hitungproductscategories($kat){
        return $this->db->query("SELECT * FROM products where id_categories='".$this->db->escape_str($kat)."'");
    }

    function hitungproductstags($kat){
        return $this->db->query("SELECT * FROM products where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
    }

    function hitungberitatags($kat){
        return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
    }
    //toxi tag
    function hitung_post_tags($post_type='berita', $tags_id){

        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
        $hasil = $this->db->query('SELECT b.*
                    FROM '.$post_type.'_tagmap bt, '.$post_type.' b, '.$post_type.'_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_berita
                    GROUP BY b.id_'.$post_type.'');
        return $hasil;
    }
    function detail_post_tags($post_type='berita',$tags_id,$dari,$sampai){
        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_berita DESC LIMIT $dari,$sampai");
        $hasil = $this->db->query('SELECT b.*
                    FROM '.$post_type.'_tagmap bt, '.$post_type.' b, '.$post_type.'_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_berita
                    GROUP BY b.id_'.$post_type.'');
        return $hasil;
    }
    //produk tags
    function get_hitung_products_tags($post_type='berita', $tags_id){

        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($kat)."%'");
        $hasil = $this->db->query('SELECT b.*
                    FROM products_tagmap bt, '.$post_type.' b, products_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_products
                    GROUP BY b.id_'.$post_type.'');
        return $hasil;
    }
    function get_detail_products_tags($post_type='berita',$tags_id,$dari,$sampai){
        //return $this->db->query("SELECT * FROM berita where id_tag LIKE '%".$this->db->escape_str($id)."%' ORDER BY id_berita DESC LIMIT $dari,$sampai");
        $hasil = $this->db->query('SELECT b.*
                    FROM products_tagmap bt, '.$post_type.' b, products_tags t
                    WHERE bt.tags_id = t.tags_id
                    AND t.tags_id = '.$tags_id.'
                    AND b.id_'.$post_type.' = bt.id_products
                    GROUP BY b.id_'.$post_type.'');
        return $hasil;
    }
    //products

    //toxi tag end
    //page
    function page($start, $limit){
        return $this->db->query("SELECT * FROM pages ORDER BY id_pages DESC LIMIT $start, $limit");
    }
    function hitungpage(){
        return $this->db->query("SELECT * FROM pages");
    }
    function page_detail($id){
        return $this->db->query("SELECT * FROM pages where slug='".$this->db->escape_str($id)."'");
    }
    //fikar
    function page_detailku($id){
        return $this->db->query("SELECT * FROM pages where  id_pages='".$this->db->escape_str($id)."'");
    }
    //schedules
    function schedules($start, $limit){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM schedules a JOIN users b ON a.username=b.username ORDER BY a.id_schedules DESC LIMIT $start, $limit");
    }

    function hitungschedules(){
        return $this->db->query("SELECT * FROM schedules");
    }

    function schedules_detail($id){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM schedules a JOIN users b ON a.username=b.username where a.slug='".$this->db->escape_str($id)."'");
    }
    //schedules
    function products($start, $limit){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM products a JOIN users b ON a.username=b.username ORDER BY a.id_products DESC LIMIT $start, $limit");
    }


    function hitungproducts(){
        return $this->db->query("SELECT * FROM products");
    }

    function products_detail($id){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM products a JOIN users b ON a.username=b.username where a.slug='".$this->db->escape_str($id)."'");
    }


    //fikar end
    function agenda($start, $limit){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM agenda a JOIN users b ON a.username=b.username ORDER BY a.id_agenda DESC LIMIT $start, $limit");
    }

    function hitungagenda(){
        return $this->db->query("SELECT * FROM agenda");
    }

    function agenda_detail($id){
        return $this->db->query("SELECT a.*, b.first_name, b.last_name FROM agenda a JOIN users b ON a.username=b.username where a.tema_seo='".$this->db->escape_str($id)."'");
    }

    function index($start,$limit){
        return $this->db->query("SELECT * FROM download ORDER BY id_download DESC LIMIT $start,$limit");
    }

    function updatehits($file){
        return $this->db->query("UPDATE download set hits=hits+1 where nama_file='".$this->db->escape_str($file)."'");
    }

    function hitungdownload(){
        return $this->db->query("SELECT * FROM download");
    }

    function album($start, $limit){
        return $this->db->query("SELECT * FROM album ORDER BY id_album DESC LIMIT $start, $limit");
    }

    function hitungalbum(){
        return $this->db->query("SELECT * FROM album");
    }

    function hitungfoto($album){
        return $this->db->query("SELECT * FROM gallery where id_album='$album'");
    }

    function gallery($id, $start, $limit){
        return $this->db->query("SELECT * FROM gallery where id_album='$id' ORDER BY id_gallery DESC LIMIT $start, $limit");
    }

    function kirim_Pesan(){
        $nama     = cetak($this->input->post('a'));
        $email    = cetak($this->input->post('b'));
        $subjek   = cetak($this->input->post('c'));
        $pesan    = cetak($this->input->post('d'));
            $datadb = array('nama'=>$nama,
                            'email'=>$email,
                            'subjek'=>$subjek,
                            'pesan'=>$pesan,
                            'tanggal'=>date('Y-m-d'));
        $this->db->insert('hubungi',$datadb);
    }

    function vote($pilihan){
        return $this->db->query("UPDATE poling SET rating=rating+1 WHERE id_poling='$pilihan'");
    }

    function jumlah_vote(){
        return $this->db->query("SELECT SUM(rating) as jml_vote FROM poling WHERE aktif='Y'");
    }

    function hasil_vote(){
        return $this->db->query("SELECT * FROM poling WHERE aktif='Y' and status='Jawaban'");
    }
    function allslide($start,$limit){
        return $this->db->query("SELECT * FROM slide ORDER BY id_slide DESC LIMIT $start,$limit");
    }
    function semuaclient($start,$limit){
        return $this->db->query("SELECT * FROM client ORDER BY id_client DESC LIMIT $start,$limit");
    }
    function featured_products(){
        $this->db->select('*');
        $this->db->from('products');
        //filter data by searched keywords
        $this->db->like('featured','on');
        $this->db->order_by('position','asc');
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array():array();
    }
    function backup_db(){
        $this->load->database();
        //$this->db->hostname;
        //$this->db->username;
        //$this->db->password;
        //$this->db->database;

        $dbhost = $this->db->hostname;
        $dbuser = $this->db->username;
        $dbpass = $this->db->password;
        $dbname = $this->db->database;
        $backup_file = $dbname ."-". date("d-m-Y-H-i-s") . '.gz';
        // Load the DB utility class
        $this->load->dbutil();
        $dbs = $this->dbutil->list_databases();
        if ($this->dbutil->database_exists($dbname))
        {
                // some code...
                echo $dbname;
                // // Backup your entire database and assign it to a variable
                $backup = $this->dbutil->backup();
        
                // // Load the file helper and write the file to your server
                $this->load->helper('file');
                $path = '../backup/';
                write_file($path.$backup_file, $backup);
        
                // // Load the download helper and send the file to your desktop
                $this->load->helper('download');
                force_download($backup_file, $backup);
        }
        

    }

}
