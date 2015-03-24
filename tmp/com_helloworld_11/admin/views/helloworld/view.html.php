<?php

// No direct access to this file
defined ( '_JEXEC' ) or die ( 'Restricted access' );

// import Joomla view library
jimport ( 'joomla.application.component.view' );

/**
 * helloworld View
 */
class helloworldViewhelloworld extends JViewLegacy {
	/**
	 * display method of Hello view
	 * 
	 * @return void
	 */
	public function display($tpl = null) {
		// get and assign the Data
		$this->form = $this->get ( 'Form' );
		$this->item = $this->get ( 'Item' );
		
		// Check for errors.
		if (count ( $errors = $this->get ( 'Errors' ) )) {
			JError::raiseError ( 500, implode ( '<br />', $errors ) );
			return false;
		}
		
		// Set the toolbar
		$this->addToolBar ();
		
		// Display the template
		parent::display ( $tpl );
		
		// Set the document
		$this->setDocument ();
	}
	
	/**
	 * Setting the toolbar
	 */
	protected function addToolBar() {
		JRequest::setVar ( 'hidemainmenu', true );
		$user = JFactory::getUser ();
		$userId = $user->id;
		$isNew = $this->item->id == 0;
		JToolBarHelper::title ( $isNew ? JText::_ ( 'COM_HELLOWORLD_MANAGER_HELLOWORLD_NEW' ) : JText::_ ( 'COM_HELLOWORLD_MANAGER_HELLOWORLD_EDIT' ), 'lamp' );
		
		JToolBarHelper::apply ( 'helloworld.apply', 'JTOOLBAR_APPLY' );
		JToolBarHelper::save ( 'helloworld.save', 'JTOOLBAR_SAVE' );
		JToolBarHelper::custom ( 'helloworld.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false );
		
		JToolBarHelper::cancel ( 'helloworld.cancel', 'JTOOLBAR_CANCEL' );
	}
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() {
		$isNew = $this->item->id == 0;
		$document = JFactory::getDocument ();
		$document->setTitle ( $isNew ? JText::_ ( 'COM_HELLOWORLD_HELLOWORLD_CREATING' ) : JText::_ ( 'COM_HELLOWORLD_HELLOWORLD_EDITING' ) );
	}
}
