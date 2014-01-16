<div class="submissions index">
<h2><?php __('Submissions');?></h2>
<div class="actions">
    <?php echo $this->Html->link(__('%s Back to Index', '<i class="icon icon-arrow-left"></i>'), array('controller' => 'cforms', 'action' => 'index'),array('class' => 'btn btn-small','escape' => false)); ?> <?php if(!empty($this->params['pass'])){echo $this->Html->link(__('Export Records', true), array('controller' => 'submissions', 'action' => 'export', $this->params['pass'][0]),array('class' => 'btn btn-small btn-info'));} ?>
</div>
<p>

<table class="table table-striped">
<tr>
	<th><?php echo $this->Paginator->sort('id');?></th>
	<th><?php echo $this->Paginator->sort('cform_id');?></th>
	<th><?php echo $this->Paginator->sort('created');?></th>
	<th><?php echo $this->Paginator->sort('ip');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($submissions as $submission):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $submission['Submission']['id']; ?>
		</td>
		<td>
			<?php echo $this->Html->link($submission['Cform']['name'], array('controller' => 'cforms', 'action' => 'view', $submission['Cform']['id'])); ?>
		</td>
		<td>
			<?php echo $submission['Submission']['created']; ?>
		</td>
		<td>
			<?php echo $submission['Submission']['ip']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $submission['Submission']['id']),array('class' => 'btn btn-small')); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $submission['Submission']['id']),array('class' => 'btn btn-small')); ?>
			<?php //echo $this->Html->link(__('Export Record', true), array('controller' => 'submissions', 'action' => 'export', $submission['Submission']['id']),array('class' => 'btn btn-small btn-info')); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $submission['Submission']['id']),array('class' => 'btn btn-small btn-danger'), sprintf(__('Are you sure you want to delete # %s?', true), $submission['Submission']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="row-fluid">
	<div class="span12">
		<?php if ($pagingBlock = $this->fetch('paging')): ?>
			<?php echo $pagingBlock; ?>
		<?php else: ?>
			<?php if (isset($this->Paginator) && isset($this->request['paging'])): ?>
				<div class="pagination">
					<p>
					<?php
					echo $this->Paginator->counter(array(
						'format' => __d('croogo', 'Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
					));
					?>
					</p>
					<ul>
						<?php echo $this->Paginator->first('< ' . __d('croogo', 'first')); ?>
						<?php echo $this->Paginator->prev('< ' . __d('croogo', 'prev')); ?>
						<?php echo $this->Paginator->numbers(); ?>
						<?php echo $this->Paginator->next(__d('croogo', 'next') . ' >'); ?>
						<?php echo $this->Paginator->last(__d('croogo', 'last') . ' >'); ?>
					</ul>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>