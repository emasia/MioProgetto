<?php

// No direct access
defined('_JEXEC') or die('Restricted access');

// import Joomla table library
jimport('joomla.database.table');

/**
 * Hello Table class
 */
class helloworldTablehelloworld extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	//mappatura oggetto tabella
	function __construct(&$db) 
	{
		parent::__construct('#__helloworld', 'id', $db);
	}
}
