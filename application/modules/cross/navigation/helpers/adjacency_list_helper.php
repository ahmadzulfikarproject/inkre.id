<?php
/**
 * Adjacency List
 *
 * @package Helper
 * @author  Michał Śniatała <michal@sniatala.pl>
 * @license http://opensource.org/licenses/MIT  (MIT)
 * @since   Version 0.1
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('build_admin_tree'))
{
	/**
	 * Build admin tree
	 *
	 * Creates adjacency list for administration
	 *
	 * @param array &$tree Tree items
	 *
	 * @return string
	 */
	function build_admin_tree(&$tree)
	{
		$output = '';

		if ( ! empty($tree))
		{
			foreach ($tree as &$leaf)
			{
				$leaf['name'] = htmlspecialchars($leaf['name'], ENT_QUOTES, 'UTF-8');

				if (isset($leaf['children']) && ! empty($leaf['children']))
				{
					$output .= '<li id="list_' . $leaf['id'] . '"><div><i class="icon-move glyphicon glyphicon-move"></i> ' . $leaf['name'] . '<span class="pull-right"><a class="btn btn-primary btn-xs" href="' . site_url('navigation/edit/' . $leaf['id']) . '"><span class="glyphicon glyphicon-pencil"></span> Edit</a> <a class="btn btn-danger btn-xs delete" data-toggle="modal" data-type="item" data-href="' . site_url('navigation/delete/' . $leaf['id']) . '" data-name="' . $leaf['name'] . '" href="javascript:;"><span class="glyphicon glyphicon-trash"></span> Delete</a></span></div>';
					$output .= '<ol>' . build_admin_tree($leaf['children']) . '</ol>';
					$output .= '</li>';
				}
				else
				{
					$output .= '<li id="list_' . $leaf['id'] . '"><div><i class="icon-move glyphicon glyphicon-move"></i> ' . $leaf['name'] . '<span class="pull-right"><a class="btn btn-primary btn-xs" href="' . site_url('navigation/edit/'.$leaf['id']) . '"><span class="glyphicon glyphicon-pencil"></span> Edit</a> <a class="btn btn-danger btn-xs delete" data-toggle="modal" data-type="item" data-href="' . site_url('navigation/delete/' . $leaf['id']) . '" data-name="' . $leaf['name'] . '" href="javascript:;"><span class="glyphicon glyphicon-trash"></span> Delete</a></span></div></li>';
				}
			}
		}

		return $output;
	}
}

//--------------------------------------------------------------------

if ( ! function_exists('build_tree'))
{
	/**
	 * Build tree
	 *
	 * Creates adjacency list based on group id or slug
	 *
	 * @param mixed $group      Group id or slug
	 * @param array $attributes Any attributes
	 * @param array &$tree      Tree array
	 *
	 * @return string
	 */
	function build_tree($group, $attributes = array(), &$tree = array())
	{
		if (empty($tree))
		{
			$CI =& get_instance();
			$CI->load->library('adjacency_list');

			$tree = $CI->adjacency_list->get_all($group);
			$tree = parse_children($tree);
		}

		foreach (array('start_tag' => '<li>', 'end_tag' => '</li>', 'sub_start_tag' => '<ul>', 'sub_end_tag' => '</ul>') as $key => $val)
		{
			$atts[$key] = ( ! isset($attributes[$key])) ? $val : $attributes[$key];
			unset($attributes[$key]);
		}

		$output = '';

		if ( ! empty($tree))
		{
			foreach ($tree as &$leaf)
			{
				$leaf['name'] = htmlspecialchars($leaf['name'], ENT_QUOTES, 'UTF-8');

				if (isset($leaf['children']) && ! empty($leaf['children']))
				{
					$output .= $atts['start_tag'] . '<a href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
					$output .= $atts['sub_start_tag'] . build_tree($group, $attributes, $leaf['children']) . $atts['sub_end_tag'];
					$output .= $atts['end_tag'];
				}
				else
				{
					$output .= $atts['start_tag'] . '<a href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>' . $atts['end_tag'];
				}
			}
		}

		return $output;
	}
}

//--------------------------------------------------------------------
//fikar menu

