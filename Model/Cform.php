<?php
class Cform extends CformsAppModel {

	public $name = 'Cform';
	public $validate = array(
		'name' => array('notBlank'),
		'recipient' => array('email' => array(
						      'rule' => 'email',
						      'message' => 'Please include a valid email address',
						      'allowEmpty' => true
						      ))
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Next' => array(
			'className' => 'Cforms.Cform',
			'foreignKey' => 'next',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
		'FormField' => array(
			'className' => 'Cforms.FormField',
			'foreignKey' => 'cform_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'FormField.order',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Cforms.Submission'
	);

	/**
	 * Display fields for this model
	 *
	 * @var array
	 */
	protected $_displayFields = array(
		'id',
		'name',
		'recipient',
	);
}