<?php
class Model_products_categories extends CI_Model{

	
	function insert_products_categoriesdb($data){
        $str=$data;
		$arr=explode(",",$str);
		foreach ($arr as $key => $value) {
			if (! products_categories_in_database($this->slug->create_uri(trim($value)))) {
				# code...
				$datadb = array(
								'name'=>trim($value),
                        		'slug'=>$this->slug->create_uri(trim($value)),
                        		'position'=>100,
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

    function insert_products_categoriesid($data,$id,$type='products'){
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
				//$dat = $this->db->query("SELECT * FROM categories_lists where slug='".$this->slug->create_uri(trim($value))."'");
				$datcats = $this->db->get_where('categories_lists', array('slug' => $this->slug->create_uri(trim($value)),'group_id' => 5)); 
		    	$rowcats = $datcats->row();

		    	
				$categories_id = $rowcats->id;
				$datatagmap = array(
									//'id_products'=>$id,
									'id_categories'=>$categories_id,
	                        		
	                        		//'post_type'=>$type
	                        		
	                        		
	                        	);
				$this->db->where('id_products',$id);
				$this->db->update('products',$datatagmap);
				
			}
		}
		
        //$this->db->insert('categories',$data);
        //$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
    }
    
}