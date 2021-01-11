<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Template {
    
                
		var $template_data = array();
		var $meta_data = array();
		private $_title = '';
		private $_metadata = array();
		
		function set($name, $value)
		{
			$this->template_data[$name] = $value;
		}

		function set_meta($name, $value)
		{
			$this->meta_data[$name] = $value;
		}

			/**
		 * Set metadata for output later
		 *
		 * @access	public
		 * @param	  string	$name		keywords, description, etc
		 * @param	  string	$content	The content of meta data
		 * @param	  string	$type		Meta-data comes in a few types, links for example
		 * @return	void
		 */
		public function set_metadata($name, $content, $type = 'meta')
		{
			$name = htmlspecialchars(strip_tags(html_entity_decode($name)));
			$content = htmlspecialchars(strip_tags(html_entity_decode($content)));


			// Keywords with no comments? ARG! comment them
			if ($name == 'keywords' AND ! strpos($content, ','))
			{
				$content = preg_replace('/[\s]+/', ', ', trim($content));
			}
			elseif ($name == 'description') {
				# code...
				//
				$content = html_entity_decode(character_limiter(strip_tags(html_entity_decode($content)), 300));
			}

			switch($type)
			{
				case 'meta':
					$this->_metadata[$type.'_'.$name] = '<meta name="'.$name.'" content="'.$content.'" />';
					//$this->set_meta[$type.'_'.$name] = $content;
					$this->set($type.'_'.$name,$content);
				break;

				case 'link':
					$this->_metadata[$type.'_'.$content] = '<link rel="'.$name.'" href="'.$content.'" />';
					//$this->set_meta[$type.'_'.$name] = $content;
					$this->set($type.'_'.$name,$content);
				break;

				case 'og':
					$this->_metadata[$type.'_'.$content] = '<meta property="og:'.$name.'" content="'.$content.'" />';
					//$this->set_meta[$type.'_'.$name] = $content;
					$this->set($type.'_'.$name,$content);
				break;
				case 'web':
					$this->_metadata[$type.'_'.$name] = '<'.$name.'>'.$content.'</title>';
					//$this->set_meta[$type.'_'.$name] = $content;
					$this->set($type.'_'.$name,$content);
				break;
			}

			return $this;
		}
	
		function load($template = '',  $view = '' , $view_data = array(), $return = FALSE)
		{               
			$this->CI =& get_instance();
			$templateFile =FCPATH.'templates/'.template().'/views/'.$template.'.php';
			$viewFile =FCPATH.'templates/'.template().'/views/'.$view.'.php';
			//echo $templateFile;
			//$template['metadata']	= implode("\n\t\t", $this->_metadata).Asset::render('extra').$this->get_metadata('late_header');
			if(file_exists($viewFile)){
				$this->set('contents', $this->CI->load->view('../../templates/'.template().'/views/'.$view, $view_data, TRUE));
				//$this->set('meta_data', $this->CI->load->view('../../templates/'.template().'/views/'.template().'/meta_data', $this->_metadata, TRUE));
				//$this->set('metatag',$this->_metadata);
			}
			else{
				$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
				//$this->set('meta_data', $this->CI->load->view(template().'/meta_data', $this->_metadata, TRUE));
				//$this->set('metatag',$this->_metadata);
			}			
			//return $this->CI->load->view($template, $this->template_data, $return);
			if(file_exists($templateFile)){
				return $this->CI->load->view('../../templates/'.template().'/views/'.$template, $this->template_data, $return);
			}
			else{
				return $this->CI->load->view($template, $this->template_data, $return);
			}

		}
		function loadrss($view = '' , $view_data = array(), $return = FALSE)
		{               
			$this->CI =& get_instance();
			//$templateFile =FCPATH.'templates/'.template().'/views/'.$template.'.php';
			$viewFile =FCPATH.'templates/'.template().'/views/'.$view.'.php';
			//echo $templateFile;
			if(file_exists($viewFile)){
				return $this->CI->load->view('../../templates/'.template().'/views/'.$view, $view_data, TRUE);
			}
			else{
				return $this->CI->load->view($view, $view_data, TRUE);
			}			
			
		}
		function includeview($templatepart)
		{               
			$this->CI =& get_instance();
			$templatepartok =FCPATH.'templates/'.template().'/views/'.$templatepart.'.php';
			//echo $templatepartok;
			if(file_exists($templatepartok)){
				//$this->set('contents', $this->CI->load->view('../../templates/'.template().'/views/'.$view, $view_data, TRUE));			
				//return $this->CI->load->view($template, $this->template_data, $return);
				return $this->CI->load->view('../../templates/'.template().'/views/'.$templatepart);
			}
			else{
				return $this->CI->load->view($templatepart);
			}
		}
		public function themeable($view, $vars = array(), $return = FALSE)
		{
		        $themeFile = '/full/path/to/theme/views/'.$view.'.php';
		        if(file_exists($themeFile)) return $this->_ci_load(array('_ci_path' => $themeFile, '_ci_view' => $view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));    // Get from theme
		        return $this->view($view, $vars, $return);        // Get from views
		}
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */