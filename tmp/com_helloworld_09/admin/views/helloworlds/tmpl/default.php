<?php

// No direct access to this file
defined ( '_JEXEC' ) or die ( 'Restricted Access' );



?>
<form action="<?php echo JRoute::_('index.php?option=com_helloworld'); ?>" method="post" name="adminForm" id="adminForm">

<div id="j-main-container">

<?php
	// Search tools bar
	echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
?>
	</div>
	
	<div id="j-main-container" class="span10">
		<div class="clearfix"></div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="5"><?php echo Jtext::_('COM_HELLOWORLD_HELLOWORLD_HEADING_ID' ); ?></th>
						<th width="20"><?php echo JHtml::_('grid.checkall'); ?></th>
				
					<th><?php echo Jtext ::_('COM_HELLOWORLD_HELLOWORLD_HEADING_GREETING' ); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($this->items as $i => $item): ?>
				<tr class="row<?php echo $i % 2; ?>">
					<td><?php echo $item->id; ?></td>
					<td><?php echo JHtml::_('grid.id', $i, $item->id); ?></td>
					
					<td><a
						href="<?php echo JRoute::_('index.php?option=com_helloworld&task=helloworld.edit&id=' . $item->id); ?>">
						<?php echo $item->greeting; ?>
						</a></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3"><?php echo $this->pagination->getListFooter(); ?></td>
				</tr>
			</tfoot>
		</table>


		<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	
	</div>
</form>
