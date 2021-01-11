<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

function berita_tags_in_database($tags)
        {
                $ci = & get_instance();
                $query = $ci->db->get_where('berita_tags', array('slug' => $tags)); 
                        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
                if ($query->num_rows() == 0 )
                {
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }
function products_tags_in_database($tags)
        {
                $ci = & get_instance();
                $query = $ci->db->get_where('products_tags', array('slug' => $tags)); 
                        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
                if ($query->num_rows() == 0 )
                {
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }

function products_categories_in_database($categories)
        {
                $ci = & get_instance();
                $query = $ci->db->get_where('categories_lists', array('slug' => $categories,'group_id' => 5)); 
                        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
                if ($query->num_rows() == 0 )
                {
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }
function clients_tags_in_database($tags)
{
        $ci = & get_instance();
        $query = $ci->db->get_where('clients_tags', array('slug' => $tags)); 
                //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        if ($query->num_rows() == 0 )
        {
                return FALSE;
        }
        else
        {
                return TRUE;
        }
}
function clients_categories_in_database($categories)
{
        $ci = & get_instance();
        $query = $ci->db->get_where('categories_lists', array('slug' => $categories,'group_id' => 8)); 
                //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        if ($query->num_rows() == 0 )
        {
                return FALSE;
        }
        else
        {
                return TRUE;
        }
}
function gallery_tags_in_database($tags)
{
        $ci = & get_instance();
        $query = $ci->db->get_where('gallery_tags', array('slug' => $tags)); 
                //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        if ($query->num_rows() == 0 )
        {
                return FALSE;
        }
        else
        {
                return TRUE;
        }
}
function gallery_categories_in_database($categories)
{
        $ci = & get_instance();
        $query = $ci->db->get_where('categories_lists', array('slug' => $categories,'group_id' => 10)); 
                //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        if ($query->num_rows() == 0 )
        {
                return FALSE;
        }
        else
        {
                return TRUE;
        }
}
function projects_tags_in_database($tags)
{
        $ci = & get_instance();
        $query = $ci->db->get_where('projects_tags', array('slug' => $tags)); 
                //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        if ($query->num_rows() == 0 )
        {
                return FALSE;
        }
        else
        {
                return TRUE;
        }
}
function projects_categories_in_database($categories)
{
        $ci = & get_instance();
        $query = $ci->db->get_where('categories_lists', array('slug' => $categories,'group_id' => 7)); 
                //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        if ($query->num_rows() == 0 )
        {
                return FALSE;
        }
        else
        {
                return TRUE;
        }
}
function berita_categories_in_database($categories)
        {
                $ci = & get_instance();
                $query = $ci->db->get_where('categories_lists', array('slug' => $categories,'group_id' => 9)); 
                        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
                if ($query->num_rows() == 0 )
                {
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }
        
function tags_in_database($tags)
        {
                $ci = & get_instance();
                $query = $ci->db->get_where('tags', array('slug' => $tags)); 
                        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
                if ($query->num_rows() == 0 )
                {
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }
function categories_in_database($categories)
        {
                $ci = & get_instance();
                $query = $ci->db->get_where('categories_lists', array('slug' => $categories)); 
                        //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
                if ($query->num_rows() == 0 )
                {
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }


function services_tags_in_database($tags)
{
        $ci = & get_instance();
        $query = $ci->db->get_where('services_tags', array('slug' => $tags)); 
                //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        if ($query->num_rows() == 0 )
        {
                return FALSE;
        }
        else
        {
                return TRUE;
        }
}
function services_categories_in_database($categories)
{
        $ci = & get_instance();
        $query = $ci->db->get_where('categories_lists', array('slug' => $categories,'group_id' => 6)); 
                //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        if ($query->num_rows() == 0 )
        {
                return FALSE;
        }
        else
        {
                return TRUE;
        }
}
function sertifikat_tags_in_database($tags)
{
        $ci = & get_instance();
        $query = $ci->db->get_where('sertifikat_tags', array('slug' => $tags)); 
                //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        if ($query->num_rows() == 0 )
        {
                return FALSE;
        }
        else
        {
                return TRUE;
        }
}
function sertifikat_categories_in_database($categories)
{
        $ci = & get_instance();
        $query = $ci->db->get_where('categories_lists', array('slug' => $categories,'group_id' => 11)); 
                //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        if ($query->num_rows() == 0 )
        {
                return FALSE;
        }
        else
        {
                return TRUE;
        }
}
function staffs_tags_in_database($tags)
{
        $ci = & get_instance();
        $query = $ci->db->get_where('staffs_tags', array('slug' => $tags)); 
                //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        if ($query->num_rows() == 0 )
        {
                return FALSE;
        }
        else
        {
                return TRUE;
        }
}
function staffs_categories_in_database($categories)
{
        $ci = & get_instance();
        $query = $ci->db->get_where('categories_lists', array('slug' => $categories,'group_id' => 12)); 
                //$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        if ($query->num_rows() == 0 )
        {
                return FALSE;
        }
        else
        {
                return TRUE;
        }
}