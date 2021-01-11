<?php
class Model_berita_categories extends CI_Model{

	
	function insert_berita_categoriesdb($data){
        $str=$data;
		$arr=explode(",",$str);
		foreach ($arr as $key => $value) {
			if (! berita_categories_in_database($this->slug->create_uri(trim($value)))) {
				$datadb = array(
								'name'=>trim($value),
                        		'slug'=>$this->slug->create_uri(trim($value)),
                        		'position'=>100,
                        		'group_id'=>9,
                        		
                        		//'created_at'=>CURRENT_TIMESTAMP
                        		
                        	);
				$this->db->insert('categories_lists',$datadb);
			}
		}
    }

    function insert_berita_categoriesid($data,$id,$type='berita'){
    	if (!empty($data) && !empty($id) ) {
	        $str=$data;
			$arr=explode(",",$str);
			foreach ($arr as $key => $value) {
				//$dat = $this->db->query("SELECT * FROM categories_lists where slug='".$this->slug->create_uri(trim($value))."'");
				$datcats = $this->db->get_where('categories_lists', array('slug' => $this->slug->create_uri(trim($value)),'group_id' => 9)); 
		    	$rowcats = $datcats->row();

		    	
				$categories_id = $rowcats->id;
				$datatagmap = array(
									'id_categories'=>$categories_id,
	                        	);
				$this->db->where('id_berita',$id);
				$this->db->update('berita',$datatagmap);
				
			}
		}
    }
    
}