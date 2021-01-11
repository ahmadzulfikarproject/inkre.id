<?php
class Model_products_attachment extends CI_Model{
	function getRows_attachment($id = ''){
        $this->db->select('*');
        $this->db->from('attachment');
        if($id){
            $this->db->where('id_post',$id);
            $query = $this->db->get();
            $result = $query->result_array();
        }else{
            $this->db->order_by('uploaded_on','desc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result)?$result:false;
    }
    function list_products_attachment($id, $type='products'){
        $datalama = $this->getRows_attachment($this->input->post('id'));
        $folderimg = '../asset/foto_products/attachment/';
        //print_r($datalama);
        if ($datalama) {
            foreach ($datalama as $file) {
            	if (file_exists($folderimg.$file['file_name'])) {
    	            unlink($folderimg.$file['file_name']);
    	        }
            }
            $tables = array('attachment');
            $this->db->where('id_post', $this->input->post('id'));
            $this->db->delete($tables);
        }
        // If file upload form submitted
        if(!empty($_FILES['attachment']['name'])){
            $filesCount = count($_FILES['attachment']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES['attachment']['name'][$i];
                $_FILES['file']['type']     = $_FILES['attachment']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['attachment']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['attachment']['error'][$i];
                $_FILES['file']['size']     = $_FILES['attachment']['size'][$i];
                
                // File upload configuration
                $config['upload_path'] = '../asset/foto_products/attachment/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = '3000'; // kb
                //$new_name = substr(md5(uniqid(mt_rand())),0,10).'_'.time().'_'.$_FILES["file"]['name'];
                //$config['file_name'] = $new_name;
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }
                
                
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                // Upload file to server
                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $fileData = $this->upload->data();
           
                    $uploadData[$i]['id_post'] = $this->input->post('id');
                    $uploadData[$i]['post_type'] = $type;
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                }
            }
            
            if(!empty($uploadData)){
                //print_r($uploadData);
               // echo implode(",",$uploadData);
                // Insert files data into the database
                
                $insert = $this->insert_attachment_db($uploadData);
                
                // Upload status message
                $statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
                $this->session->set_flashdata('statusMsg',$statusMsg);
                
            }
        }
        
        
        
    }
    function insert_attachment_db($data = array()){
        $insert = $this->db->insert_batch('attachment',$data);
        return $insert?true:false;
    }


}