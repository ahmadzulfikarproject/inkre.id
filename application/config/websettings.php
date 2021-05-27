<?php
/**
 * Adjacency List
 *
 * @package Config
 * @author  ahmad zulfikar
 * @license http://opensource.org/licenses/MIT  (MIT)
 * @since   Version 0.1
 */
defined('BASEPATH') OR exit('No direct script access allowed');

//-------------------------------------------------------------------------
// web settings
//-------------------------------------------------------------------------
	$config['site_name']	= 'Genset Jakarta';
	$config['offline']	= true;
	$config['asset']	= 'asset';
	$config['adminurl']	= 'adm0204';
	$config['siteurl'] = (isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'].
						str_replace(basename($_SERVER['SCRIPT_NAME']),"",
						$_SERVER['SCRIPT_NAME']);
