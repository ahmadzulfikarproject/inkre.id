<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('active_menu')) {
  function activate_menu($controller) {
    // Getting CI class instance.
    $CI = get_instance();
    // Getting router class to active.
    $class = $CI->router->fetch_class();
    return ($class == $controller) ? 'active' : '';
  }
}
function classmenu($classmenu) {
	$CI = get_instance();
	if($CI->uri->segment(1)==$classmenu){
                        echo "active";
    }
   	
  }