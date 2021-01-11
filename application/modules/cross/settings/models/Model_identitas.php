<?php 
class Model_identitas extends CI_model{
    function identitas(){
        //$identitas = $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row(1);
            //print_r($identitas);
       // echo $identitas->favicon;
        return $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1");
    }

    function identitas_update(){
            $identitas = $this->db->query("SELECT * FROM identitas ORDER BY id_identitas DESC LIMIT 1")->row(1);
            //print_r($identitas);
            $config['upload_path'] = '../asset/';
            $config['allowed_types'] = 'ico|gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '20'; // kb

            $this->load->library('upload', $config);
            $this->upload->do_upload('i');
            $hasil=$this->upload->data();
            unset($config);
            //icon
            $config['upload_path'] = '../asset/';
            $config['allowed_types'] = 'ico|gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '20000'; // kb
            //$new_name = substr(md5(uniqid(mt_rand())),0,10).'_'.time().'_'.$_FILES["icon"]['name'];
            //$config['file_name'] = $new_name;
            //$this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('icon');
            $icon=$this->upload->data();

            unset($config);
            //logo
            $config['upload_path'] = '../asset/';
            $config['allowed_types'] = 'ico|gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '20000'; // kb
            //$new_name = substr(md5(uniqid(mt_rand())),0,10).'_'.time().'_'.$_FILES["logo"]['name'];
            //$config['file_name'] = $new_name;
            //$this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('logo');
            $logo=$this->upload->data();

            unset($config);
            //img_profil
            $config['upload_path'] = '../asset/';
            $config['allowed_types'] = 'ico|gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '20000'; // kb
            //$new_name = substr(md5(uniqid(mt_rand())),0,10).'_'.time().'_'.$_FILES["logo"]['name'];
            //$config['file_name'] = $new_name;
            //$this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('img_profil');
            $img_profil=$this->upload->data();

            unset($config);
            //header
            $config['upload_path'] = '../asset/';
            $config['allowed_types'] = 'ico|gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '20000'; // kb
            //$new_name = substr(md5(uniqid(mt_rand())),0,10).'_'.time().'_'.$_FILES["logo"]['name'];
            //$config['file_name'] = $new_name;
            //$this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('header');
            $header=$this->upload->data();
            //thumb(webconfig('asset').'/'.$header['file_name'],'400','200');
            unset($config);
            //headerlogo
             //header
            $config['upload_path'] = '../asset/';
            $config['allowed_types'] = 'ico|gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '20000'; // kb
            //$new_name = substr(md5(uniqid(mt_rand())),0,10).'_'.time().'_'.$_FILES["logo"]['name'];
            //$config['file_name'] = $new_name;
            //$this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('headerlogo');
            $headerlogo=$this->upload->data();
            //unset($config);
            
            if ($hasil['file_name']==''){
                    $imgupdate = false;
                    $datadb = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                                    'alamat_website'=>$this->db->escape_str($this->input->post('c')),
                                    'meta_deskripsi'=>$this->db->escape_str($this->input->post('g')),
                                    'meta_keyword'=>$this->db->escape_str($this->input->post('h')));
            }else{
                    $imgupdate = true;
                    unlink('../asset/'.$identitas->favicon);

                    $datadb = array('nama_website'=>$this->db->escape_str($this->input->post('a')),
                                    'alamat_website'=>$this->db->escape_str($this->input->post('c')),
                                    'meta_deskripsi'=>$this->db->escape_str($this->input->post('g')),
                                    'meta_keyword'=>$this->db->escape_str($this->input->post('h')),
                                    'favicon'=>$hasil['file_name']);
                                    //'logo'=>$logo['file_name']);
            }
            $datadb['meta_title'] = $this->db->escape_str($this->input->post('meta_title'));
            if (! empty($icon['file_name'])){
                unlink('../asset/'.$identitas->icon);
                $datadb[icon] = $icon['file_name'];
            }
            if (! empty($logo['file_name'])){
                unlink('../asset/'.$identitas->logo);
                $datadb[logo] = $logo['file_name'];
            }
            if (! empty($header['file_name'])) {
                unlink('../asset/'.$identitas->header);
                $datadb[header] = $header['file_name'];
            }
            if (! empty($headerlogo['file_name'])) {
                unlink('../asset/'.$identitas->headerlogo);
                $datadb[headerlogo] = $headerlogo['file_name'];
            }
            if (! empty($img_profil['file_name'])) {
                unlink('../asset/'.$identitas->img_profil);
                $datadb[img_profil] = $img_profil['file_name'];
            }
            
            
            $this->db->where('id_identitas',1);
            $this->db->update('identitas',$datadb);
    }
}