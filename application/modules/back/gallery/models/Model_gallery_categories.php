<?php
class Model_gallery_categories extends CI_Model{

	
	function insert_gallery_categoriesdb($data){
        $str=$data;
		$arr=explode(",",$str);
		foreach ($arr as $key => $value) {
			if (! gallery_categories_in_database($this->slug->create_uri(trim($value)))) {
				# code...
				$datadb = array(
								'name'=>trim($value),
                        		'slug'=>$this->slug->create_uri(trim($value)),
                        		'position'=>100,
                        		'group_id'=>10,
                        		
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

    function insert_gallery_categoriesid($data,$id,$type='gallery'){
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
				//$dat = $this->db->query("SELECT * FROM categories_lists where slug='".$this->slug->create_uri(trim($value))."'");
				$datcats = $this->db->get_where('categories_lists', array('slug' => $this->slug->create_uri(trim($value)),'group_id' => 10)); 
		    	$rowcats = $datcats->row();

		    	
				$categories_id = $rowcats->id;
				$datatagmap = array(
									//'id_gallery'=>$id,
									'id_categories'=>$categories_id,
	                        		
	                        		//'post_type'=>$type
	                        		
	                        		
	                        	);
				$this->db->where('id_gallery',$id);
				$this->db->update('gallery',$datatagmap);
				
			}
		}
		
        //$this->db->insert('categories',$data);
        //$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
    }
    
}