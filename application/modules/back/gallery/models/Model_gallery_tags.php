<?php
class Model_gallery_tags extends CI_Model{

	function get_all_gallery_tags(){
		$result=$this->db->get('gallery_tags');
		return $result;
	}

	function search_gallery_tags($title){
		$this->db->like('tags_title', $title , 'both');
		$this->db->order_by('tags_title', 'ASC');
		$this->db->limit(10);
		return $this->db->get('gallery_tags')->result();
	}
	function insert_gallery_tagsdb($data){
        $str=$data;
		$arr=explode(",",$str);
		foreach ($arr as $key => $value) {
			if (! gallery_tags_in_database($this->slug->create_uri(trim($value)))) {
				# code...
				$datadb = array(
								'tags_title'=>trim($value),
                        		'slug'=>$this->slug->create_uri(trim($value)),
                        		//'created_at'=>CURRENT_TIMESTAMP
                        		
                        	);
                //print_r($datadb);
				//$this->tags_model->insert_tagsdb($datadb);
				$this->db->insert('gallery_tags',$datadb);
			}
			
			# code...

		}

        //$this->db->insert('tags',$data);
        //$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
    }

    function insert_gallery_tagsmap($data,$id,$type='gallery'){
    	if (!empty($data) && !empty($id) ) {
    		# code...
    		//$row1 = $this->db->query("SELECT nama_website FROM identitas")->row_array();
    		//$datpost = $this->db->query("SELECT * FROM gallery where slug='$id'")->row_array();
    		//print_r($datpost)
		    //$rowpost = $datpost->row();
		    	
		    //$post_id = $datpost['id_gallery']; //$rowpost->id_gallery;

    		
	        $str=$data;
			$arr=explode(",",$str);
			foreach ($arr as $key => $value) {
				$dat = $this->db->query("SELECT * FROM gallery_tags where slug='".$this->slug->create_uri(trim($value))."'");
		    	$row = $dat->row();

		    	
				$tags_id = $row->tags_id;
				$datatagmap = array(
									'tags_id'=>$tags_id,
	                        		'id_gallery'=>$id,
	                        		'post_type'=>$type
	                        		
	                        		
	                        	);
				$this->db->where($datatagmap);
				$q = $this->db->get('gallery_tagmap');

				if ( $q->num_rows() > 0 ) 
				{
				  $this->db->where('tags_id',$tags_id);
				  $this->db->update('gallery_tagmap',$datatagmap);
				  $this->db->query("DELETE FROM gallery_tagmap where tags_id!='$tags_id' and id_gallery='$id' and post_type='$type'");
				} else {
				  //$this->db->set('user_id', $id);
				  $this->db->insert('gallery_tagmap',$datatagmap);


				}

				//delete $this->db->query("DELETE FROM tagmap where tags_id!='$tags_id' and id_gallery='$id' and post_type='$type' ");

			
				
				# code...

			}
		}
		else{
			$this->db->query("DELETE FROM gallery_tagmap where tags_id!='$tags_id' and id_gallery='$id' and post_type='$type'");
		}
        //$this->db->insert('tags',$data);
        //$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
    }

    
}