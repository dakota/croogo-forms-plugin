<?php
	$typeOptions['value'] = $field['options'];
	$typeOptions['type'] = 'text' ;
	
	if(!in_array($field['type'], $multiTypes)){
		$typeOptions['div'] = array('style' => 'display:none');
	}
	
	$row = array(
	'<i class="icon icon-arrow-right"></i>',
	$this->Form->hidden('FormField.' . $key . '.id', array('value' => $field['id'])) .
	$this->Form->input('FormField.' . $key . '.name', array('label' => false, 'value' => $field['name'])),
	$this->Form->input('FormField.' . $key . '.label', array('label' => false, 'value' => $field['label'])),
	$this->Form->input('FormField.' . $key . '.type', array('label' => false, 'value' => $field['type'])) .
	$this->Form->input('FormField.' . $key . '.options', $typeOptions),
	$this->Form->input('FormField.' . $key . '.required', array('label' => false, 'checked' => ($field['required']?'checked':''))),
	'<span class="btn btn-danger btn-small delete"><i class="icon icon-remove-sign"></i> Remove</span>' . $this->Html->link('Add Validation', array('controller' => 'form_fields', 'action' => 'edit', $field['id']), array('class' => 'validationLink btn btn-small'))
	);
	
	echo $this->Html->tableCells($row, array('class' => 'ui-state-default'),array('class' => 'ui-state-default'));
?>