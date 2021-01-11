<?php 
class Model_users extends CI_model{
    function users(){
        return $this->db->query("SELECT * FROM users ORDER BY username DESC");
    }
 
    function users_tambah(){
            $config['upload_path'] = '../asset/foto_statis/';
            $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
            $config['max_size'] = '20000'; // kb
            $new_name = substr(md5(uniqid(mt_rand())),0,10).'_'.time().'_'.$_FILES["c"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->do_upload('c');
            $hasil=$this->upload->data();
            //fikar
            $config = array(
                'field' => 'username',
                'title' => 'nama_lengkap',
                'table' => 'users',
                'id' => 'username',
            );
            $this->load->library('slug', $config);
            // create the username
            //$datadb['url_title'] = $this->username->create_uri($post_data['title']);
            //fikar z
            if ($hasil['file_name']==''){
                    $datadb = array('nama_lengkap'=>$this->db->escape_str($this->input->post('a')),
                                    'username'=> $this->username->create_uri($this->input->post('a')));
                                    //'isi_users'=>$this->input->post('b'),
                                    //'meta_title'=>$this->input->post('meta_title'),
                                    //'meta_keywords'=>$this->input->post('meta_keywords'),
                                    //'meta_description'=>$this->input->post('meta_description'));
                                    //'tgl_posting'=>date('Y-m-d'));
            }else{
            		$datadb = array('nama_lengkap'=>$this->db->escape_str($this->input->post('a')),
                                    'username'=> $this->username->create_uri($this->input->post('a')),
                                    //'meta_title'=>$this->input->post('meta_title'),
                                    //'meta_keywords'=>$this->input->post('meta_keywords'),
                                    //'meta_description'=>$this->input->post('meta_description'),
                                    //'isi_users'=>$this->input->post('b'),
                                    //'tgl_posting'=>date('Y-m-d'),
                                    'usergambar'=>$hasil['file_name']);
                    
            }

        if ($this->db->insert('users',$datadb)){
            if(file_exists('../asset/foto_statis/'.$hasil['file_name'])){
                thumb('../asset/foto_statis/'.$hasil['file_name'],'400','200');
            }
        }
    }

    function users_edit($id){
        return $this->db->query("SELECT * FROM users where username='$id'");
    }

    function users_update(){
        $config['upload_path'] = '../asset/foto_statis/';
        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '20000'; // kb
        //$nmfile = "file_".time();
        //$config['file_name'] = $nmfile; //nama yang terupload nantinya
        //$filename = md5(uniqid(mt_rand())).$this->file_ext;
        $new_name = substr(md5(uniqid(mt_rand())),0,10).'_'.time().'_'.$_FILES["c"]['name'];
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);

        $this->upload->do_upload('c');
        $hasil=$this->upload->data();
        //fikar
            $config = array(
                'field' => 'username',
                'title' => 'nama_lengkap',
                'table' => 'users',
                'id' => 'username',
            );
            $this->load->library('slug', $config);
            // create the username
            //$datadb['url_title'] = $this->username->create_uri($post_data['title']);
            //fikar z
        $page = $this->db->where('username', $this->input->post('id'))->limit(1)->get('users')->row();
        if ( $this->db->escape_str($this->input->post('a')) != $page->nama_lengkap ){
            //$usernameku = $page->username;
            $new_username = true;
        }
        else{
            //$usernameku = $this->username->create_uri($this->input->post('a'));
            $new_username = false;
        }
        if ($_FILES["c"]['name']==''){
                    $imgupdate = false;
                    $datadb = array('nama_lengkap'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>md5($this->input->post('x')));
                                    //'username'=> $this->username->create_uri($this->input->post('a')),
                                    //'username'=> $usernameku,
                                    //'isi_users'=>$this->input->post('b'),
                                    //'meta_title'=>$this->input->post('meta_title'),
                                    //'meta_keywords'=>$this->input->post('meta_keywords'),
                                    //'meta_description'=>$this->input->post('meta_description'));
                                    //'tgl_posting'=>date('Y-m-d'));
        }else{
                    $imgupdate = true;
                    $datadb = array('nama_lengkap'=>$this->db->escape_str($this->input->post('a')),
                                    'password'=>md5($this->input->post('x')),
                                    //'username'=> $this->username->create_uri($this->input->post('a')),
                                    //'username'=> $usernameku,
                                    //'isi_users'=>$this->input->post('b'),
                                    //'meta_title'=>$this->input->post('meta_title'),
                                    //'meta_keywords'=>$this->input->post('meta_keywords'),
                                    //'meta_description'=>$this->input->post('meta_description'),
                                    //'tgl_posting'=>date('Y-m-d'),
                                    'usergambar'=>$hasil['file_name']);
                    //$page = $this->db->where('username', $this->input->post('id'))->limit(1)->get('users')->row();
                    //unlink('../asset/foto_statis/'.$page->usergambar);
                    getnameimg('../asset/foto_statis/'.$page->usergambar,'foto_statis');



        }
        if ($new_username){
            $datadb['username'] = $this->username->create_uri($this->input->post('a'));
        }
        
        $this->db->where('username',$this->input->post('id'));
        if ($this->db->update('users',$datadb)){
            if ($imgupdate == true){
                if(file_exists('../asset/foto_statis/'.$hasil['file_name'])){
                    thumb('../asset/foto_statis/'.$hasil['file_name'],'400','200');
                }
            }
            
        }

    }

    function users_delete($id){
        //$data['rows'] = $this->model_users->users_edit($id)->row_array();
        $page = $this->db->where('username', $id)->limit(1)->get('users')->row();
        //print_r($page);
        getnameimg('../asset/foto_statis/'.$page->usergambar,'foto_statis');
        //unlink('../asset/foto_statis/'.$page->usergambar);
        return $this->db->query("DELETE FROM users where username='$id'");
    }
    function list_users_rss(){
        return $this->db->query("SELECT * FROM users ORDER BY username DESC LIMIT 10");
    }
}