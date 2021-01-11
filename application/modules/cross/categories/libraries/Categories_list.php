<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * categories List
 *
 * @package Library
 * @author  Michał Śniatała <michal@sniatala.pl>
 * @license http://opensource.org/licenses/MIT  (MIT)
 * @since   Version 0.1
 */
class Categories_list
{
	/**
	* Holds an value of categories max levels.
	*
	* @var int
	*/
	public $max_levels;

	/**
	* Holds an value of configuration for dropdown list.
	*
	* @var array
	*/
	public $dropdown;

	//--------------------------------------------------------------------

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->load->config('categories/categories_list', TRUE);
		$this->lang->load('categories/categories_list');
		$this->load->model('categories/categories_list_model');
		$this->load->helper('categories/categories_list');

		$this->max_levels = $this->config->item('max_levels', 'categories_list');
		$this->dropdown   = $this->config->item('dropdown', 'categories_list');
	}

	//--------------------------------------------------------------------

	/**
	 * __call
	 *
	 * Acts as a simple way to call model methods without loads of alias'
	 *
	 * @param string $method    Method
	 * @param string $arguments Arguments
	 *
	 * @return mixed
	 */
	public function __call($method, $arguments)
	{
		if ( ! method_exists($this->categories_list_model, $method))
		{
			throw new Exception('Undefined method categories_list::' . $method . '() called');
		}

		return call_user_func_array(array($this->categories_list_model, $method), $arguments);
	}

	//--------------------------------------------------------------------

	/**
	 * __get
	 *
	 * Enables the use of CI super-global without having to define an extra variable.
	 *
	 * @param mixed $var Var
	 *
	 * @return	mixed
	 */
	public function __get($var)
	{
		return get_instance()->$var;
	}

	//--------------------------------------------------------------------

	/**
	 * Get all items from group to dropdown array
	 *
	 * @param int   $group_id Group id
	 * @param int   $exclude  Excluded id
	 * @param int   $level    Current level
	 * @param array &$tree    Tree array
	 *
	 * @return array
	 */
	public function get_all_for_dropdown($group_id = 1, $exclude = 0, $level = 0, &$tree = array())
	{
		$output = array();

		if ($level === 0)
		{
			$tree      = $this->get_all($group_id);
			$tree      = parse_children($tree);
			$output[0] = $this->dropdown['parent'];
		}

		if ( ! empty($tree))
		{
			foreach ($tree as &$leaf)
			{
				if ($exclude != (int) $leaf['id'])
				{
					$output[$leaf['id']] = str_repeat($this->dropdown['space'], $level) . ' ' . htmlspecialchars($leaf['name'], ENT_QUOTES, 'UTF-8');

					if ((($this->max_levels !== 0) && ($this->max_levels > $level + 1)) || ($this->max_levels === 0) || ($exclude === 0))
					{
						if (isset($leaf['children']) && ! empty($leaf['children']))
						{
							$output += $this->get_all_for_dropdown($group_id, $exclude, $level + 1, $leaf['children']);
						}
					}
				}
			}
		}

		return $output;
	}
}
/* End of file categories_list.php */
/* Location: ./libraries/categories_list.php */
