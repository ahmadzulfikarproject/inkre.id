<?php 
class Model_hubungi extends CI_model{
    function pesan_masuk(){
        return $this->db->query("SELECT * FROM hubungi ORDER BY id_hubungi DESC");
    }

    function pesan_baru($limit){
        return $this->db->query("SELECT * FROM hubungi ORDER BY id_hubungi DESC LIMIT $limit");
    }
    function hapus_pesan($id){
        //return $this->db->query("SELECT * FROM hubungi ORDER BY id_hubungi DESC LIMIT $limit");
        //if ($this->session->level == 'admin'){
            return $this->db->query("DELETE FROM hubungi where id_hubungi='$id'");
        //}
        
    }
    function pesan_masuk_view($id){
        return $this->db->query("SELECT * FROM hubungi where id_hubungi='$id'");
    }

    function pesan_masuk_kirim(){
        $nama           = $this->input->post('a');
        $email           = $this->input->post('b');
        $subject         = $this->input->post('c');
        $message         = $this->input->post('isi')." <br><hr><br> ".$this->input->post('d');

        $rows = $this->model_users->users_edit($this->session->username)->row_array();
        $iden = $this->model_identitas->identitas()->row_array();
        $this->email->from($rows['email'], $iden['nama_website']);
        $this->email->to($email);
        $this->email->cc('');
        $this->email->bcc('');

        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_mailtype("html");
        $this->email->send();
        
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

    }

    function kirim_Pesan(){
        $nama           = $this->input->post('a');
        $email           = $this->input->post('b');
        $subjek         = $this->input->post('c');
        $pesan         = $this->input->post('d');
            $datadb = array('nama'=>$nama,
                            'email'=>$email,
                            'subjek'=>$subjek,
                            'pesan'=>$pesan,
                            'tanggal'=>date('Y-m-d'));
        $this->db->insert('hubungi',$datadb);
    }
    function getcontact(){
        return $this->db->query("SELECT * FROM pages ORDER BY id_pages DESC");
    }
}