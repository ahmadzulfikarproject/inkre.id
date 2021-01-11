<?php
class Model_products_tags extends CI_Model{

	function get_all_products_tags(){
		$result=$this->db->get('products_tags');
		return $result;
	}

	function search_products_tags($title){
		$this->db->like('tags_title', $title , 'both');
		$this->db->order_by('tags_title', 'ASC');
		$this->db->limit(10);
		return $this->db->get('products_tags')->result();
	}
	function insert_products_tagsdb($data){
        $str=$data;
		$arr=explode(",",$str);
		foreach ($arr as $key => $value) {
			if (! products_tags_in_database($this->slug->create_uri(trim($value)))) {
				# code...
				$datadb = array(
								'tags_title'=>trim($value),
                        		'slug'=>$this->slug->create_uri(trim($value)),
                        		//'created_at'=>CURRENT_TIMESTAMP
                        		
                        	);
                //print_r($datadb);
				//$this->tags_model->insert_tagsdb($datadb);
				$this->db->insert('products_tags',$datadb);
			}
			
			# code...

		}

        //$this->db->insert('tags',$data);
        //$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
    }

    function insert_products_tagsmap($data,$id,$type='products'){
    	if (!empty($data) && !empty($id) ) {
    		# code...
    		//$row1 = $this->db->query("SELECT nama_website FROM identitas")->row_array();
    		//$datpost = $this->db->query("SELECT * FROM products where slug='$id'")->row_array();
    		//print_r($datpost)
		    //$rowpost = $datpost->row();
		    	
		    //$post_id = $datpost['id_products']; //$rowpost->id_products;

    		
	        $str=$data;
			$arr=explode(",",$str);
			foreach ($arr as $key => $value) {
				$dat = $this->db->query("SELECT * FROM products_tags where slug='".$this->slug->create_uri(trim($value))."'");
		    	$row = $dat->row();

		    	
				$tags_id = $row->tags_id;
				$datatagmap = array(
									'tags_id'=>$tags_id,
	                        		'id_products'=>$id,
	                        		'post_type'=>$type
	                        		
	                        		
	                        	);
				$this->db->where($datatagmap);
				$q = $this->db->get('products_tagmap');

				if ( $q->num_rows() > 0 ) 
				{
				  $this->db->where('tags_id',$tags_id);
				  $this->db->update('products_tagmap',$datatagmap);
				  $this->db->query("DELETE FROM products_tagmap where tags_id!='$tags_id' and id_products='$id' and post_type='$type'");
				} else {
				  //$this->db->set('user_id', $id);
				  $this->db->insert('products_tagmap',$datatagmap);


				}

				//delete $this->db->query("DELETE FROM tagmap where tags_id!='$tags_id' and id_products='$id' and post_type='$type' ");

			
				
				# code...

			}
		}
		else{
			$this->db->query("DELETE FROM products_tagmap where tags_id!='$tags_id' and id_products='$id' and post_type='$type'");
		}
        //$this->db->insert('tags',$data);
        //$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
    }

    
}