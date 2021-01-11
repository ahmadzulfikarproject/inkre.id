<?php 
class Model_users extends CI_model{
    function cek_login($username,$password){
        return $this->db->query("SELECT * FROM users where username='".$this->db->escape_str($username)."' AND password='".$this->db->escape_str($password)."'");
        // bikin variabel session
        $this->session->set_userdata('nama', $this->db->escape_str($username));
        /*
        $_SESSION['namauser']    = $r['username'];
        $_SESSION['passuser']    = $r['password'];
        $_SESSION['namalengkap'] = $r['nama_lengkap'];
        $_SESSION['leveluser']   = $r['level'];
        */
    }
    
	function users(){
         if ($this->session->level == 'admin'){
        		return $this->db->query("SELECT * FROM users");
            }
            else{
                return $this->db->query("SELECT * FROM users where NOT level = 'admin'");
            }
	}

	function users_tambah(){
        $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                        'password'=>md5($this->input->post('b')),
                        'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                        'email'=>$this->db->escape_str($this->input->post('d')),
                        'no_telp'=>$this->db->escape_str($this->input->post('e')),
                        //'level'=>'user',
                        'blokir'=>'N',
                        'id_session'=>md5($this->input->post('a')));
        if ($this->session->level == 'admin'){
            $datadb['level'] = $this->db->escape_str($this->input->post('l'));
        }
        else{
            $datadb['level'] = 'user';
        }
        $this->db->insert('users',$datadb);
    }

    function users_edit($id){
        if ($this->session->level == 'admin'){
            return $this->db->query("SELECT * FROM users where username='$id'");
        }
        else {
            return $this->db->query("SELECT * FROM users where username='$id' AND NOT level = 'admin'");
        }
    }

    function users_update($id){
        $user = $this->db->query("SELECT * FROM users where username='$id'");
        //print_r($user);
        //usergambar
        $config['upload_path'] = '../asset/';
        $config['allowed_types'] = 'ico|gif|jpg|png|JPG|JPEG';
        $config['max_size'] = '20000'; // kb
        //$new_name = substr(md5(uniqid(mt_rand())),0,10).'_'.time().'_'.$_FILES["usergambar"]['name'];
        //$config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->do_upload('usergambar');
        $usergambar=$this->upload->data();

        unset($config);
        
        if (trim($this->input->post('b'))==''){
            $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                            'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                            'email'=>$this->db->escape_str($this->input->post('d')),
                            'no_telp'=>$this->db->escape_str($this->input->post('e')),
                            //'level'=>$this->db->escape_str($this->input->post('l')),
                            'blokir'=>$this->db->escape_str($this->input->post('h')),
                            'id_session'=>md5($this->input->post('a')));
            
            //$this->db->where('username',$this->input->post('id'));
            //$this->db->update('users',$datadb);
        }else{

            $datadb = array('username'=>$this->db->escape_str($this->input->post('a')),
                            'password'=>md5($this->input->post('b')),
                            'nama_lengkap'=>$this->db->escape_str($this->input->post('c')),
                            'email'=>$this->db->escape_str($this->input->post('d')),
                            'no_telp'=>$this->db->escape_str($this->input->post('e')),
                            //'level'=>$this->db->escape_str($this->input->post('l')),
                            'blokir'=>$this->db->escape_str($this->input->post('h')),
                            'id_session'=>md5($this->input->post('a')));
            

            //$this->db->where('username',$this->input->post('id'));
            //$this->db->update('users',$datadb);
        }
        if ($this->session->level == 'admin'){
            $datadb['level'] = $this->db->escape_str($this->input->post('l'));
        }
        if (! empty($usergambar['file_name'])){
            unlink('../asset/'.$user->usergambar);
            $datadb[usergambar] = $usergambar['file_name'];
        }
        $this->db->where('username',$this->input->post('id'));
        $this->db->update('users',$datadb);

    }

    function users_delete($id){
        if ($this->session->level == 'admin'){
            return $this->db->query("DELETE FROM users where username='$id'");
        }
        else{
            return $this->db->query("DELETE FROM users where username='$id' AND NOT level = 'admin'");
        }
    }

}