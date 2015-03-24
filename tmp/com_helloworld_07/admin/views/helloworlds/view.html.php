<?php

// No direct access to this file
defined ( '_JEXEC' ) or die ( 'Restricted access' );

// import Joomla view library
jimport ( 'joomla.application.component.view' );

/**
 * helloworlds View
 */
class helloworldViewhelloworlds extends JViewLegacy {
	/**
	 * helloworlds view display method
	 *
	 * @return void
	 */
	protected $items;
	protected $pagination;
	
	
	function display($tpl = null) {
		
		$this->items = $this->get ( 'Items' );
		$this->pagination = $this->get ( 'Pagination' );
		$this->filterForm    = $this->get('FilterForm');
		
		if (count ( $errors = $this->get ( 'Errors' ) )) {
			JError::raiseError ( 500, implode ( "\n", $errors ) );
			return false;
		}
		
		parent::display ( $tpl );
		$this->setDocument ();
	}
	
	
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() {
		$document = JFactory::getDocument ();
		$document->setTitle ( JText::_ ( 'COM_HELLOWORLD_ADMINISTRATION' ) );
	}
	
	
}
