<?php
/**
 * @name		CodeIgniter Advanced Images
 * @author		Jens Segers
 * @link		http://www.jenssegers.be
 * @license		MIT License Copyright (c) 2012 Jens Segers
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Image_lib extends CI_Image_lib {
    
    var $user_width = 0;
    var $user_height = 0;
    var $user_x_axis = '';
    var $user_y_axis = '';
    
    /**
     * Initialize image preferences
     *
     * @access	public
     * @param	array
     * @return	bool
     */
    function initialize($props = array()) {
        // save user specified dimensions and axis positions before they are modified by the CI library
        if (isset($props["width"])) {
            $this->user_width = $props["width"];
        }
        if (isset($props["height"])) {
            $this->user_height = $props["height"];
        }
        if (isset($props["x_axis"])) {
            $this->user_x_axis = $props["x_axis"];
        }
        if (isset($props["y_axis"])) {
            $this->user_y_axis = $props["y_axis"];
        }
        
        return parent::initialize($props);
    }
    
    /**
     * Initialize image properties
     *
     * Resets values in case this class is used in a loop
     *
     * @access	public
     * @return	void
     */
    function clear() {
        $this->user_width = 0;
        $this->user_height = 0;
        $this->user_x_axis = '';
        $this->user_y_axis = '';
        
        return parent::clear();
    }
    
    /**
     * Smart resize and crop function
     *
     * @access	public
     * @return	bool
     */
    function fit() {
        // overwrite the dimensions with the original user specified dimensions
        $this->width = $this->user_width;
        $this->height = $this->user_height;
        
        // we will calculate the sizes ourselves
        $this->maintain_ratio = FALSE;
        
        // ------------------------------------------------------------------------------------------
        // mode 1: auto-scale the image to fit 1 dimension
        // ------------------------------------------------------------------------------------------
        if ($this->user_width == 0 || $this->user_height == 0) {
            // calculate missing dimension
            if ($this->user_width == 0) {
                $this->width = ceil($this->user_height * $this->orig_width / $this->orig_height);
            } else {
                $this->height = ceil($this->user_width * $this->orig_height / $this->orig_width);
            }
            
            // no cropping is needed, just resize
            return $this->resize();
        }
        
        // ------------------------------------------------------------------------------------------
        // mode 2: resize and crop the image to fit both dimensions
        // ------------------------------------------------------------------------------------------
        $this->width = ceil($this->user_height * $this->orig_width / $this->orig_height);
        $this->height = ceil($this->user_width * $this->orig_height / $this->orig_width);
        
        if (($this->user_width != $this->width) && ($this->user_height != $this->height)) {
            if ($this->master_dim == 'height') {
                $this->width = $this->user_width;
            } else {
                $this->height = $this->user_height;
            }
        }
        
        // save dynamic output for last
        $dynamic_output = $this->dynamic_output;
        $this->dynamic_output = FALSE;
        
        // if dynamic output is requested we will use a temporary file to work on
        $tempfile = FALSE;
        if ($dynamic_output) {
            $temp = tmpfile();
            $tempfile = array_search('uri', @array_flip(stream_get_meta_data($temp)));
            $this->full_dst_path = $tempfile;
        }
        
        // resize stage
        if (!$this->resize()) {
            return FALSE;
        }
        
        // axis settings
        if (!is_numeric($this->user_x_axis)) {
            $this->x_axis = floor(($this->width - $this->user_width) / 2);
        } else {
            $this->x_axis = $this->user_x_axis;
        }
        
        if (!is_numeric($this->user_y_axis)) {
            $this->y_axis = floor(($this->height - $this->user_height) / 2);
        } else {
            $this->y_axis = $this->user_y_axis;
        }
        
        // cropping options
        $this->orig_width = $this->width;
        $this->orig_height = $this->height;
        $this->width = $this->user_width;
        $this->height = $this->user_height;
        
        // use the previous generated image for output
        $this->full_src_path = $this->full_dst_path;
        
        // reset dynamic output to initial value
        $this->dynamic_output = $dynamic_output;
        
        // cropping stage
        if (!$this->crop()) {
            return FALSE;
        }
        
        // close (and remove) the temporary file
        if ($tempfile) {
            fclose($temp);
        }
        
        return TRUE;
    }

    //fikar watermark override
    /**
     * Watermark - Graphic Version 
     *
     * @return  bool
     */
    public function overlay_watermark()
    {
        if ( ! function_exists('imagecolortransparent'))
        {
            $this->set_error('imglib_gd_required');
            return FALSE;
        }

        // Fetch source image properties
        $this->get_image_properties();

        // Fetch watermark image properties
        $props      = $this->get_image_properties($this->wm_overlay_path, TRUE);
        $wm_img_type    = $props['image_type'];
        //$wm_width = $props['width'];
        //$wm_height    = $props['height'];

        //fikar rasio watermark
        $srcprops       = $this->get_image_properties($this->full_src_path, TRUE);
        $watermark_ratio = $props['width'] / $props['height'];
        $watermark_new_width = $srcprops['width'] * 0.5;
        $watermark_new_height = $watermark_new_width / $watermark_ratio;
        $wm_width   = $watermark_new_width;
        $wm_height  = $watermark_new_height;
        $wmsrc = imagecreatefrompng($this->wm_overlay_path);
        
        


        //fikar ===

        // Create two image resources

        //$wm_img  = $this->image_create_gd($this->wm_overlay_path, $wm_img_type);
        //$wm_imgsrc  = $this->image_create_gd($wm_img, $wm_img_type);
        $src_img = $this->image_create_gd($this->full_src_path);

        //fikar lagi
        $wm_img = imagecreatetruecolor($wm_width, $wm_height);
        imagealphablending($wm_img, FALSE);
        imagesavealpha($wm_img, TRUE);

        $transparent = imagecolorallocatealpha($wm_img, 255, 255, 255, 127);
        imagefilledrectangle($wm_img, 0, 0, $wm_width, $wm_height, $transparent);

        imagecopyresized($wm_img, $wmsrc,0, 0, 0, 0,$wm_width, $wm_height,$props['width'], $props['height']);
        //fikar ====

        // Reverse the offset if necessary
        // When the image is positioned at the bottom
        // we don't want the vertical offset to push it
        // further down. We want the reverse, so we'll
        // invert the offset. Same with the horizontal
        // offset when the image is at the right

        $this->wm_vrt_alignment = strtoupper($this->wm_vrt_alignment[0]);
        $this->wm_hor_alignment = strtoupper($this->wm_hor_alignment[0]);

        if ($this->wm_vrt_alignment === 'B')
            $this->wm_vrt_offset = $this->wm_vrt_offset * -1;

        if ($this->wm_hor_alignment === 'R')
            $this->wm_hor_offset = $this->wm_hor_offset * -1;

        // Set the base x and y axis values
        $x_axis = $this->wm_hor_offset + $this->wm_padding;
        $y_axis = $this->wm_vrt_offset + $this->wm_padding;

        // Set the vertical position
        if ($this->wm_vrt_alignment === 'M')
        {
            $y_axis += ($this->orig_height / 2) - ($wm_height / 2);
        }
        elseif ($this->wm_vrt_alignment === 'B')
        {
            $y_axis += $this->orig_height - $wm_height;
        }

        // Set the horizontal position
        if ($this->wm_hor_alignment === 'C')
        {
            $x_axis += ($this->orig_width / 2) - ($wm_width / 2);
        }
        elseif ($this->wm_hor_alignment === 'R')
        {
            $x_axis += $this->orig_width - $wm_width;
        }

        // Build the finalized image
        if ($wm_img_type === 3 && function_exists('imagealphablending'))
        {
            @imagealphablending($src_img, TRUE);
        }

        // Set RGB values for text and shadow
        $rgba = imagecolorat($wm_img, $this->wm_x_transp, $this->wm_y_transp);
        $alpha = ($rgba & 0x7F000000) >> 24;

        // make a best guess as to whether we're dealing with an image with alpha transparency or no/binary transparency
        if ($alpha > 0)
        {
            // copy the image directly, the image's alpha transparency being the sole determinant of blending
            imagecopy($src_img, $wm_img, $x_axis, $y_axis, 0, 0, $wm_width, $wm_height);
        }
        else
        {
            // set our RGB value from above to be transparent and merge the images with the specified opacity
            imagecolortransparent($wm_img, imagecolorat($wm_img, $this->wm_x_transp, $this->wm_y_transp));
            imagecopymerge($src_img, $wm_img, $x_axis, $y_axis, 0, 0, $wm_width, $wm_height, $this->wm_opacity);
        }

        // We can preserve transparency for PNG images
        if ($this->image_type === 3)
        {
            imagealphablending($src_img, FALSE);
            imagesavealpha($src_img, TRUE);
        }

        // Output the image
        if ($this->dynamic_output === TRUE)
        {
            $this->image_display_gd($src_img);
        }
        elseif ( ! $this->image_save_gd($src_img)) // ... or save it
        {
            return FALSE;
        }

        imagedestroy($src_img);
        imagedestroy($wm_img);

        return TRUE;
    }

}