if ( ! function_exists('build_bootstrapnav'))
{
	/**
	 * Build tree
	 *
	 * Creates adjacency list based on group id or slug
	 *
	 * @param mixed $group      Group id or slug
	 * @param array $attributes Any attributes
	 * @param array &$tree      Tree array
	 *
	 * @return string
	 */
	function classmenuku($classmenu) {
		$CI = get_instance();
		$slug = $classmenu;
		$segment = $CI->uri->uri_string();
		/*
		if(preg_match("/^http/", $segment)) {
						$segment = $segment;
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $segment = base_url().$segment;
	                  }

	    if(preg_match("/^http/", $slug)) {
						$slug = $slug;
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $slug = base_url().$slug;
	                  }
	                  */
	    echo $segment."-".$slug."<br>";

		if($segment==$slug){
	                        echo "active";
							//$activeclass = "active";
							//return $activeclass;
	                       // return $activeclass;
	                        //$atts['start_tag'] = $atts['start_tag'];
	    }


	  }
if ( ! function_exists('active_link'))
{
    function active_link($controller)
    {
        $CI = get_instance();
        $class = $CI->router->fetch_class();
        return ($class == $controller) ? ' active' : '';
        //echo 'active';
    }
}

function carianak($anaks,$segment){


						foreach ($anaks as $key => $anak) {
							# code...
							//echo $anak['url'];
							//echo "<br>";
							if(preg_match("/^http/", $anak['url'])) {
							$anak['url'] = $anak['url'];
		                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
			                  }else{
			                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
			                    $anak['url'] = base_url().$anak['url'];
			                  }
							if ($anak['url'] == $segment){
								$active_link = "active";
								//echo "ini berhasil".$active_link."<br>";
								return $active_link;
							}

						}

					}
	function build_bootstrapnav($group, $attributes = array(), &$tree = array())
	{
		$CI = get_instance();


		if (empty($tree))
		{
			$CI =& get_instance();
			$CI->load->library('adjacency_list');

			$tree = $CI->adjacency_list->get_all($group);
			$tree = parse_children($tree);
		}

		foreach (array('start_tag' => '<li class="noanakxxxx">', 'end_tag' => '</li>', 'sub_start_tag' => '<ul>', 'sub_end_tag' => '</ul>','parent_tag' => '<li class="parent dropdown">', 'parent_end_tag' => '</li>') as $key => $val)
		{
			$atts[$key] = ( ! isset($attributes[$key])) ? $val : $attributes[$key];
			unset($attributes[$key]);
		}

		$output = '';

		if ( ! empty($tree))
		{
			foreach ($tree as &$leaf)
			{
				$leaf['name'] = htmlspecialchars($leaf['name'], ENT_QUOTES, 'UTF-8');

				if (isset($leaf['children']) && ! empty($leaf['children']))
				{

					/*
					$output .= $atts['start_tag'] . '<i class="icon-move glyphicon glyphicon-plus ui-sortable-handle"></i><a href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
					$output .= $atts['sub_start_tag'] . build_bootstrapnav($group, $attributes, $leaf['children']) . $atts['sub_end_tag'];
					$output .= $atts['end_tag'];
					*/
					//fikar
					//classmenuku($leaf['url']);
	                //echo "<br>";
	                $linkku = $leaf['url'];
					if(preg_match("/^http/", $leaf['url'])) {
						$leaf['url'] = $leaf['url'];
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $leaf['url'] = base_url().$leaf['url'];
	                  }
	                $segment = $CI->uri->uri_string();
	                  if(preg_match("/^http/", $segment)) {
						$segment = $segment;
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $segment = base_url().$segment;
	                  }
	                //cari anak
	                //print_r($leaf['children']);
					//echo "<hr>";

					//carianak($leaf['children'],$segment);
					$active_link = carianak($leaf['children'],$segment);
					//cari anak end
	                if ($segment == $leaf['url']){
						$output .= '<li class="parentku active dropdown scrollnav ">'. '<a data-toggle="dropdown" class="dropdown-toggle" href="#">'.$leaf['name'].' <b class="caret"></b></a><a class="hidden" href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
					}
					elseif ($linkku == $CI->router->fetch_class()){
						$output .= '<li class="parentku aktiflink active dropdown scrollnav ">' . '<a data-toggle="dropdown" class="dropdown-toggle" href="#">'.$leaf['name'].' <b class="caret"></b></a><a class="hidden" href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
					}
					else{
						//echo ($segment == 'settings-seo' || $segment == 'settings-email') ? 'class="active"' : 'class=""';

						$output .= '<li class="parentku aktiflink '.$active_link.' dropdown scrollnav ">' . '<a data-toggle="dropdown" class="dropdown-toggle" href="#">'.$leaf['name'].' <b class="caret"></b></a><a class="hidden" href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
						//$output .= $atts['parent_tag'] . '<a data-toggle="dropdown" class="dropdown-toggle" href="#">'.$leaf['name'].' <b class="caret"></b></a><a class="hidden" href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
					}

					$output .= $atts['sub_start_tag'] . build_bootstrapnav($group, $attributes, $leaf['children']);
					//$output .= $CI->template->includeview(template().'/home-categories');
					/*
					if ($leaf['name'] == 'Produk') {
						# code...

						$output .= build_categories_sidebar('products',
							array(
								'sub_start_tag' => '<ul class="unstyled collapse" id="sub-item-5">', 'sub_end_tag' => '</ul>',
								'start_tag' => '<li class="item-1 deeper">', 'end_tag' => '</li>',
								'parent_tag' => '<li class="parentku deeper parent">', 'parent_end_tag' => '</li>'

							)

						);
					}
					*/
					$output .= $atts['sub_end_tag'];


					$output .= $atts['parent_end_tag'];
					//$atts['start_tag'] .= set_active($atts['start_tag'], $leaf['url']);

				}
				else
				{
					//classmenuku($leaf['url']);
	                //echo "<br>";
	                $linkasli = $leaf['url'];
	                //echo $leaf['url'];
					if(preg_match("/^http/", $leaf['url'])) {
						$leaf['url'] = $leaf['url'];
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $leaf['url'] = base_url().$leaf['url'];
	                  }
	                  $segment = $CI->uri->uri_string();
	                  if(preg_match("/^http/", $segment)) {
						$segment = $segment;
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $segment = base_url().$segment;
	                  }
	                  //echo $segment."-----".$leaf['url']."<br>";
	                //echo active_link($CI->uri->segment(1));
	                //echo $CI->router->fetch_class();
	                  //echo $CI->uri->segment(2);
	                //echo $CI->router->fetch_class();
	                if ($CI->uri->segment(1) == $CI->router->fetch_class()){
	                	//echo "active";
	                }
	                else{
	                	"beda";
	                }
					if ($segment == $leaf['url']){
						$output .= '<li class="active">'. '<a href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>' . $atts['end_tag'];
					}

					elseif ($linkasli == $CI->router->fetch_class()){
						$output .= '<li class="active">'. '<a href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>' . $atts['end_tag'];
					}

					else{
						$output .= $atts['start_tag'] . '<a href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>' . $atts['end_tag'];
					}
	                  //echo '<li class="okehhh" >okeh</li>';

					//$atts['start_tag'] .= set_active($atts['start_tag'], $leaf['url']);
					//echo $leaf['url'];


				}
			}
		}

		return $output;
	}
	function build_bootstrapnavnew($group, $attributes = array(), &$tree = array())
	{
		$CI = get_instance();


		if (empty($tree))
		{
			$CI =& get_instance();
			$CI->load->library('adjacency_list');

			$tree = $CI->adjacency_list->get_all($group);
			$tree = parse_children($tree);
		}

		foreach (array('start_tag' => '<li class="noanakxxxx">', 'end_tag' => '</li>', 'sub_start_tag' => '<ul>', 'sub_end_tag' => '</ul>','parent_tag' => '<li class="parent dropdown">', 'parent_end_tag' => '</li>') as $key => $val)
		{
			$atts[$key] = ( ! isset($attributes[$key])) ? $val : $attributes[$key];
			unset($attributes[$key]);
		}

		$output = '';

		if ( ! empty($tree))
		{
			foreach ($tree as &$leaf)
			{
				$leaf['name'] = htmlspecialchars($leaf['name'], ENT_QUOTES, 'UTF-8');

				if (isset($leaf['children']) && ! empty($leaf['children']))
				{

					/*
					$output .= $atts['start_tag'] . '<i class="icon-move glyphicon glyphicon-plus ui-sortable-handle"></i><a href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
					$output .= $atts['sub_start_tag'] . build_bootstrapnav($group, $attributes, $leaf['children']) . $atts['sub_end_tag'];
					$output .= $atts['end_tag'];
					*/
					//fikar
					//classmenuku($leaf['url']);
	                //echo "<br>";
	                $linkku = $leaf['url'];
					if(preg_match("/^http/", $leaf['url'])) {
						$leaf['url'] = $leaf['url'];
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $leaf['url'] = base_url().$leaf['url'];
	                  }
	                $segment = $CI->uri->uri_string();
	                  if(preg_match("/^http/", $segment)) {
						$segment = $segment;
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $segment = base_url().$segment;
	                  }
	                //cari anak
	                //print_r($leaf['children']);
					//echo "<hr>";

					//carianak($leaf['children'],$segment);
					$active_link = carianak($leaf['children'],$segment);
					//cari anak end
	                if ($segment == $leaf['url']){
						$output .= '<li class="parentku active has-children">'. '<a data-toggle="dropdown" href="#">'.$leaf['name'].'</a><a class="hidden" href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
					}
					elseif ($linkku == $CI->router->fetch_class()){
						$output .= '<li class="parentku aktiflink active has-children">' . '<a data-toggle="dropdown" href="#">'.$leaf['name'].'</a><a class="hidden" href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
					}
					else{
						//echo ($segment == 'settings-seo' || $segment == 'settings-email') ? 'class="active"' : 'class=""';

						$output .= '<li class="parentku aktiflink '.$active_link.' has-children">' . '<a data-toggle="dropdown" href="#">'.$leaf['name'].'</a><a class="hidden" href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
						//$output .= $atts['parent_tag'] . '<a data-toggle="dropdown" class="dropdown-toggle" href="#">'.$leaf['name'].' <b class="caret"></b></a><a class="hidden" href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
					}

					$output .= $atts['sub_start_tag'] . build_bootstrapnavnew($group, $attributes, $leaf['children']);
					//$output .= $CI->template->includeview(template().'/home-categories');
					/*
					if ($leaf['name'] == 'Produk') {
						# code...

						$output .= build_categories_sidebar('products',
							array(
								'sub_start_tag' => '<ul class="unstyled collapse" id="sub-item-5">', 'sub_end_tag' => '</ul>',
								'start_tag' => '<li class="item-1 deeper">', 'end_tag' => '</li>',
								'parent_tag' => '<li class="parentku deeper parent">', 'parent_end_tag' => '</li>'

							)

						);
					}
					*/
					$output .= $atts['sub_end_tag'];


					$output .= $atts['parent_end_tag'];
					//$atts['start_tag'] .= set_active($atts['start_tag'], $leaf['url']);

				}
				else
				{
					//classmenuku($leaf['url']);
	                //echo "<br>";
	                $linkasli = $leaf['url'];
	                //echo $leaf['url'];
					if(preg_match("/^http/", $leaf['url'])) {
						$leaf['url'] = $leaf['url'];
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $leaf['url'] = base_url().$leaf['url'];
	                  }
	                  $segment = $CI->uri->uri_string();
	                  if(preg_match("/^http/", $segment)) {
						$segment = $segment;
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $segment = base_url().$segment;
	                  }
	                  //echo $segment."-----".$leaf['url']."<br>";
	                //echo active_link($CI->uri->segment(1));
	                //echo $CI->router->fetch_class();
	                  //echo $CI->uri->segment(2);
	                //echo $CI->router->fetch_class();
	                if ($CI->uri->segment(1) == $CI->router->fetch_class()){
	                	//echo "active";
	                }
	                else{
	                	"beda";
	                }
					if ($segment == $leaf['url']){
						$output .= '<li class="active">'. '<a href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>' . $atts['end_tag'];
					}

					elseif ($linkasli == $CI->router->fetch_class()){
						$output .= '<li class="active">'. '<a href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>' . $atts['end_tag'];
					}

					else{
						$output .= $atts['start_tag'] . '<a href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>' . $atts['end_tag'];
					}
	                  //echo '<li class="okehhh" >okeh</li>';

					//$atts['start_tag'] .= set_active($atts['start_tag'], $leaf['url']);
					//echo $leaf['url'];


				}
			}
		}

		return $output;
	}
	function build_adminlte($group, $attributes = array(), &$tree = array())
	{
		$CI = get_instance();


		if (empty($tree))
		{
			$CI =& get_instance();
			$CI->load->library('adjacency_list');
			$CI->load->library('template');
			//$CI->load->model('model_hubungi');
			//$CI->load->model('products/model_products');
			$CI->load->helper('globals');

			$tree = $CI->adjacency_list->get_all($group);
			$tree = parse_children($tree);
		}

		foreach (array('start_tag' => '<li class="noanakzzz">', 'end_tag' => '</li>', 'sub_start_tag' => '<ul>', 'sub_end_tag' => '</ul>','parent_tag' => '<li class="parent dropdown">', 'parent_end_tag' => '</li>') as $key => $val)
		{
			$atts[$key] = ( ! isset($attributes[$key])) ? $val : $attributes[$key];
			unset($attributes[$key]);
		}

		$output = '';

		if ( ! empty($tree))
		{
			foreach ($tree as &$leaf)
			{
				$leaf['name'] = htmlspecialchars($leaf['name'], ENT_QUOTES, 'UTF-8');

				if (isset($leaf['children']) && ! empty($leaf['children']))
				{

					/*
					$output .= $atts['start_tag'] . '<i class="icon-move glyphicon glyphicon-plus ui-sortable-handle"></i><a href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
					$output .= $atts['sub_start_tag'] . build_bootstrapnav($group, $attributes, $leaf['children']) . $atts['sub_end_tag'];
					$output .= $atts['end_tag'];
					*/
					//fikar
					//classmenuku($leaf['url']);
	                //echo "<br>";
	                $linkku = $leaf['url'];
					if(preg_match("/^http/", $leaf['url'])) {
						$leaf['url'] = $leaf['url'];
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $leaf['url'] = base_url().$leaf['url'];
	                  }
	                $segment = $CI->uri->uri_string();
	                  if(preg_match("/^http/", $segment)) {
						$segment = $segment;
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $segment = base_url().$segment;
	                  }
	                //cari anak
	                //print_r($leaf['children']);
					//echo "<hr>";
	                $iconlabel = '';
					// we switch on $mail_protocol so we
					// can add additional config items
					// as the protocol changes
					switch ($leaf['code']) {
						// the simple mail protocol
						case 'inbox':
							//$iconlabel = $CI->template->includeview(template().'/inbox');
							//$iconlabel = '<i class="label label-success pull-right">'.totaldata('hubungi').'</i>';
							// we don't need to do anything for mail...
							//echo base_url('');
							break;
						case 'enquiry':
							//$iconlabel = $CI->template->includeview(template().'/inbox');
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('enquiry').'</i>';
							// we don't need to do anything for mail...
							//echo base_url('');
							break;
						case 'products':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('products').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'projects':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('projects').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'services':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('services').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'client':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('client').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'clients':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('clients').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'page':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('pages').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'slide':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('slide').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'berita':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('berita').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'gallery':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('gallery').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'sertifikat':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('sertifikat').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;

					}

					//carianak($leaf['children'],$segment);
					$active_link = carianak($leaf['children'],$segment);
					//cari anak end
					if ( ($CI->ion_auth->in_group($leaf['level'])) || ($CI->ion_auth->is_admin()) ){
		                if ($segment == $leaf['url']){
							$output .= '<li class="treeview active '.$leaf['level'].'">'. '<a href="#"><i class="glyphicon glyphicon-th-list"></i>'.$leaf['name'].$iconlabel.' <i class="fa fa-angle-left pull-right"></i></a>';
						}
						elseif ($linkku == $CI->router->fetch_class()){
							$output .= '<li class="parentku aktiflink active treeview '.$leaf['level'].'">' . '<a data-toggle="dropdown" class="dropdown-toggle" href="#">'.$leaf['name'].$iconlabel.' <b class="caret"></b></a><a class="hidden" href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
						}
						else{
							//echo ($segment == 'settings-seo' || $segment == 'settings-email') ? 'class="active"' : 'class=""';

							$output .= '<li class="treeview '.$active_link.' '.$leaf['level'].'">' . '<a href="'.base_url().'"><i class="fa '.$leaf['icon'].'"></i><span>'.$leaf['name'].$iconlabel.' </span><i class="fa fa-angle-left pull-right"></i></a>';
							//$output .= $atts['parent_tag'] . '<a data-toggle="dropdown" class="dropdown-toggle" href="#">'.$leaf['name'].' <b class="caret"></b></a><a class="hidden" href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
						}

						$output .= $atts['sub_start_tag'] . build_adminlte($group, $attributes, $leaf['children']) . $atts['sub_end_tag'];
						$output .= $atts['parent_end_tag'];
						//$atts['start_tag'] .= set_active($atts['start_tag'], $leaf['url']);
					}

				}
				else
				{
					//classmenuku($leaf['url']);
	                //echo "<br>";
	                $linkasli = $leaf['url'];
	                //echo $leaf['url'];
					if(preg_match("/^http/", $leaf['url'])) {
						$leaf['url'] = $leaf['url'];
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $leaf['url'] = base_url().$leaf['url'];
	                  }
	                  $segment = $CI->uri->uri_string();
	                  if(preg_match("/^http/", $segment)) {
						$segment = $segment;
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $segment = base_url().$segment;
	                  }
	                //Globals::setAuthenticatedMemeberId('999');
	                //echo Globals::authenticatedMemeberId();
					//echo 'apakah bisa'.$CI->global->$total_inbox. 'okeh';
					//==========================

	                  //echo $segment."-----".$leaf['url']."<br>";
	                //echo active_link($CI->uri->segment(1));
	                //echo $CI->router->fetch_class();
	                  //echo $CI->uri->segment(2);
	                //echo $CI->router->fetch_class();
	                	                  //include $leaf['code'];

	                // protocol
					$badgelabel = $leaf['code'];
					$iconlabel = '';
					// we switch on $mail_protocol so we
					// can add additional config items
					// as the protocol changes
					switch ($leaf['code']) {
						// the simple mail protocol
						case 'inbox':
							//$iconlabel = $CI->template->includeview(template().'/inbox');
							//$iconlabel = '<i class="label label-success pull-right">'.totaldata('hubungi').'</i>';
							// we don't need to do anything for mail...
							//echo base_url('');
							break;

						// smtp...
						case 'enquiry':
							//$iconlabel = $CI->template->includeview(template().'/inbox');
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('enquiry').'</i>';
							// we don't need to do anything for mail...
							//echo base_url('');
							break;
						case 'products':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('products').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'projects':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('projects').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'services':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('services').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'client':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('client').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'page':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('pages').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'slide':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('slide').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'berita':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('berita').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'gallery':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('gallery').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'sertifikat':
							// $iconlabel = '<i class="label label-success pull-right">'.totaldata('sertifikat').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;

					}
					//echo 'zzzzzzzzzzzzzzzzzzz'.$iconlabel;

	                if ( ($CI->ion_auth->in_group($leaf['level'])) || ($CI->ion_auth->is_admin()) ){
	                	//$levelclass = 'admin';
	                	//echo 'bukan admin';

		                if ($CI->uri->segment(1) == $CI->router->fetch_class()){
		                	//echo "active";
		                }
		                else{
		                	"beda";
		                }
						if ($segment == $leaf['url']){
							$output .= '<li class="active '.$leaf['level'].'">'. '<a href="' . $leaf['url'] . '"><i class="fa '.$leaf['icon'].'"></i><span>' . $leaf['name'] .$iconlabel. '</span></a>' .$atts['end_tag'];
						}

						elseif ($linkasli == $CI->router->fetch_class()){
							$output .= '<li class="active '.$leaf['level'].'">'. '<a href="' . $leaf['url'] . '"><i class="fa '.$leaf['icon'].'"></i><span>' . $leaf['name'] .$iconlabel. '</span></a>' .$atts['end_tag'];
						}

						else{
							$output .= '<li class="'.$leaf['level'].'">' . '<a href="' . $leaf['url'] . '"><i class="fa '.$leaf['icon'].'"></i><span>' . $leaf['name'] .$iconlabel. '</span></a>' .$atts['end_tag'];
						}
					}


	                  //echo '<li class="okehhh" >okeh</li>';

					//$atts['start_tag'] .= set_active($atts['start_tag'], $leaf['url']);
					//echo $leaf['url'];


				}
			}
		}

		return $output;
	}
	function build_gentelella($group, $attributes = array(), &$tree = array())
	{
		$CI = get_instance();


		if (empty($tree))
		{
			$CI =& get_instance();
			$CI->load->library('adjacency_list');
			$CI->load->library('template');
			//$CI->load->model('model_hubungi');
			//$CI->load->model('products/model_products');
			$CI->load->helper('globals');

			$tree = $CI->adjacency_list->get_all($group);
			$tree = parse_children($tree);
		}

		foreach (array('start_tag' => '<li class="noanakzzz">', 'end_tag' => '</li>', 'sub_start_tag' => '<ul>', 'sub_end_tag' => '</ul>','parent_tag' => '<li class="parent dropdown">', 'parent_end_tag' => '</li>') as $key => $val)
		{
			$atts[$key] = ( ! isset($attributes[$key])) ? $val : $attributes[$key];
			unset($attributes[$key]);
		}

		$output = '';

		if ( ! empty($tree))
		{
			foreach ($tree as &$leaf)
			{
				$leaf['name'] = htmlspecialchars($leaf['name'], ENT_QUOTES, 'UTF-8');

				if (isset($leaf['children']) && ! empty($leaf['children']))
				{

					/*
					$output .= $atts['start_tag'] . '<i class="icon-move glyphicon glyphicon-plus ui-sortable-handle"></i><a href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
					$output .= $atts['sub_start_tag'] . build_bootstrapnav($group, $attributes, $leaf['children']) . $atts['sub_end_tag'];
					$output .= $atts['end_tag'];
					*/
					//fikar
					//classmenuku($leaf['url']);
	                //echo "<br>";
	                $linkku = $leaf['url'];
					if(preg_match("/^http/", $leaf['url'])) {
						$leaf['url'] = $leaf['url'];
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $leaf['url'] = base_url().$leaf['url'];
	                  }
	                $segment = $CI->uri->uri_string();
	                  if(preg_match("/^http/", $segment)) {
						$segment = $segment;
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $segment = base_url().$segment;
	                  }
	                //cari anak
	                //print_r($leaf['children']);
					//echo "<hr>";
	                $iconlabel = '';
					// we switch on $mail_protocol so we
					// can add additional config items
					// as the protocol changes
					switch ($leaf['code']) {
						// the simple mail protocol
						case 'inbox':
							//$iconlabel = $CI->template->includeview(template().'/inbox');
							//$iconlabel = '<i class="label label-success pull-right">'.totaldata('hubungi').'</i>';
							// we don't need to do anything for mail...
							//echo base_url('');
							break;
						case 'enquiry':
							//$iconlabel = $CI->template->includeview(template().'/inbox');
							// $iconlabel = '<i class="label label-success">'.totaldata('enquiry').'</i>';
							// we don't need to do anything for mail...
							//echo base_url('');
							break;
						case 'products':
							// $iconlabel = '<i class="label label-success">'.totaldata('products').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'projects':
							// $iconlabel = '<i class="label label-success">'.totaldata('projects').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'services':
							// $iconlabel = '<i class="label label-success">'.totaldata('services').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'client':
							// $iconlabel = '<i class="label label-success">'.totaldata('client').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'clients':
							// $iconlabel = '<i class="label label-success">'.totaldata('clients').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'page':
							// class_exists('page') ? '' :'';
							// $iconlabel = '<i class="label label-success">'.totaldata('pages').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'slide':
							// $iconlabel = '<i class="label label-success">'.totaldata('slide').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'berita':
							// $iconlabel = '<i class="label label-success">'.totaldata('berita').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'gallery':
							// $iconlabel = '<i class="label label-success">'.totaldata('gallery').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'sertifikat':
							// $iconlabel = '<i class="label label-success">'.totaldata('sertifikat').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;

					}

					//carianak($leaf['children'],$segment);
					$active_link = carianak($leaf['children'],$segment);
					//cari anak end
					if ( ($CI->ion_auth->in_group($leaf['level'])) || ($CI->ion_auth->is_admin()) ){
		                if ($segment == $leaf['url']){
							$output .= '<li class=" active '.$leaf['level'].'">'. '<a><i class="glyphicon glyphicon-th-list"></i>'.$leaf['name'].$iconlabel.' <span class="fa fa-chevron-down"></span></a>';
						}
						elseif ($linkku == $CI->router->fetch_class()){
							$output .= '<li class="parentku aktiflink active  '.$leaf['level'].'">' . '<a data-toggle="dropdown" class="dropdown-toggle">'.$leaf['name'].$iconlabel.' <b class="caret"></b></a><a class="hidden" href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
						}
						else{
							//echo ($segment == 'settings-seo' || $segment == 'settings-email') ? 'class="active"' : 'class=""';

							$output .= '<li class=" '.$active_link.' '.$leaf['level'].'">' . '<a><i class="fa '.$leaf['icon'].'"></i><span>'.$leaf['name'].$iconlabel.' </span><span class="fa fa-chevron-down"></span></a>';
							//$output .= $atts['parent_tag'] . '<a data-toggle="dropdown" class="dropdown-toggle" href="#">'.$leaf['name'].' <b class="caret"></b></a><a class="hidden" href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
						}

						$output .= $atts['sub_start_tag'] . build_adminlte($group, $attributes, $leaf['children']) . $atts['sub_end_tag'];
						$output .= $atts['parent_end_tag'];
						//$atts['start_tag'] .= set_active($atts['start_tag'], $leaf['url']);
					}

				}
				else
				{
					//classmenuku($leaf['url']);
	                //echo "<br>";
	                $linkasli = $leaf['url'];
	                //echo $leaf['url'];
					if(preg_match("/^http/", $leaf['url'])) {
						$leaf['url'] = $leaf['url'];
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $leaf['url'] = base_url().$leaf['url'];
	                  }
	                  $segment = $CI->uri->uri_string();
	                  if(preg_match("/^http/", $segment)) {
						$segment = $segment;
	                    //echo "<li><a href='$row[link_sub]'>$row[nama_sub]</a></li>";
	                  }else{
	                    //echo "<li><a href='".base_url()."$row[link_sub]'>$row[nama_sub]</a></li>";
	                    $segment = base_url().$segment;
	                  }
	                //Globals::setAuthenticatedMemeberId('999');
	                //echo Globals::authenticatedMemeberId();
					//echo 'apakah bisa'.$CI->global->$total_inbox. 'okeh';
					//==========================

	                  //echo $segment."-----".$leaf['url']."<br>";
	                //echo active_link($CI->uri->segment(1));
	                //echo $CI->router->fetch_class();
	                  //echo $CI->uri->segment(2);
	                //echo $CI->router->fetch_class();
	                	                  //include $leaf['code'];

	                // protocol
					$badgelabel = $leaf['code'];
					$iconlabel = '';
					// we switch on $mail_protocol so we
					// can add additional config items
					// as the protocol changes
					switch ($leaf['code']) {
						// the simple mail protocol
						case 'inbox':
							//$iconlabel = $CI->template->includeview(template().'/inbox');
							//$iconlabel = '<i class="label label-success pull-right">'.totaldata('hubungi').'</i>';
							// we don't need to do anything for mail...
							//echo base_url('');
							break;

						// smtp...
						case 'enquiry':
							//$iconlabel = $CI->template->includeview(template().'/inbox');
							// $iconlabel = '<i class="label label-success">'.totaldata('enquiry').'</i>';
							// we don't need to do anything for mail...
							//echo base_url('');
							break;
						case 'products':
							// $iconlabel = '<i class="label label-success">'.totaldata('products').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'projects':
							// $iconlabel = '<i class="label label-success">'.totaldata('projects').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'services':
							// $iconlabel = '<i class="label label-success">'.totaldata('services').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'client':
							// $iconlabel = '<i class="label label-success">'.totaldata('client').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'page':
							// $iconlabel = '<i class="label label-success">'.totaldata('pages').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'slide':
							// $iconlabel = '<i class="label label-success">'.totaldata('slide').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'berita':
							// $iconlabel = '<i class="label label-success">'.totaldata('berita').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'gallery':
							// $iconlabel = '<i class="label label-success">'.totaldata('gallery').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;
						case 'sertifikat':
							// $iconlabel = '<i class="label label-success">'.totaldata('sertifikat').'</i>';
							//$config['smtp_host'] = $this->ci->config->item('smtp_host');
							break;

					}
					//echo 'zzzzzzzzzzzzzzzzzzz'.$iconlabel;

	                if ( ($CI->ion_auth->in_group($leaf['level'])) || ($CI->ion_auth->is_admin()) ){
	                	//$levelclass = 'admin';
	                	//echo 'bukan admin';

		                if ($CI->uri->segment(1) == $CI->router->fetch_class()){
		                	//echo "active";
		                }
		                else{
		                	"beda";
		                }
						if ($segment == $leaf['url']){
							$output .= '<li class="active '.$leaf['level'].'">'. '<a href="' . $leaf['url'] . '"><i class="fa '.$leaf['icon'].'"></i><span>' . $leaf['name'] .$iconlabel. '</span></a>' .$atts['end_tag'];
						}

						elseif ($linkasli == $CI->router->fetch_class()){
							$output .= '<li class="active '.$leaf['level'].'">'. '<a href="' . $leaf['url'] . '"><i class="fa '.$leaf['icon'].'"></i><span>' . $leaf['name'] .$iconlabel. '</span></a>' .$atts['end_tag'];
						}

						else{
							$output .= '<li class="'.$leaf['level'].'">' . '<a href="' . $leaf['url'] . '"><i class="fa '.$leaf['icon'].'"></i><span>' . $leaf['name'] .$iconlabel. '</span></a>' .$atts['end_tag'];
						}
					}


	                  //echo '<li class="okehhh" >okeh</li>';

					//$atts['start_tag'] .= set_active($atts['start_tag'], $leaf['url']);
					//echo $leaf['url'];


				}
			}
		}

		return $output;
	}
}
//fikar admin menu


