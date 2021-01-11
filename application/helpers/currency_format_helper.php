<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if ( ! function_exists('clean_number'))

{

    function clean_number($number)

    {
        $num = $number;
        $real_integer = filter_var($num, FILTER_SANITIZE_NUMBER_INT);
        //echo $real_integer;
        return $real_integer;
        //return 'Rp '.number_format($number,2,',','.');

    }





}

if ( ! function_exists('currency_format'))

{

    function currency_format($number)

    {

        return 'Rp '.number_format($number,2,',','.');

    }





}
if ( ! function_exists('harga'))

{

    function harga($number)

    {
    	if(!empty($number)) {
    		echo 'Rp '.number_format($number,0,',','.');
    	}
        //return 'Rp '.number_format($number,2,',','.');

    }





}