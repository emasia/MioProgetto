<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the Joomla modellist library
jimport('joomla.application.component.modellist');

/**
 * helloworlds Model
 */
class helloworldModelhelloworlds extends JModelList
{
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return	string	An SQL query
	 */
	public function __construct($config = array())
	{
		$config['filter_fields'] = array('id','greeting');
		parent::__construct($config);
	}
	
	protected function getListQuery() 
	{
		// Create a new query object.
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		
		$search = $this->getState('filter.search');
		if (!empty($search)){
			$query->where("greeting like '%".$search."%'");
		}

		// Select some fields
		$query->select('id,greeting');

		// From the hello table
		$query->from('#__helloworld');
		
		$orderCol = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');
		
		$query->order($db->escape($orderCol.' '.$orderDirn));
			
		return $query;
	}
	protected function populateState($ordering = null, $direction =null)
	{
		parent::populateState('id', 'asc');
	}
	
}
