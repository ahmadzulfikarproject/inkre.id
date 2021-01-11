<?php
class Model_sertifikat_tags extends CI_Model{

	function get_all_sertifikat_tags(){
		$result=$this->db->get('sertifikat_tags');
		return $result;
	}

	function search_sertifikat_tags($title){
		$this->db->like('tags_title', $title , 'both');
		$this->db->order_by('tags_title', 'ASC');
		$this->db->limit(10);
		return $this->db->get('sertifikat_tags')->result();
	}
	function insert_sertifikat_tagsdb($data){
        $str=$data;
		$arr=explode(",",$str);
		foreach ($arr as $key => $value) {
			if (! sertifikat_tags_in_database($this->slug->create_uri(trim($value)))) {
				# code...
				$datadb = array(
								'tags_title'=>trim($value),
                        		'slug'=>$this->slug->create_uri(trim($value)),
                        		//'created_at'=>CURRENT_TIMESTAMP
                        		
                        	);
                //print_r($datadb);
				//$this->tags_model->insert_tagsdb($datadb);
				$this->db->insert('sertifikat_tags',$datadb);
			}
			
			# code...

		}

        //$this->db->insert('tags',$data);
        //$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
    }

    function insert_sertifikat_tagsmap($data,$id,$type='sertifikat'){
    	if (!empty($data) && !empty($id) ) {
    		# code...
    		//$row1 = $this->db->query("SELECT nama_website FROM identitas")->row_array();
    		//$datpost = $this->db->query("SELECT * FROM sertifikat where slug='$id'")->row_array();
    		//print_r($datpost)
		    //$rowpost = $datpost->row();
		    	
		    //$post_id = $datpost['id_sertifikat']; //$rowpost->id_sertifikat;

    		
	        $str=$data;
			$arr=explode(",",$str);
			foreach ($arr as $key => $value) {
				$dat = $this->db->query("SELECT * FROM sertifikat_tags where slug='".$this->slug->create_uri(trim($value))."'");
		    	$row = $dat->row();

		    	
				$tags_id = $row->tags_id;
				$datatagmap = array(
									'tags_id'=>$tags_id,
	                        		'id_sertifikat'=>$id,
	                        		'post_type'=>$type
	                        		
	                        		
	                        	);
				$this->db->where($datatagmap);
				$q = $this->db->get('sertifikat_tagmap');

				if ( $q->num_rows() > 0 ) 
				{
				  $this->db->where('tags_id',$tags_id);
				  $this->db->update('sertifikat_tagmap',$datatagmap);
				  $this->db->query("DELETE FROM sertifikat_tagmap where tags_id!='$tags_id' and id_sertifikat='$id' and post_type='$type'");
				} else {
				  //$this->db->set('user_id', $id);
				  $this->db->insert('sertifikat_tagmap',$datatagmap);


				}

				//delete $this->db->query("DELETE FROM tagmap where tags_id!='$tags_id' and id_sertifikat='$id' and post_type='$type' ");

			
				
				# code...

			}
		}
		else{
			$this->db->query("DELETE FROM sertifikat_tagmap where tags_id!='$tags_id' and id_sertifikat='$id' and post_type='$type'");
		}
        //$this->db->insert('tags',$data);
        //$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
    }

    
}