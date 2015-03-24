<?php

// No direct access to this file
defined ( '_JEXEC' ) or die ( 'Restricted Access' );

$params = JComponentHelper::getParams('com_helloworld');
$show_category = $params->get('show_category');

?>
<h1><?php echo JFactory::getDocument()->getTitle(); ?></h1>
<form action="<?php echo JRoute::_('index.php?option=com_helloworld'); ?>" method="post" name="adminForm" id="adminForm">
	
<?php
	// Search tools bar
	echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
?>

	
	
	<table class="table table-striped">
			<thead>
				<tr>
					<th width="5"><?php echo Jtext::_('COM_HELLOWORLD_HELLOWORLD_HEADING_ID' ); ?></th>
					
					<th><?php echo Jtext ::_('COM_HELLOWORLD_HELLOWORLD_HEADING_GREETING' ); ?></th>
					<?php if ($show_category) {?>
					<th><?php echo Jtext ::_('Categoria' ); ?></th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
			<?php foreach($this->items as $i => $item): ?>
				<tr class="row<?php echo $i % 2; ?>">
					<td><?php echo $item->id; ?></td>
					
					<td><a
						href="<?php echo JRoute::_('index.php?option=com_helloworld&view=helloworld&id=' . $item->id); ?>">
						<?php echo $item->greeting; ?>
						</a></td>
						<?php if ($show_category) {?>
					<td><?php echo $item->categoria; ?></td>
					<?php } ?>
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
	
	
</form>
