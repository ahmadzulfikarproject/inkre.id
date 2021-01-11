<?php
class Tags_model extends CI_Model{

	function get_all_tags(){
		$result=$this->db->get('tags');
		return $result;
	}

	function search_tags($title){
		$this->db->like('tags_title', $title , 'both');
		$this->db->order_by('tags_title', 'ASC');
		$this->db->limit(10);
		return $this->db->get('tags')->result();
	}
	function insert_tagsdb($data){
        $str=$data;
		$arr=explode(",",$str);
		foreach ($arr as $key => $value) {
			if (! tags_in_database($this->slug->create_uri(trim($value)))) {
				# code...
				$datadb = array(
								'tags_title'=>trim($value),
                        		'slug'=>$this->slug->create_uri(trim($value)),
                        		//'created_at'=>CURRENT_TIMESTAMP
                        		
                        	);
                //print_r($datadb);
				//$this->tags_model->insert_tagsdb($datadb);
				$this->db->insert('tags',$datadb);
			}
			
			# code...

		}

        //$this->db->insert('tags',$data);
        //$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
    }

    function insert_tagsmap($data,$id,$type='berita'){
    	if (!empty($data) && !empty($id) ) {
    		# code...
    		//$row1 = $this->db->query("SELECT nama_website FROM identitas")->row_array();
    		//$datpost = $this->db->query("SELECT * FROM berita where slug='$id'")->row_array();
    		//print_r($datpost)
		    //$rowpost = $datpost->row();
		    	
		    //$post_id = $datpost['id_berita']; //$rowpost->id_berita;

    		
	        $str=$data;
			$arr=explode(",",$str);
			foreach ($arr as $key => $value) {
				$dat = $this->db->query("SELECT * FROM tags where slug='".$this->slug->create_uri(trim($value))."'");
		    	$row = $dat->row();

		    	
				$tags_id = $row->tags_id;
				$datatagmap = array(
									'tags_id'=>$tags_id,
	                        		'id_berita'=>$id,
	                        		'post_type'=>$type
	                        		
	                        		
	                        	);
				$this->db->where($datatagmap);
				$q = $this->db->get('tagmap');

				if ( $q->num_rows() > 0 ) 
				{
				  $this->db->where('tags_id',$tags_id);
				  $this->db->update('tagmap',$datatagmap);
				  $this->db->query("DELETE FROM tagmap where tags_id!='$tags_id' and id_berita='$id' and post_type='$type'");
				} else {
				  //$this->db->set('user_id', $id);
				  $this->db->insert('tagmap',$datatagmap);


				}

				//delete $this->db->query("DELETE FROM tagmap where tags_id!='$tags_id' and id_berita='$id' and post_type='$type' ");

			
				
				# code...

			}
		}
		else{
			$this->db->query("DELETE FROM tagmap where tags_id!='$tags_id' and id_berita='$id' and post_type='$type'");
		}
        //$this->db->insert('tags',$data);
        //$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
    }

    function insert_tagsmap_new($data,$id){
    	if (!empty($data) && !empty($id) ) {
    		# code...
    		//$row1 = $this->db->query("SELECT nama_website FROM identitas")->row_array();
    		
		    //$rowpost = $datpost->row();
		    	
		    //$post_id = $datpost['id_berita']; //$rowpost->id_berita;

    		
	        $str=$data;
			$arr=explode(",",$str);
			foreach ($arr as $key => $value) {
				$dat = $this->db->query("SELECT * FROM tags where slug='".$this->slug->create_uri(trim($value))."'");
		    	$row = $dat->row();

		    	
				$tags_id = $row->tags_id;
				$datatagmap = array(
									'tags_id'=>$tags_id,
	                        		'id_berita'=>$id
	                        		
	                        		
	                        	);
				$this->db->where($datatagmap);
				$q = $this->db->get('tagmap');

				if ( $q->num_rows() > 0 ) 
				{
				  $this->db->where('tags_id',$tags_id);
				  $this->db->update('tagmap',$datatagmap);
				} else {
				  //$this->db->set('user_id', $id);
				  $this->db->insert('tagmap',$datatagmap);
				}

			
				
				# code...

			}
		}
        //$this->db->insert('tags',$data);
        //$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
    }

}