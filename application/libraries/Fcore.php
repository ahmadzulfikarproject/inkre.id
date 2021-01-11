<?php

/**
 * Open Blog Core Class
 *
 * @author			Enliven Applications
 * @license			MIT
 * @link			http://open-blog.org
 */
class Fcore
{
/**
	 * Loads in the config and sets the variables
	 */
	public function __construct()
	{
		$this->ci = &get_instance();

	}

	public function db_to_config()
	{
		$settings = $this->ci->db->get('settings')->result();

		foreach ($settings as $set)
		{
			// if we need a true bool value
			if ($set->value == 'true' || $set->value == 'false')
			{
				// convert to true bool
				$bool_value = filter_var($set->value, FILTER_VALIDATE_BOOLEAN);

				// set the value
				$this->ci->config->set_item($set->name, $bool_value);
			}
			// we don't need a bool, so do it normal like
			else
			{
				$this->ci->config->set_item($set->name, $set->value);
			}	
		}
	}

	public function get_active_theme($is_admin='0')
	{
		return $this->ci->db->where('is_active', 1)->where('is_admin', $is_admin)->limit(1)->get('templates')->row();
	}


	public function get_navigation()
	{
		$this->ci->db->select('title, description, url, external, position');
		$this->ci->db->order_by('position', 'ASC'); 
		
		$query = $this->ci->db->get('navigation');
			
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
	}


	public function generate_social_links()
	{
		if ( ! $social = $this->ci->db->where('enabled', 1)->get('social')->result())
		{
			return false;
		}
		else
		{
			$return = '';
			foreach ($social as $s)
			{
				$return .= anchor($s->url, $s->name) . ' | ';
			}
			$return .= '';
		}
		$return = rtrim($return, ' | ');

		return $return;
	}


	public function set_lang()
	{
		// get the default language set by site owner
		$default_lang = $this->ci->db->where('is_default', '1')->limit(1)->get('languages')->row();

		$this->ci->session->set_userdata('language', $default_lang->language);
		$this->ci->session->set_userdata('language_abbr', $default_lang->abbreviation);

		// don't need you anymore.
		unset($default_lang);
	}

	public function get_lang_options()
	{
		$langs = $this->ci->db->where('is_avail', '1')->get('languages')->result();

		// default empty array
		$return = [];

		foreach ($langs as $lang)
		{
			$return[] = '<a href="' . site_url('lang_picker/set/' . $lang->language) . '">' . ucfirst(humanize($lang->language)) . '</a>';
		}

		// don't need you anymore.
		unset($langs);

		return $return;
	}



		public function build_form_field($field_type, $name, $cur_val, $options=null)
	{
		if ($field_type == 'radio')
		{
			$radio = '';
			if (!empty($options))
			{
				
				$options_arr = explode("|", $options);
				foreach ($options_arr as $option)
				{
					$parts = explode('=', $option);
					$checked = ($cur_val == $parts[0]) ? TRUE : FALSE;
					$data = [
						'name' 		=> $name,
						'id'		=> $name,
						'value'		=> $parts[0],
						'class'		=> 'form-control',
						'checked'	=> $checked
					];
					$radio .= '<label>' . form_radio($data) . ' ' . lang($parts[1]) . '</label><br>';
				}

			}
			return $radio;
		}
		// it's a dropdown
		elseif ($field_type == 'dropdown')
		{
			// $options not empty?
			if (!empty($options))
			{	
				// explode the first bit on the pipe
				// 10=10|20=20
				// produces array([0] 10=10, [1] 20=20)
				$options_arr = explode("|", $options);

				// foreach of those exploded array items
				foreach ($options_arr as $option)
				{
					// explode again on the = sign
					// 10=10
					// produces array([0] 10, [1] 10)
					$parts = explode('=', $option);

					// if $parts[0] is not numeric we run it through the
					// language filter to get the text value in language file
					// otherwise, we return it unhindered as a number
					$form_opts[$parts[0]] = ( ! is_numeric($parts[1])) ? lang($parts[1]) : $parts[1];

					// if they've tried to submit the new value
					// but validation failed, we'll repopulate
					// the value here.
					if ($this->ci->input->post())
					{
						// set the $cur_val to the user's input
						$cur_val = $this->ci->input->post($name);
					}
				}
			}
			return form_dropdown($name, $form_opts, $cur_val, 'class="form-control" id="' . $name . '"');
		}
		elseif ($field_type == 'text')
		{
			// if they've tried to submit the new value
			// but validation failed, we'll repopulate
			// the value here.
			if ($this->ci->input->post())
			{
				// set the $cur_val to the user's input
				$cur_val = set_value($name);
			}
			return form_input($name, $cur_val, 'class="form-control" id="' . $name . '"');
		}
		elseif ($field_type == 'image')
		{
			// if they've tried to submit the new value
			// but validation failed, we'll repopulate
			// the value here.
			if ($this->ci->input->post())
			{
				// set the $cur_val to the user's input
				$cur_val = set_value($name);
			}
			return form_upload($name, $cur_val, 'class="form-controlz xxx imgupload" id="' . $name . '"');
		}
		// return default failure
		return false;
	}



