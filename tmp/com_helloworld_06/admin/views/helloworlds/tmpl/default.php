<?php

// No direct access to this file
defined ( '_JEXEC' ) or die ( 'Restricted Access' );




?>
<form action="<?php echo JRoute::_('index.php?option=com_helloworld'); ?>" method="post" name="adminForm" id="adminForm">
	
	<div id="j-main-container" class="span10">
		<div class="clearfix"></div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="5"><?php echo JHTML::_('grid.sort', 'COM_HELLOWORLD_HELLOWORLD_HEADING_ID', 'id', $this->sortDirection, $this->sortColumn ); ?></th>
					<th><?php echo JHTML::_('grid.sort', 'COM_HELLOWORLD_HELLOWORLD_HEADING_GREETING', 'greeting', $this->sortDirection, $this->sortColumn ); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($this->items as $i => $item): ?>
				<tr class="row<?php echo $i % 2; ?>">
					<td><?php echo $item->id; ?></td>
					<td><?php echo $item->greeting; ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4"><?php echo $this->pagination->getListFooter(); ?></td>
				</tr>
			</tfoot>
		</table>


		<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		
		 <input type="hidden" name="filter_order" value="<?php echo $this->sortColumn; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $this->sortDirection; ?>" />
        
        
		<?php echo JHtml::_('form.token'); ?>
	</div>
	
	</div>
</form>
