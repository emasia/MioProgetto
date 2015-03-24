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
		$this->addToolBar ();
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
	protected function addToolBar() {
		JToolBarHelper::title ( JText::_ ( 'COM_HELLOWORLD_MANAGER_HELLOWORLDS' ), 'lamp' );
		
			JToolBarHelper::addNew ( 'helloworld.add', 'JTOOLBAR_NEW' );
			JToolBarHelper::editList ( 'helloworld.edit', 'JTOOLBAR_EDIT' );
			JToolBarHelper::deleteList ( '', 'helloworlds.delete', 'JTOOLBAR_DELETE' );
	
	}
	
}
