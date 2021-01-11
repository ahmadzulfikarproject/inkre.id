<?php
class Categories_model extends CI_Model{

	function get_all_categories(){
		$result=$this->db->get('categories_lists');
		return $result;
	}

	function search_categories($title){
		$this->db->like('categories_title', $title , 'both');
		$this->db->order_by('categories_title', 'ASC');
		$this->db->limit(10);
		return $this->db->get('categories_lists')->result();
	}
	function insert_categoriesdb($data){
        $str=$data;
		$arr=explode(",",$str);
		foreach ($arr as $key => $value) {
			if (! categories_in_database($this->slug->create_uri(trim($value)))) {
				# code...
				$datadb = array(
								'name'=>trim($value),
                        		'slug'=>$this->slug->create_uri(trim($value)),
                        		'group_id'=>5,
                        		
                        		//'created_at'=>CURRENT_TIMESTAMP
                        		
                        	);
                //print_r($datadb);
				//$this->categories_model->insert_categoriesdb($datadb);
				$this->db->insert('categories_lists',$datadb);
			}
			
			# code...

		}

        //$this->db->insert('categories',$data);
        //$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
    }

    function insert_categoriesmap($data,$id=1,$type='products'){
    	
    	if (!empty($data) && !empty($id) ) {
    		# code...
    		//$row1 = $this->db->query("SELECT nama_website FROM identitas")->row_array();
    		//$datpost = $this->db->query("SELECT * FROM post where slug='$id'")->row_array();
    		//print_r($datpost)
		    //$rowpost = $datpost->row();
		    	
		    //$post_id = $datpost['id_post']; //$rowpost->id_post;
    		
    		
	        $str=$data;
			$arr=explode(",",$str);
			//print_r($arr);
			foreach ($arr as $key => $value) {
				//$dat = $this->db->query("SELECT * FROM categories_lists where slug='".$this->slug->create_uri(trim($value))."'");
				$slugku = $this->slug->create_uri(trim($value));
				//echo $slugku;
				$dat = $this->db->query("SELECT * FROM categories_lists where slug='".$this->slug->create_uri(trim($value))."'");
		    	//echo $this->slug->create_uri(trim($value));
		    	$row = $dat->row();
		    	//print_r($row);
		    	
				//$categories_id = $row->categories_id;
				$categories_id = $row;
				$datacatmap = array(
									'categories_id'=>$categories_id,
	                        		'id_post'=>$id,
	                        		'post_type'=>$type	
	                        	);
				
				$this->db->where($datacatmap);
				$q = $this->db->get('catmap');

				if ( $q->num_rows() > 0 ) 
				{
				  $this->db->where('categories_id',$categories_id);
				  $this->db->update('catmap',$datacatmap);
				  $this->db->query("DELETE FROM catmap where categories_id!='$categories_id' and id_post='$id' and post_type='$type'");
				} else {
				  //$this->db->set('user_id', $id);
				  $this->db->insert('catmap',$datacatmap);
				  //$this->db->insert('categories_lists',$datadb);


				}
				
				//delete $this->db->query("DELETE FROM catmap where categories_id!='$categories_id' and id_post='$id' and post_type='$type' ");

			
				
				# code...
				

			}

		}
		else{
			$this->db->query("DELETE FROM catmap where categories_id!='$categories_id' and id_post='$id' and post_type='$type'");
		}
        //$this->db->insert('categories',$data);
        //$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
		
    }

    

}