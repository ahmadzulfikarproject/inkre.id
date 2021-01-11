<?php if (!defined('BASEPATH')) exit('Direct Access Not Allowed');
$config['num_links'] = 2;
$config['use_page_numbers'] = TRUE;
$config['reuse_query_string'] = TRUE;

$config['full_tag_open'] = '<ul class="pagination pg-blue justify-content-center">';
$config['full_tag_close'] = '</ul>';

$config['first_link'] = 'First Page';
$config['first_tag_open'] = '<li class="page-item"><span class="firstlink">';
$config['first_tag_close'] = '</span></li>';

$config['last_link'] = 'Last Page';
$config['last_tag_open'] = '<li class="page-item"><span class="lastlink">';
$config['last_tag_close'] = '</span></li>';

$config['next_link'] = 'Next Page';
$config['next_tag_open'] = '<li class="page-item"><span class="nextlink">';
$config['next_tag_close'] = '</span></li>';

$config['prev_link'] = 'Prev Page';
$config['prev_tag_open'] = '<li class="page-item"><span class="prevlink">';
$config['prev_tag_close'] = '</span></li>';

$config['cur_tag_open'] = '<li class="page-item active"><span class="curlink page-link">';
$config['cur_tag_close'] = '</span></li>';

$config['num_tag_open'] = '<li><span class="numlink">';
$config['num_tag_close'] = '</span></li>';
$config['anchor_class'] = 'page-link';