//fikar menu end
//==============================================================================================================

if ( ! function_exists('build_breadcrumb'))
{
	/**
	 * Build breadcrumb
	 *
	 * Creates breadcrumb based on group (id or slug) and current item id
	 *
	 * @param mixed $group        Group id or slug
	 * @param int   $item_id      Current item id
	 * @param array $attributes   Any attributes
	 * @param array &$tree        Tree array
	 * @param array &$output_tree Output tree array
	 *
	 * @return string
	 */
	function build_breadcrumb($group, $item_id, $attributes = array(), &$tree = array(), &$output_tree = array())
	{
		if (empty($tree))
		{
			$CI =& get_instance();
			$CI->load->library('adjacency_list');

			$tree = $CI->adjacency_list->get_all($group);
		}

		if ( ! empty($tree))
		{
			foreach ($tree as &$leaf)
			{
				if ($item_id === (int) $leaf['id'])
				{
					array_push($output_tree, $leaf);

					build_breadcrumb($group, (int) $leaf['parent_id'], $attributes, $tree, $output_tree);
				}
			}

			return format_breadcrumb(array_reverse($output_tree), $item_id, $attributes);
		}

		return '';
	}
}

//--------------------------------------------------------------------

if ( ! function_exists('format_breadcrumb'))
{
	/**
	 * Format breadcrumb
	 *
	 * Format breadcrumb based on input array
	 *
	 * @param array $array      Array of items
	 * @param int   $item_id    Current item id
	 * @param array $attributes Any attributes
	 *
	 * @return string
	 */
	function format_breadcrumb($array, $item_id, $attributes = array())
	{
		foreach (array('start_tag' => '<li>', 'end_tag' => '</li>', 'start_tag_active' => '<li class="active">', 'divider' => ' <span class="divider">/</span>') as $key => $val)
		{
			$atts[$key] = ( ! isset($attributes[$key])) ? $val : $attributes[$key];
			unset($attributes[$key]);
		}

		$output = '';

		if ( ! empty($array) && is_array($array))
		{
			foreach ($array as &$item)
			{
				$item['name'] = htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8');

				if ($item_id === (int) $item['id'])
				{
					$output .= $atts['start_tag_active'] . $item['name'] . $atts['end_tag'];
				}
				else
				{
					$output .= $atts['start_tag'] . '<a href="' . $item['url'] . '">' . $item['name'] . '</a>' . $atts['divider'] . $atts['end_tag'];
				}
			}
		}

		return $output;
	}
}

