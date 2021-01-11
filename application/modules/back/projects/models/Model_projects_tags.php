<?php
class Model_projects_tags extends CI_Model
{
	function __construct()
	{
		// parent::__construct();
		$config = array(
			'field' => 'slug',
			'title' => 'tags_title',
			'table' => 'products_tags',
			'id' => 'tags_id',
		);
		$this->load->library('slug', $config);
	}
	function get_all_projects_tags()
	{
		$result = $this->db->get('projects_tags');
		return $result;
	}

	function search_projects_tags($title)
	{
		$this->db->like('tags_title', $title, 'both');
		$this->db->order_by('tags_title', 'ASC');
		$this->db->limit(10);
		return $this->db->get('projects_tags')->result();
	}
	function insert_projects_tagsdb($data = '')
	{
		$str = $data;
		$arr = explode(",", $str);
		foreach ($arr as $key => $value) {
			if (!projects_tags_in_database($this->slug->create_uri(trim($value)))) {
				$datadb = array(
					'tags_title' => trim($value),
					'slug' => $this->slug->create_uri(trim($value)),
					//'created_at'=>CURRENT_TIMESTAMP

				);
				$this->db->insert('projects_tags', $datadb);
			}
		}
	}

	function insert_projects_tagsmap($data = '', $id, $type = 'projects')
	{
		if (!empty($data) && !empty($id)) {
			$str = $data;
			$arr = explode(",", $str);
			foreach ($arr as $key => $value) {
				$dat = $this->db->query("SELECT * FROM projects_tags where slug='" . $this->slug->create_uri(trim($value)) . "'");
				$row = $dat->row();


				$tags_id = $row->tags_id;
				$datatagmap = array(
					'tags_id' => $tags_id,
					'id_projects' => $id,
					'post_type' => $type


				);
				$this->db->where($datatagmap);
				$q = $this->db->get('projects_tagmap');

				if ($q->num_rows() > 0) {
						$this->db->where('tags_id', $tags_id);
						$this->db->update('projects_tagmap', $datatagmap);
						$this->db->query("DELETE FROM projects_tagmap where tags_id!='$tags_id' and id_projects='$id' and post_type='$type'");
					} else {
					//$this->db->set('user_id', $id);
					$this->db->insert('projects_tagmap', $datatagmap);
				}
			}
		} else {
			$this->db->query("DELETE FROM projects_tagmap where id_projects='$id' and post_type='$type'");
		}
	}
}