	public function set_redirect($old_slug, $new_slug, $type='post', $code="301")
	{	
		// is the redirect already set?
		$current = $this->ci->db
						->where('old_slug', $old_slug)
						->where('new_slug', $new_slug)
						->limit(1)
						->get('redirects')
						->row();

		// is there already a record?
		if ($current)
		{
			// we'll update code rather than insert a new record.
			// this is the only time one should be changing these
			// otherwise, delete and enter new information
			$update = [
				'code' => $code
			];
			return $this->ci->db
						->where('id', $current->id)
						->update('redirects', $update);
		}

		// There's no records that appear for this one
		// so we'll insert the new redirects record.
		$insert = [
			'old_slug' 	=> $old_slug,
			'new_slug' 	=> $new_slug,
			'type'		=> $type,
			'code'		=> $code
		];
		return $this->ci->db->insert('redirects', $insert);
	}

	public function has_redirect($url_title)
	{
		return $this->ci->db->limit(1)->where('old_slug', $url_title)->get('redirects')->row();

	}

	public function remove_redirects($slug=false)
	{
		return $this->ci->db->where('new_slug', $slug)->delete('redirects');
	}


	public function set_meta($data, $type='post', $home=false)
	{
		if ($type == 'page')
		{
			$webidentitas = $this->ci->db->query("SELECT * FROM identitas WHERE id_identitas=1")->row_array();
			if (! $data['meta_title']) {
				$data['meta_title'] = $data['judul'].' | '.$webidentitas['nama_website'];
				# code...
			}
			else{
				$data['meta_title'] = $data['meta_title'].' | '.$webidentitas['nama_website'];
			}
			//print_r($data);
			if (! $data['meta_keywords']) {
				$data['meta_keywords'] = $webidentitas['meta_keyword'];
				# code...
			}
			if (! $data['meta_description']) {
				$data['meta_description'] = $data['meta_title'].' - '.$data['isi_pages'];
				# code...
			}
			else{
				$data['meta_description'] = $data['meta_title'].' - '.$data['isi_pages'];
			}
			if (! $data['gambar']) {
				$data['gambar'] = base_url().webconfig('asset').'/'.$webidentitas['header'];
				# code...
			}
			else{
				$data['gambar'] = base_url().webconfig('asset').'/foto_halaman/'.$data['gambar'];
			}
			$this->ci->template->set_metadata('title', $data['meta_title'],'meta');
			$this->ci->template->set_metadata('keywords', $data['meta_keywords'],'meta');
			$this->ci->template->set_metadata('description', $data['meta_description'],'meta');

			$this->ci->template->set_metadata('title', $data['meta_title'], 'og');
			$this->ci->template->set_metadata('type', 'website', 'og');
			$this->ci->template->set_metadata('description', $data['meta_description'], 'og');
			$this->ci->template->set_metadata('title', $data['meta_title'], 'web');
			$this->ci->template->set_metadata('image', $data['gambar'], 'og');
			

		}
		elseif ($type == 'post')
		{
			$this->ci->template->set_metadata('title', $data['meta_title']);
			$this->ci->template->set_metadata('keywords', $data['meta_keywords']);
			$this->ci->template->set_metadata('description', $data['meta_description']);

			$this->ci->template->set_metadata('title', $data['meta_title'], 'og');
			$this->ci->template->set_metadata('type', 'website', 'og');
			$this->ci->template->set_metadata('description', $data['meta_description'], 'og');

			if ($data['feature_image'])
			{
				$this->ci->template->set_metadata('image', base_url('uploads/' . $data['feature_image']), 'og');
			}

			// the homepage being called?
			if ($home)
			{
				$this->ci->template->set_metadata('url', site_url(), 'og');
			}
			else
			{
				$this->ci->template->set_metadata('url', post_url($data['url_title'], $data['date_posted']), 'og');
			}
		}
		elseif ($type == 'schedules') {
			$webidentitas = $this->ci->db->query("SELECT * FROM identitas WHERE id_identitas=1")->row_array();
			if (! $data['meta_title']) {
				$data['meta_title'] = $data['judul'];
				# code...
			}
			if (! $data['meta_keywords']) {
				$data['meta_keywords'] = $webidentitas['meta_keyword'];
				# code...
			}
			if (! $data['meta_description']) {
				$data['meta_description'] = $data['isi_schedules'];
				# code...
			}
			if (! $data['gambar']) {
				$data['gambar'] = base_url().webconfig('asset').'/'.$webidentitas['header'];
				# code...
			}
			else{
				$data['gambar'] = base_url().webconfig('asset').'/foto_schedules/'.$data['gambar'];
			}
			$this->ci->template->set_metadata('title', $data['meta_title'],'meta');
			$this->ci->template->set_metadata('keywords', $data['meta_keywords'],'meta');
			$this->ci->template->set_metadata('description', $data['meta_description'],'meta');

			$this->ci->template->set_metadata('title', $data['meta_title'], 'og');
			$this->ci->template->set_metadata('type', 'website', 'og');
			$this->ci->template->set_metadata('description', $data['meta_description'], 'og');
			$this->ci->template->set_metadata('title', $data['meta_title'], 'web');
			$this->ci->template->set_metadata('image', $data['gambar'], 'og');
			
			
		}
		elseif ($type == 'products') {
			$webidentitas = $this->ci->db->query("SELECT * FROM identitas WHERE id_identitas=1")->row_array();
			if (! $data['meta_title']) {
				$data['meta_title'] = 'jual '.$data['judul'].' murah berkualitas - '.$webidentitas['nama_website'];
				# code...
			}
			//print_r($data);
			if (! $data['meta_keywords']) {
				$data['meta_keywords'] = $webidentitas['meta_keyword'];
				# code...
			}
			if (! $data['meta_description']) {
				$data['meta_description'] = 'jual '.$data['judul'].' murah berkualitas - di jakarta bogor tangerang bekasi depok. '.$data['isi_products'];
				# code...
			}
			if (! $data['gambar']) {
				$data['gambar'] = base_url().webconfig('asset').'/'.$webidentitas['header'];
				# code...
			}
			else{
				$data['gambar'] = base_url().webconfig('asset').'/foto_products/'.$data['gambar'];
			}
			$this->ci->template->set_metadata('title', $data['meta_title'],'meta');
			$this->ci->template->set_metadata('keywords', $data['meta_keywords'],'meta');
			$this->ci->template->set_metadata('description', $data['meta_description'],'meta');

			$this->ci->template->set_metadata('title', $data['meta_title'], 'og');
			$this->ci->template->set_metadata('type', 'website', 'og');
			$this->ci->template->set_metadata('description', $data['meta_description'], 'og');
			$this->ci->template->set_metadata('title', $data['meta_title'], 'web');
			$this->ci->template->set_metadata('image', $data['gambar'], 'og');
			
			
		}
		elseif ($type == 'clients') {
			$webidentitas = $this->ci->db->query("SELECT * FROM identitas WHERE id_identitas=1")->row_array();
			if (! $data['meta_title']) {
				$data['meta_title'] = $data['judul'].' - '.$webidentitas['nama_website'];
				# code...
			}
			//print_r($data);
			if (! $data['meta_keywords']) {
				$data['meta_keywords'] = $webidentitas['meta_keyword'];
				# code...
			}
			if (! $data['meta_description']) {
				$data['meta_description'] = $data['judul'].' - '.$data['isi_clients'];
				# code...
			}
			if (! $data['gambar']) {
				$data['gambar'] = base_url().webconfig('asset').'/'.$webidentitas['header'];
				# code...
			}
			else{
				$data['gambar'] = base_url().webconfig('asset').'/foto_clients/'.$data['gambar'];
			}
			$this->ci->template->set_metadata('title', $data['meta_title'],'meta');
			$this->ci->template->set_metadata('keywords', $data['meta_keywords'],'meta');
			$this->ci->template->set_metadata('description', $data['meta_description'],'meta');

			$this->ci->template->set_metadata('title', $data['meta_title'], 'og');
			$this->ci->template->set_metadata('type', 'website', 'og');
			$this->ci->template->set_metadata('description', $data['meta_description'], 'og');
			$this->ci->template->set_metadata('title', $data['meta_title'], 'web');
			$this->ci->template->set_metadata('image', $data['gambar'], 'og');
			
			
		}
		elseif ($type == 'gallery') {
			$webidentitas = $this->ci->db->query("SELECT * FROM identitas WHERE id_identitas=1")->row_array();
			if (! $data['meta_title']) {
				$data['meta_title'] = $data['judul'].' - '.$webidentitas['nama_website'];
				# code...
			}
			//print_r($data);
			if (! $data['meta_keywords']) {
				$data['meta_keywords'] = $webidentitas['meta_keyword'];
				# code...
			}
			if (! $data['meta_description']) {
				$data['meta_description'] = $data['judul'].' - '.$data['isi_gallery'];
				# code...
			}
			if (! $data['gambar']) {
				$data['gambar'] = base_url().webconfig('asset').'/'.$webidentitas['header'];
				# code...
			}
			else{
				$data['gambar'] = base_url().webconfig('asset').'/foto_gallery/'.$data['gambar'];
			}
			$this->ci->template->set_metadata('title', $data['meta_title'],'meta');
			$this->ci->template->set_metadata('keywords', $data['meta_keywords'],'meta');
			$this->ci->template->set_metadata('description', $data['meta_description'],'meta');

			$this->ci->template->set_metadata('title', $data['meta_title'], 'og');
			$this->ci->template->set_metadata('type', 'website', 'og');
			$this->ci->template->set_metadata('description', $data['meta_description'], 'og');
			$this->ci->template->set_metadata('title', $data['meta_title'], 'web');
			$this->ci->template->set_metadata('image', $data['gambar'], 'og');
			
			
		}
		elseif ($type == 'home') {
			$webidentitas = $this->ci->db->query("SELECT * FROM identitas WHERE id_identitas=1")->row_array();
			if (! isset($data['meta_title'])) {
				if (! isset($data['title'])) {
					$data['title'] = '';
				}
				$data['meta_title'] = $data['title'].' | '.$webidentitas['nama_website'];
				# code...
			}
			//$this->ci->template->set_metadata('title', $webidentitas['nama_website'],'meta');
			$this->ci->template->set_metadata('title', $data['meta_title'],'meta');
			$this->ci->template->set_metadata('description', $webidentitas['meta_deskripsi'],'meta');
			$this->ci->template->set_metadata('keywords',$webidentitas['meta_keyword'],'meta');

			$this->ci->template->set_metadata('title', $webidentitas['nama_website'], 'og');
			$this->ci->template->set_metadata('type', 'website', 'og');
			$this->ci->template->set_metadata('description', $webidentitas['meta_deskripsi'], 'og');
			$this->ci->template->set_metadata('title', $webidentitas['meta_keyword'], 'web');
			$this->ci->template->set_metadata('image', base_url().webconfig('asset').'/'.$webidentitas['header'], 'og');

			
		}
		elseif ($type == 'index') {
			$webidentitas = $this->ci->db->query("SELECT * FROM identitas WHERE id_identitas=1")->row_array();
			if (! isset($data['meta_title'])) {
				$data['meta_title'] = $data['judul'].' - '.$webidentitas['nama_website'];
				# code...
			}
			//print_r($data);
			if (! isset($data['meta_keywords'])) {
				$data['meta_keywords'] = $webidentitas['meta_keyword'];
				# code...
			}
			if (! isset($data['meta_description'])) {
				$data['meta_description'] = $data['meta_title'].' - '.date('Y').' | '.$webidentitas['meta_deskripsi'];
				# code...
			}
			if (! isset($data['gambar'])) {
				$data['gambar'] = base_url().webconfig('asset').'/'.$webidentitas['header'];
				# code...
			}
			else{
				$data['gambar'] = base_url().webconfig('asset').'/foto_tags/'.$data['gambar'];
			}
			$this->ci->template->set_metadata('title', $data['meta_title'],'meta');
			$this->ci->template->set_metadata('keywords', $data['meta_keywords'],'meta');
			$this->ci->template->set_metadata('description', $data['meta_description'],'meta');

			$this->ci->template->set_metadata('title', $data['meta_title'], 'og');
			$this->ci->template->set_metadata('type', 'website', 'og');
			$this->ci->template->set_metadata('description', $data['meta_description'], 'og');
			$this->ci->template->set_metadata('title', $data['meta_title'], 'web');
			$this->ci->template->set_metadata('image', $data['gambar'], 'og');
			
		}
		elseif ($type == 'contact') {
			$webidentitas = $this->ci->db->query("SELECT * FROM identitas WHERE id_identitas=1")->row_array();
			if (! $data['meta_title']) {
				$data['meta_title'] = 'Contact us - '.$data['nama'];
				# code...
			}
			//print_r($data);
			if (! $data['meta_keywords']) {
				$data['meta_keywords'] = $webidentitas['meta_keyword'];
				# code...
			}
			if (! $data['meta_description']) {
			
				$data['meta_description'] = $data['meta_title'].' - '.date('Y').' | '.$webidentitas['meta_deskripsi'];
				# code...
			}
			if (! $data['gambar']) {
				$data['gambar'] = base_url().webconfig('asset').'/'.$webidentitas['header'];
				# code...
			}
			else{
				$data['gambar'] = base_url().webconfig('asset').'/foto_contact/'.$data['gambar'];
			}
			$this->ci->template->set_metadata('title', $data['meta_title'],'meta');
			$this->ci->template->set_metadata('keywords', $data['meta_keywords'],'meta');
			$this->ci->template->set_metadata('description', $data['meta_description'],'meta');

			$this->ci->template->set_metadata('title', $data['meta_title'], 'og');
			$this->ci->template->set_metadata('type', 'website', 'og');
			$this->ci->template->set_metadata('description', $data['meta_description'], 'og');
			$this->ci->template->set_metadata('title', $data['meta_title'], 'web');
			$this->ci->template->set_metadata('image', $data['gambar'], 'og');
			
		}
		elseif ($type == 'berita') {
			$webidentitas = $this->ci->db->query("SELECT * FROM identitas WHERE id_identitas=1")->row_array();
			if (! $data['meta_title']) {
				$data['meta_title'] = $data['judul'].' - '.date('Y').' | '.$webidentitas['nama_website'];
				# code...
			}
			else{
				$data['meta_title'] = $data['meta_title'].' - '.date('Y').' | '.$webidentitas['nama_website'];
			}
			//print_r($data);
			if (! $data['meta_keywords']) {
				$data['meta_keywords'] = $webidentitas['meta_keyword'];
				# code...
			}
			if (! $data['meta_description']) {
				$data['meta_description'] = $data['meta_title'].' - '.$data['isi_berita'];
				# code...
			}
			else{
				$data['meta_description'] = $data['meta_title'].' - '.$data['isi_berita'];
			}
			if (! $data['gambar']) {
				$data['gambar'] = base_url().webconfig('asset').'/'.$webidentitas['header'];
				# code...
			}
			else{
				$data['gambar'] = base_url().webconfig('asset').'/foto_berita/'.$data['gambar'];
			}
			$this->ci->template->set_metadata('title', $data['meta_title'],'meta');
			$this->ci->template->set_metadata('keywords', $data['meta_keywords'],'meta');
			$this->ci->template->set_metadata('description', $data['meta_description'],'meta');

			$this->ci->template->set_metadata('title', $data['meta_title'], 'og');
			$this->ci->template->set_metadata('type', 'website', 'og');
			$this->ci->template->set_metadata('description', $data['meta_description'], 'og');
			$this->ci->template->set_metadata('title', $data['meta_title'], 'web');
			$this->ci->template->set_metadata('image', $data['gambar'], 'og');
			
			
		}
		elseif ($type == 'tags') {
			$webidentitas = $this->ci->db->query("SELECT * FROM identitas WHERE id_identitas=1")->row_array();
			if (! isset($data['meta_title'])) {
				$data['meta_title'] = $data['judul'].' di Jakarta Bogor Depok Tangerang Bekasi'.' | '.$webidentitas['nama_website'];
				# code...
			}
			//print_r($data);
			if (! isset($data['meta_keywords'])) {
				$data['meta_keywords'] = $webidentitas['meta_keyword'];
				# code...
			}
			if (! isset($data['meta_description'])) {
				$data['meta_description'] = $data['meta_title'].' di Jakarta Bogor Depok Tangerang Bekasi - '.date('Y').' | '.$webidentitas['meta_deskripsi'];
				# code...
			}
			if (! isset($data['gambar'])) {
				$data['gambar'] = base_url().webconfig('asset').'/'.$webidentitas['header'];
				# code...
			}
			else{
				$data['gambar'] = base_url().webconfig('asset').'/foto_tags/'.$data['gambar'];
			}
			$this->ci->template->set_metadata('title', $data['meta_title'],'meta');
			$this->ci->template->set_metadata('keywords', $data['meta_keywords'],'meta');
			$this->ci->template->set_metadata('description', $data['meta_description'],'meta');

			$this->ci->template->set_metadata('title', $data['meta_title'], 'og');
			$this->ci->template->set_metadata('type', 'website', 'og');
			$this->ci->template->set_metadata('description', $data['meta_description'], 'og');
			$this->ci->template->set_metadata('title', $data['meta_title'], 'web');
			$this->ci->template->set_metadata('image', $data['gambar'], 'og');
			
			
		}
		elseif ($type == 'services') {
			$webidentitas = $this->ci->db->query("SELECT * FROM identitas WHERE id_identitas=1")->row_array();
			if (! $data['meta_title']) {
				$data['meta_title'] = $data['judul'].' | '.$webidentitas['nama_website'];
				# code...
			}
			else{
				$data['meta_title'] = $data['meta_title'].' | '.$webidentitas['nama_website'];
			}
			//print_r($data);
			if (! $data['meta_keywords']) {
				$data['meta_keywords'] = $webidentitas['meta_keyword'];
				# code...
			}
			if (! $data['meta_description']) {
				$data['meta_description'] = $data['meta_title'].' - '.$data['isi_services'];
				# code...
			}
			else{
				$data['meta_description'] = $data['meta_title'].' - '.$data['isi_services'];
			}
			if (! $data['gambar']) {
				$data['gambar'] = base_url().webconfig('asset').'/'.$webidentitas['header'];
				# code...
			}
			else{
				$data['gambar'] = base_url().webconfig('asset').'/foto_services/'.$data['gambar'];
			}
			$this->ci->template->set_metadata('title', $data['meta_title'],'meta');
			$this->ci->template->set_metadata('keywords', $data['meta_keywords'],'meta');
			$this->ci->template->set_metadata('description', $data['meta_description'],'meta');

			$this->ci->template->set_metadata('title', $data['meta_title'], 'og');
			$this->ci->template->set_metadata('type', 'website', 'og');
			$this->ci->template->set_metadata('description', $data['meta_description'], 'og');
			$this->ci->template->set_metadata('title', $data['meta_title'], 'web');
			$this->ci->template->set_metadata('image', $data['gambar'], 'og');
			
			
		}
		elseif ($type == 'projects') {
			$webidentitas = $this->ci->db->query("SELECT * FROM identitas WHERE id_identitas=1")->row_array();
			if (! $data['meta_title']) {
				$data['meta_title'] = 'Project di '.$data['judul'].' - '.$data['lokasi'].' | '.$webidentitas['nama_website'];
				# code...
			}
			else{
				$data['meta_title'] = $data['meta_title'].' | '.$webidentitas['nama_website'];
			}
			//print_r($data);
			if (! $data['meta_keywords']) {
				$data['meta_keywords'] = $webidentitas['meta_keyword'];
				# code...
			}
			if (! $data['meta_description']) {
				$data['meta_description'] = $data['meta_title'].' - '.$data['isi_projects'];
				# code...
			}
			else{
				$data['meta_description'] = $data['meta_title'].' - '.$data['isi_projects'];
			}
			if (! $data['gambar']) {
				$data['gambar'] = base_url().webconfig('asset').'/'.$webidentitas['header'];
				# code...
			}
			else{
				$data['gambar'] = base_url().webconfig('asset').'/foto_projects/'.$data['gambar'];
			}
			$this->ci->template->set_metadata('title', $data['meta_title'],'meta');
			$this->ci->template->set_metadata('keywords', $data['meta_keywords'],'meta');
			$this->ci->template->set_metadata('description', $data['meta_description'],'meta');

			$this->ci->template->set_metadata('title', $data['meta_title'], 'og');
			$this->ci->template->set_metadata('type', 'website', 'og');
			$this->ci->template->set_metadata('description', $data['meta_description'], 'og');
			$this->ci->template->set_metadata('title', $data['meta_title'], 'web');
			$this->ci->template->set_metadata('image', $data['gambar'], 'og');
			
			
		}
		
	}