//--------------------------------------------------------------------

if ( ! function_exists('build_tree_item'))
{
	/**
	 * Build tree item
	 *
	 * Creates adjacency list based on group (id or slug) and shows leafs related only to current item
	 *
	 * @param mixed $group        Group id or slug
	 * @param int   $item_id      Current item id
	 * @param array $attributes   Any attributes
	 * @param array &$tree        Tree array
	 * @param array &$in_array    Output tree array
	 *
	 * @return string
	 */
	function build_tree_item($group, $item_id, $attributes = array(), &$tree = NULL, &$in_array = array())
	{
		if (empty($tree))
		{
			$CI =& get_instance();
			$CI->load->library('adjacency_list');

			$tree = $CI->adjacency_list->get_all($group);
		}

		if ( ! empty($tree))
		{
			foreach ($tree as &$leaf)
			{
				if ($item_id === (int) $leaf['id'])
				{
					array_push($in_array, $leaf['id']);

					build_tree_item($group, (int) $leaf['parent_id'], $attributes, $tree, $in_array);
				}
			}

			$tree     = parse_children($tree);
			$in_array = array_reverse($in_array);

			return format_tree($tree, $in_array, $attributes);
		}

		return '';
	}
}

//--------------------------------------------------------------------

if ( ! function_exists('format_tree'))
{
	/**
	 * Format tree
	 *
	 * Format tree based on input array
	 *
	 * @param array &$tree      Array of items
	 * @param int   &$in_array  Current item id
	 * @param array $attributes Any attributes
	 *
	 * @return string
	 */
	function format_tree(&$tree, &$in_array, $attributes = array())
	{
		foreach (array('start_tag' => '<li>', 'end_tag' => '</li>', 'sub_start_tag' => '<ul>', 'sub_end_tag' => '</ul>') as $key => $val)
		{
			$atts[$key] = ( ! isset($attributes[$key])) ? $val : $attributes[$key];
			unset($attributes[$key]);
		}

		$output = '';

		if ( ! empty($tree))
		{
			foreach ($tree as &$leaf)
			{
				$leaf['name'] = htmlspecialchars($leaf['name'], ENT_QUOTES, 'UTF-8');

				if (isset($leaf['children']) && ! empty($leaf['children']) && (in_array($leaf['id'], $in_array)))
				{
					$output .= $atts['start_tag'] . '<a href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>';
					$output .= $atts['sub_start_tag'] . format_tree($leaf['children'], $in_array, $attributes) . $atts['sub_end_tag'];
					$output .= $atts['end_tag'];
				}
				else
				{
					$output .= $atts['start_tag'] . '<a href="' . $leaf['url'] . '">' . $leaf['name'] . '</a>' . $atts['end_tag'];
				}
			}
		}

		return $output;
	}
}

//--------------------------------------------------------------------

if ( ! function_exists('parse_children'))
{
	/**
	 * Parse children
	 *
	 * Parse array and format it to subarrays with children
	 *
	 * @param $array &$query Array input
	 *
	 * @return array|bool
	 */
	function parse_children(&$query)
	{
		! empty($query) OR FALSE;

		$tree = array();

		foreach ($query as &$row)
		{
			$tree[$row['id']] = $row;
		}

		unset($query);

		$tree_array = array();

		foreach ($tree as &$leaf)
		{
			if (array_key_exists($leaf['parent_id'], $tree))
			{
				$tree[$leaf['parent_id']]['children'][] = &$tree[$leaf['id']];
			}

			if ( ! isset($tree[$leaf['id']]['children']))
			{
				$tree[$leaf['id']]['children'] = array();
			}

			if ( (int) $leaf['parent_id'] === 0)
			{
				$tree_array[] = &$tree[$leaf['id']];
			}
		}

		return $tree_array;
	}
}
/* End of file adjacency_list_helper.php */
/* Location: ./helpers/adjacency_list_helper.php */
