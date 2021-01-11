<?php
class Enquiry_model extends CI_Model{

	 function getenquiry($params = array()){
        $this->db->select('*');
        $this->db->from('enquiry');
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('name',$params['search']['keywords']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('name',$params['search']['sortBy']);
        }else{
            $this->db->order_by('id','desc');
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

    function insert_enquiry($data){
        //$this->db->truncate('enquiry');
        //return $this->db->query("SELECT * FROM halamanstatis where id_halaman='$id'");
        //$this->db->insert('enquiry',$data);
        //$this->db->insert($this->table, $data);
		if ($this->db->insert('enquiry',$data)){
            //echo "berhasil";
            if ($this->db->affected_rows())
            {
                //$this->session->set_flashdata('success', 'berhasil terkirim !');
                if ($this->email_enquiry($data)){
                    return TRUE;
                }
                else{
                    return FALSE;
                }
            }
            else
            {
                //$this->session->set_flashdata('error', 'pesan gagal terkirim !');
                return FALSE;
            }
        }
    }
    function email_enquiry($data){
        // $nama           = $this->db->escape_str($data['name']);
        $emailku        = contactwebsite('email');
        $from           = $data['name'];
        $subject         = $data['subjek'];
        $message         = $this->db->escape_str($data['name']).' - '.$data['phone']." <br><hr><br> ".$data['message'];

        //$rows = $this->model_users->users_edit($this->session->username)->row_array();
        //$iden = $this->model_identitas->identitas()->row_array();
        $this->email->from($from, 'via website '.contactwebsite('nama'));
        $this->email->to($emailku);
        $this->email->cc('');
        $this->email->bcc('');

        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_mailtype("html");
        // $this->email->send();
        
        if (! $this->email->send())
        {
            return FALSE;
        }else{
            return TRUE;
        }
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

    }
    //import data xls
    function importdata(){
        $config['upload_path'] = '../asset/upload/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['max_size'] = '3000'; // kb
        $new_name = $_FILES["filexl"]['name'];

        $this->load->library('upload', $config);
        //$this->upload->do_upload('c');
        //$hasil=$this->upload->data();
        //fikar
        $config = array(
            'field' => 'slug',
            'title' => 'judul',
            'table' => 'client',
            'id' => 'id_client',
        );
        $this->load->library('slug', $config);
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        
        if (!$this->upload->do_upload('filexl')) {
            $error = array('error' => $this->upload->display_errors());
            echo $error['error'];
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

            for ($row = 4; $row <= $highestRow; $row++){  
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
                $data = array(
                    //"No"=> $rowData[0][0],
                    "name"      => $rowData[0][1],
                    "email"     => $rowData[0][2],
                    "phone"     => $rowData[0][3],
                    "subjek"    => $rowData[0][4],
                    "message"   => $rowData[0][5],
                    "date"      => \PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][6], 'DD/MM/YYYY'),
                );
                $this->db->insert("enquiry",$data);
            } 
            $this->session->set_flashdata('sukses','Berhasil upload ...!!'); 
            echo "berahasil";
            //redirect('data');
            //=======

        }
    }
    function importdataajax($file){
 
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
            'table' => 'client',
            'id' => 'id_client',
        );
        $this->load->library('slug', $config);
        // create the slug
        //$datadb['url_title'] = $this->slug->create_uri($post_data['title']);
        $this->upload->do_upload('file');
        /*
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

            for ($row = 4; $row <= $highestRow; $row++){  
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
                $data = array(
                    //"No"=> $rowData[0][0],
                    "name"      => $rowData[0][1],
                    "email"     => $rowData[0][2],
                    "phone"     => $rowData[0][3],
                    "subjek"    => $rowData[0][4],
                    "message"   => $rowData[0][5],
                    "date"      => \PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][6], 'DD/MM/YYYY'),
                );
                if ($this->db->insert("enquiry",$data)) {
                    # code...
                    $data['error'] = FALSE;
                }
            } 
            $this->session->set_flashdata('sukses','Berhasil upload ...!!');
            echo json_encode($data); 
            //echo "berahasil";
            //redirect('data');
            //=======

        }
        */
        
        
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
            'table' => 'client',
            'id' => 'id_client',
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

            for ($row = 4; $row <= $highestRow; $row++){  
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
                $data = array(
                    //"No"=> $rowData[0][0],
                    "name"      => $rowData[0][1],
                    "email"     => $rowData[0][2],
                    "phone"     => $rowData[0][3],
                    "subjek"    => $rowData[0][4],
                    "message"   => $rowData[0][5],
                    "date"      => \PHPExcel_Style_NumberFormat::toFormattedString($rowData[0][6], 'DD/MM/YYYY'),
                );
                if ($this->db->insert("enquiry",$data)) {
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

}