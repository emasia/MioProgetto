<?php

// No direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );

?>
<form
	action="<?php echo JRoute::_('index.php?option=com_helloworld&layout=edit&id='.(int) $this->item->id); ?>"
	method="post" name="adminForm" id="adminForm"
	class="form-validate">

	<div class="row-fluid">
		<div class="span10 form-horizontal">
			<fieldset>
<?php
echo JHtml::_ ( 'bootstrap.startPane', 'myTab', array ('active' => 'details') );
?>
<?php

echo JHtml::_ ( 'bootstrap.addPanel', 'myTab', 'details', empty ( $this->item->id ) ? JText::_ ( 'COM_FOLIO_NEW_FOLIO', true ) : JText::sprintf ( 'COM_FOLIO_EDIT_FOLIO', $this->item->id, true ) );
?>
<div class="control-group">
<?php foreach($this->form->getFieldset('details') as $field): ?>
<div class="control-label"><?php echo $field->label;?></div>
					<div class="controls"><?php echo $field->input;?></div>
				
<?php endforeach; ?>
					
				</div>
<?php echo JHtml::_('bootstrap.endPanel'); ?>
<input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>
<?php echo JHtml::_('bootstrap.endPane'); ?>
</fieldset>
		</div>
	</div>





</form>