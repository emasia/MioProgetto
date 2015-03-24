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

	protected $state;
	
	
	function display($tpl = null) {
		
		$this->items = $this->get ( 'Items' ); //items=colonne della query effettuata dalla superclasse
		$this->state = $this->get ( 'State' );
		$this->pagination = $this->get ( 'Pagination' );
		
		$this->sortDirection = $this->state->get('list.direction');
		$this->sortColumn = $this->state->get('list.ordering');
		
		
		if (count ( $errors = $this->get ( 'Errors' ) )) {
			JError::raiseError ( 500, implode ( "\n", $errors ) );
			return false;
		}
		
		parent::display ( $tpl );
		
	}
	
	
}
