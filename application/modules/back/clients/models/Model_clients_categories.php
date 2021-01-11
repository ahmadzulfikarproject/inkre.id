<?php
class Model_clients_categories extends CI_Model{

	
	function insert_clients_categoriesdb($data){
        $str=$data;
		$arr=explode(",",$str);
		foreach ($arr as $key => $value) {
			if (! clients_categories_in_database($this->slug->create_uri(trim($value)))) {
				$datadb = array(
								'name'=>trim($value),
                        		'slug'=>$this->slug->create_uri(trim($value)),
                        		'position'=>100,
                        		'group_id'=>8,
                        		
                        		//'created_at'=>CURRENT_TIMESTAMP
                        		
                        	);
				$this->db->insert('categories_lists',$datadb);
			}
		}
    }

    function insert_clients_categoriesid($data,$id,$type='clients'){
    	if (!empty($data) && !empty($id) ) {
	        $str=$data;
			$arr=explode(",",$str);
			foreach ($arr as $key => $value) {
				//$dat = $this->db->query("SELECT * FROM categories_lists where slug='".$this->slug->create_uri(trim($value))."'");
				$datcats = $this->db->get_where('categories_lists', array('slug' => $this->slug->create_uri(trim($value)),'group_id' => 8)); 
		    	$rowcats = $datcats->row();

		    	
				$categories_id = $rowcats->id;
				$datatagmap = array(
									'id_categories'=>$categories_id,
	                        	);
				$this->db->where('id_clients',$id);
				$this->db->update('clients',$datatagmap);
				
			}
		}
    }
    
}