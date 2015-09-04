<?php

$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => $this->Theme->getIcon('home')))
	->addCrumb(__d('cforms', 'Forms'), '/' . $this->request->url);

$this->append('actions');
echo $this->Croogo->adminAction(
	__d('croogo', 'Create form'),
	array('action' => 'add'),
	array('button' => 'success')
);
$this->end();

$this->start('table-heading');
$tableHeaders = $this->Html->tableHeaders(array(
	$this->Paginator->sort('id', __d('croogo', 'Id')),
	$this->Paginator->sort('name', __d('croogo', 'Name')),
	$this->Paginator->sort('recipient', __d('croogo', 'Recipient')),
	''
));
echo $this->Html->tag('thead', $tableHeaders);
$this->end();

$this->append('table-body');
?>
	<tbody>
	<?php foreach ($cforms as $cform): ?>
		<tr>
			<td><?php echo $cform['Cform']['id']; ?></td>
			<td><?php echo $cform['Cform']['name']; ?></td>
			<td><?php echo $cform['Cform']['recipient']; ?></td>
			<td>
				<div class="item-actions">
					<?php
					echo $this->Croogo->adminRowActions($cform['Cform']['id']);

					echo ' ' . $this->Croogo->adminRowAction('',
							array('controller' => 'submissions', 'action' => 'index', $cform['Cform']['id']),
							array('icon' => $this->Theme->getIcon('inbox'), 'tooltip' => __d('cforms', 'View Submissions'))
						);

					echo ' ' . $this->Croogo->adminRowAction('',
							array('controller' => 'submissions', 'action' => 'export', $cform['Cform']['id']),
							array('icon' => $this->Theme->getIcon('download-alt'), 'tooltip' => __d('cforms', 'Export Submissions'))
						);

					echo ' ' . $this->Croogo->adminRowAction('',
							array('action' => 'edit', $cform['Cform']['id']),
							array('icon' => $this->Theme->getIcon('update'), 'tooltip' => __d('cforms', 'Edit this item'))
						);

					echo ' ' . $this->Croogo->adminRowAction('',
							array('action' => 'delete', $cform['Cform']['id']),
							array('icon' => $this->Theme->getIcon('delete'), 'tooltip' => __d('cforms', 'Remove this item')),
							__d('croogo', 'Are you sure?')
						);
					?>
				</div>
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
<?php
$this->end();
