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
		$config['filter_fields'] = array('id','greeting','categoria');
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
		$query->select('a.id as id ,a.greeting as greeting,b.title as categoria');

		// From the hello table
		$query->from('#__helloworld a');
		$query->leftJoin('#__categories b on (a.catid=b.id)');
		$orderCol = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');
		
		$query->order($db->escape($orderCol.' '.$orderDirn));
			
		return $query;
	}
	protected function populateState($ordering = null, $direction =null)
	{
		parent::populateState('a.id', 'asc');
	}
	
}
