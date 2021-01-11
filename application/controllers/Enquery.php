<?php
class Enquery extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('enquery_model');
		//$this->load->model('tags/tags_model');
		$this->load->model('tags/tags_model');
		
		error_reporting(0);
	}

	function index(){
		$this->load->view('enquery_view');
	}

	function get_autocomplete(){
		if (isset($_GET['term'])) {
		  	$result = $this->tags_model->search_tags($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
		     		'id'			=> $row->tags_id,
					'label'			=> $row->tags_title,
					'description'	=> $row->tags_description,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}
	//inser ajax
	public function add_enquery() {
		$config = array(
                'field' => 'slug',
                'title' => 'judul',
                'table' => 'tags',
                'id' => 'tags_id',
            );
        $this->load->library('slug', $config);

		$data = array(
			'blog_title' => $this->input->post('blog_title'),
			'blog_description' => $this->input->post('blog_description'),
			'tags'=>$this->input->post('tags')
		);
		$str=$data['tags'];
		$arr=explode(",",$str);
		//$data_tags = array();
		foreach ($arr as $key => $value) {
			if (! tags_in_database($value)) {
				# code...
				$datadb = array(
								'tags_title'=>$value,
                        		'slug'=>$this->slug->create_uri($value),
                        		'created_at'=>CURRENT_TIMESTAMP
                        		
                        	);
                //print_r($datadb);
				$this->tags_model->insert_tagsdb($datadb);
			}
			# code...
		}
		
		//Either you can print value or you can send value to database
		
		$this->tags_model->insert_blogdb($data);
		echo json_encode($data);


		
	}

}