	public function send_email($to, $subject, $message, $cc=false, $bcc=false)
	{
		$this->ci->load->library('email');

		//set up the email config 
		$mail_protocol = $this->ci->config->item('mail_protocol');

		// protocol
		$config['protocol'] = $mail_protocol;

		// we switch on $mail_protocol so we
		// can add additional config items 
		// as the protocol changes
		switch ($mail_protocol) {
			// the simple mail protocol
			case 'mail':
				// we don't need to do anything for mail...
				break;

			// smtp... 	
			case 'smtp':
				$config['smtp_host'] = $this->ci->config->item('smtp_host');
				$config['smtp_user'] = $this->ci->config->item('smtp_user');
				$config['smtp_pass'] = $this->ci->config->item('smtp_pass');
				$config['smtp_port'] = $this->ci->config->item('smtp_port');
				$config['smtp_crypto'] = $this->ci->config->item('smtp_crypto');
				break;

			// lastly, sendmail
			case 'sendmail':
				//The server path to Sendmail. Usually '/usr/sbin/sendmail'
				$config['mailpath'] = $this->ci->config->item('sendmail_path');
				break;

			// default is 'mail'
			default:
				// $mail_protocol ended up being something 
				// other than the 3 we check for, so we override
				// whatever it was and go with 'mail'
				$config['protocol'] = 'mail';
				break;
		}
		
		// the rest of the config items we don't
		// need to worry about which protocol the
		// site is using...
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['useragent'] = 'OpenBlogv3';
		$config['mailtype'] = 'html';
		
		

		// init and let's send some email
		$this->ci->email->initialize($config);

		// from db settings
		$this->ci->email->from($this->ci->config->item('server_email'), $this->ci->config->item('site_name'));

		// set who it's going to...
		$this->ci->email->to($to);

		// if $cc
		if ($cc)
		{
			$this->ci->email->cc($cc);
		}

		// if $bcc
		if ($bcc)
		{
			$this->ci->email->bcc($bcc);
		}

		// set the subject
		$this->ci->email->subject($subject);
		
		// set the message...
		$this->ci->email->message($message);

		// and off we go
		if (!$this->ci->email->send())
		{
			$this->ci->email->print_debugger();
		}
		return true;

	}





}

