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
	
		// Select some fields
		$query->select('id,greeting');

		// From the hello table
		$query->from('#__helloworld');
		$query->order($db->escape($this->getState('list.ordering', '1')).' '.$db->escape($this->getState('list.direction', 'ASC')));
		return $query;
	}
	
	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState();
	
		// Get list limit
		$app = JFactory::getApplication();
		$itemid = JRequest::getInt('Itemid', 0);
		$limit = $app->getUserStateFromRequest('com_helloworld.helloworlds.list' . $itemid . '.limit', 'limit', 10, 'uint');
		$this->setState('list.limit', $limit);
	}
}
