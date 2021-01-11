<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Thumb()
 * A TimThumb-style function to generate image thumbnails on the fly.
 *
 * @author Darren Craig
 * @author Lozano Hernán <hernantz@gmail.com>
 * @access public
 * @param string $src
 * @param int $width
 * @param int $height
 * @param string $image_thumb
 * @return String
 *
 */

function thumb($src, $width, $height, $w=true, $image_thumb = '') {

	// Get the CodeIgniter super object
	$CI = &get_instance();

	// get src file's dirname, filename and extension
	if (file_exists($src)) {
		# code...
	
		$path = pathinfo($src);

		// Path to image thumbnail
		if( !$image_thumb )
			$image_thumb = $path['dirname'] . DIRECTORY_SEPARATOR . $path['filename'] . "_" . $height . '_' . $width . "." . $path['extension'];


		if (( !file_exists($image_thumb) ) && (file_exists($src))) {

			// LOAD LIBRARY
			$CI->load->library('image_lib');
			//resize gambar asli
			$size = getimagesize($src);
	        list($widthsrc, $heightsrc, $type, $attr) = $size;
	        //print_r($size);
	        //echo $widthsrc;
	        $bataslebar = 1200;
	        if ($widthsrc > $bataslebar){
				$config['source_image'] = $src;
				//$config['new_image'] = $image_thumb;
				$config['width'] = $bataslebar;
				//$config['height'] = 1200;
				$config['maintain_ratio'] = TRUE;
				$config['master_dim'] = 'width';

				$CI->image_lib->initialize($config);
				$CI->image_lib->resize();
				$CI->image_lib->clear();
			}
			//Watermark newly uploaded image
			$watermark_type = 'overlay' ;//$CI->input->post('watermark_type');

	        //$CI->load->library('image_lib');
	        $config['source_image'] = $src;
	        
	        if($watermark_type == 'text'){
	            $config['wm_text'] = 'www.alphajayatehnik.co.id';
	            $config['wm_type'] = 'text';
	            $config['wm_font_path'] = '../system/fonts/texb.ttf';
	            $config['wm_font_size'] = 26;
	            $config['wm_font_color'] = 'ffffff';
	            $config['wm_shadow_color'] = '333333';
	            $config['wm_shadow_distance'] = 3;           
	            $config['wm_padding'] = 20;
	        }
	        else if($watermark_type == 'overlay'){
	            $config['image_library'] = 'gd2';
	            $config['wm_type'] = 'overlay';
	            $config['wm_overlay_path'] = '../asset/watermark.png';//the overlay image
	            $config['wm_x_transp'] = 4;
	            $config['wm_y_transp'] = 4;
	            $config['width'] = 50;
	            $config['height'] = 50;
	            $config['padding'] = 50;
	            $config['wm_opacity'] = 30;
	        }
	         
	        //$config['wm_opacity'] = 30;
	        $config['wm_vrt_alignment'] = 'middle';
	        $config['wm_hor_alignment'] = 'center';
	        if ($w) {
		        	# code...
		        
		        $CI->image_lib->initialize($config);
		        if (!$CI->image_lib->watermark()) {
		            $response['wm_errors'] = $CI->image_lib->display_errors();
		            $response['wm_status'] = 'error';
		        } else {
		            $response['wm_status'] = 'success';
		        }
	        }
	        $CI->image_lib->clear();

	        /*
	        //watermark text

	            $config['wm_text'] = 'Injection Concrete & Waterproofing - www.alphajayatehnik.co.id';
	            $config['wm_type'] = 'text';
	            $config['wm_font_path'] = './system/fonts/texb.ttf';
	            $config['wm_font_size'] = 12;
	            $config['wm_font_color'] = 'ffffff';
	            $config['wm_shadow_color'] = '333333';
	            $config['wm_shadow_distance'] = 1;           
	            $config['wm_padding'] = 0;
	            $config['wm_vrt_offset'] = -16;
	            $config['wm_hor_offset'] = -20;
	            $config['wm_opacity'] = 50;
	            
	        
	        
	        //$config['wm_opacity'] = 30;
	        $config['wm_vrt_alignment'] = 'bottom';
	        $config['wm_hor_alignment'] = 'right';

	        $CI->image_lib->initialize($config);
	        if (!$CI->image_lib->watermark()) {
	            $response['wm_errors'] = $CI->image_lib->display_errors();
	            $response['wm_status'] = 'error';
	        } else {
	            $response['wm_status'] = 'success';
	        }
	        $CI->image_lib->clear();
	        */
	        //watermark end
			// CONFIGURE IMAGE LIBRARY
			$config['source_image'] = $src;
			$config['new_image'] = $image_thumb;
			$config['width'] = $width;
			$config['height'] = $height;

			$CI->image_lib->initialize($config);
			$CI->image_lib->resize();
			$CI->image_lib->clear();

			// get our image attributes
			list($original_width, $original_height, $file_type, $attr) = getimagesize($image_thumb);

			// set our cropping limits.
			$crop_x = ($original_width / 2) - ($width / 2);
			$crop_y = ($original_height / 2) - ($height / 2);
			
			// initialize our configuration for cropping
			$config['source_image'] = $image_thumb;
			$config['new_image'] = $image_thumb;
			//fikar start
			/*
			//Set cropping for y or x axis, depending on image orientation
			if ($original_width > $original_height) {
			    $config['width'] = $original_height;
			    $config['height'] = $original_height;
			    $config['x_axis'] = (($original_width / 2) - ($config['width'] / 2));
			}
			else {
			    $config['height'] = $original_width;
			    $config['width'] = $original_width;
			    $config['y_axis'] = (($original_height / 2) - ($config['height'] / 2));
			}
			*/
			//skala
			if ($original_width > $original_height) {
			    $config['width'] = $original_height;
			    $config['height'] = $original_height;
			    $config['x_axis'] = (($original_width / 2) - ($config['width'] / 2));
			}
			else {
			    $config['height'] = $original_width;
			    $config['width'] = $original_width;
			    $config['y_axis'] = (($original_height / 2) - ($config['height'] / 2));
			}

			//fikar end
			//$config['x_axis'] = $crop_x;
			//$config['y_axis'] = $crop_y;
			$config['maintain_ratio'] = FALSE;
			//fikar
			$config['create_thumb'] = TRUE;
			$config['thumb_marker'] = '_thumb';
			//fikar z
			$CI->image_lib->initialize($config);
			$CI->image_lib->crop();
			$CI->image_lib->clear();

			//crop medium
			// CONFIGURE IMAGE LIBRARY
			
			$image_medium = $path['dirname'] . DIRECTORY_SEPARATOR . $path['filename'] . "_" . "medium" .  "." . $path['extension'];
			//$size = getimagesize($src);
	        //list($widthsrc, $heightsrc, $type, $attr) = $size;
			$config['source_image'] = $src;
			$config['new_image'] = $image_medium;
			$config['maintain_ratio'] = FALSE;
			//$config['create_thumb'] = TRUE;
			//$config['thumb_marker'] = '_medium';
			if ($widthsrc > $heightsrc) {
			    $config['width'] = $heightsrc;
			    $config['height'] = $heightsrc;
			    $config['x_axis'] = (($widthsrc / 2) - ($config['width'] / 2));
			}
			else {
				$mwidth = $widthsrc;
			    $config['height'] = $mwidth;
			    $config['width'] =$mwidth;
			    $config['y_axis'] = (($heightsrc / 2) - ($config['height'] / 2));
			}
			//$config['width'] = $mwidth;
			//$config['height'] = $m$height;

			$CI->image_lib->initialize($config);
			//$CI->image_lib->resize();
			//$CI->image_lib->crop();
			$CI->image_lib->clear();
			//kecilin
			

			//crop medium end
			
			
		}

		return basename($image_thumb);
	}
}
function thumbhome($src, $width, $height, $image_thumb = '') {

	// Get the CodeIgniter super object
	$CI = &get_instance();

	// get src file's dirname, filename and extension
	$path = pathinfo($src);

	// Path to image thumbnail
	if( !$image_thumb )
		$image_thumb = $path['dirname'] . DIRECTORY_SEPARATOR . $path['filename'] . "_" . $height . '_' . $width . "." . $path['extension'];


	if (( !file_exists($image_thumb) ) && (file_exists($src)) ) {

		// LOAD LIBRARY
		$CI->load->library('image_lib');
		

		// get our image attributes
		list($original_width, $original_height, $file_type, $attr) = getimagesize($src);

		// set our cropping limits.
		$crop_x = ($original_width / 2) - ($width / 2);
		$crop_y = ($original_height / 2) - ($height / 2);
		
		// initialize our configuration for cropping
		$config['source_image'] = $src;
		$config['new_image'] = $image_thumb;
		//fikar start

		//skala
		
		if ($original_width > $original_height) {
			$config['master_dim'] = 'height';
		    $config['width'] = $original_height;
		    $config['height'] = $original_height;
		    $config['x_axis'] = (($original_width / 2) - ($config['width'] / 2));
		    $config['y_axis'] = ($original_height / 2) - ($config['height'] / 2);
		}
		else {
			$config['master_dim'] = 'width';
		    $config['height'] = $original_width;
		    $config['width'] = $original_width;
		    $config['y_axis'] = (($original_height / 2) - ($config['height'] / 2));
		    $config['x_axis'] = ($original_width / 2) - ($config['width'] / 2);
		}
		
				// set our cropping limits.
		//$crop_x = ($original_width / 2) - ($width / 2);
		//$crop_y = ($original_height / 2) - ($height / 2);
		//fikar end
		//$config['x_axis'] = $crop_x;
		//$config['y_axis'] = $crop_y;
		$config['maintain_ratio'] = false;
		//fikar
		//$config['create_thumb'] = TRUE;
		//$config['thumb_marker'] = '_thumb';
		//fikar z
		$CI->image_lib->initialize($config);
		$CI->image_lib->crop();
		$CI->image_lib->clear();

		
		/*
		//resize gambar asli
		$size = getimagesize($image_thumb);
        list($widthsrc, $heightsrc, $type, $attr) = $size;
        //print_r($size);
        //echo $widthsrc;
        
		// CONFIGURE IMAGE LIBRARY
		$config['source_image'] = $image_thumb;
		$config['new_image'] = $image_thumb;
		$config['width'] = $width;
		$config['height'] = $height;

		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		$CI->image_lib->clear();
		*/
	}

	return basename($image_thumb);
}
function delete_thumb($src,$folder) {
	$CI = &get_instance();
	// LOAD LIBRARY
	$CI->load->library('image_lib');
	
	if (file_exists($src)){
		$config['source_image'] = $src;
		$fileinfo = get_file_info($src);
		$ext = pathinfo($src,PATHINFO_EXTENSION);
		//echo $fileinfo['name'];
		//echo basename($src,".".$ext);
		$namaimg = basename($src,".".$ext);

		foreach (glob('../asset/'.$folder.'/*'.$namaimg."*") as $rowimg) {
			if (file_exists($rowimg)){
				if ($rowimg != $src ) {
					unlink($rowimg);
				}
				
			}
	        
		//print_r($rowimg);
			//echo $rowimg."<br>";
			
	        # code...
	    }
    }
	//$dataimg = $CI->image_lib->initialize($config);
	//print_r($dataimg);
	//print_r($fileinfo);
   // return $namaimg;
}
function getnameimg($src,$folder) {
	$CI = &get_instance();
	// LOAD LIBRARY
	$CI->load->library('image_lib');
	

	$config['source_image'] = $src;
	$fileinfo = get_file_info($src);
	$ext = pathinfo($src,PATHINFO_EXTENSION);
	//echo $fileinfo['name'];
	//echo basename($src,".".$ext);
	$namaimg = basename($src,".".$ext);

	foreach (glob('../asset/'.$folder.'/*'.$namaimg."*") as $rowimg) {
			if (file_exists($rowimg)){
				unlink($rowimg);
			}
            
		//print_r($rowimg);
			//echo $rowimg."<br>";
			
            # code...
        }

	//$dataimg = $CI->image_lib->initialize($config);
	//print_r($dataimg);
	//print_r($fileinfo);
   // return $namaimg;
}
function getnameimage($src,$marker){
	$fileinfo = get_file_info($src);
	$ext = pathinfo($src,PATHINFO_EXTENSION);
	//echo $fileinfo['name'];
	//echo basename($src,".".$ext);
	$namaimg = basename($src,".".$ext);
	return $namaimg.$marker.".".$ext;
}

/* End of file thumb_helper.php */
/* Location: ./application/helpers/thumb_helper.php */
