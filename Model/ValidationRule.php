<?php
class ValidationRule extends CformsAppModel {

	public $name = 'ValidationRule';
	public $validate = array(
		'rule' => array('notBlank')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $hasAndBelongsToMany = array(
		'FormField' => array(
			'className' => 'Cforms.FormField',
			'joinTable' => 'cforms_form_fields_validation_rules',
			'foreignKey' => 'validation_rule_id',
			'associationForeignKey' => 'form_field_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}