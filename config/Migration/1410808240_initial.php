<?php
class Initial extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 * @access public
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'cforms_cforms' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'recipient' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'next' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'unsigned' => true),
					'redirect' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'action' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'from' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'auto_confirmation' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
					'require_ssl' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
					'hide_after_submission' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
					'success_message' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
				'cforms_form_fields' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
					'name' => array('type' => 'string', 'null' => false, 'default' => 'New Field', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'label' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'comment' => 'text', 'charset' => 'latin1'),
					'length' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'unsigned' => true, 'comment' => '255'),
					'null' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'default' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'cform_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'unsigned' => true),
					'required' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
					'order' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'unsigned' => true),
					'options' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'depends_on' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'depends_value' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
				'cforms_form_fields_validation_rules' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
					'form_field_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'unsigned' => true),
					'validation_rule_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'unsigned' => true),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
				'cforms_submission_fields' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
					'submission_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'unsigned' => true),
					'form_field' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'response' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
				'cforms_submissions' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
					'cform_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'unsigned' => true),
					'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
					'ip' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4, 'unsigned' => true),
					'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'page' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
				'cforms_validation_rules' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
					'rule' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'message' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
			),
		),
		'down' => array(
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 * @access public
 */
	public function after($direction) {
		$rules = ClassRegistry::init('Cforms.ValidationRule');
	    if ($direction === 'up') {
	        // add initial records
	        $data[0] = array('id' => 1, 'rule' => 'email', 'message' => 'Please enter a valid email address.', 'name' => 'Email');
			$data[1] = array('id' => 3, 'rule' => 'alphaNumeric', 'message' => 'This field may only contain letters and numbers.', 'name' => 'AlphaNumeric');
			$data[2] = array('id' => 4, 'rule' => 'cc', 'message' => 'Please enter a valid credit card number.', 'name' => 'Credit Card');
			$data[3] = array('id' => 5, 'rule' => 'date', 'message' => 'Please enter a valid date.', 'name' => 'Date');
			$data[4] = array('id' => 6, 'rule' => 'decimal', 'message' => 'Please enter a decimal number.', 'name' => 'Decimal');
			$data[5] = array('id' => 7, 'rule' => 'money', 'message' => 'Please enter a valid monetary amount.', 'name' => 'Money');
			$data[6] = array('id' => 8, 'rule' => 'numeric', 'message' => 'Please enter a valid whole number.', 'name' => 'Numeric');
			$data[7] = array('id' => 9, 'rule' => 'phone', 'message' => 'Please enter a valid US phone number.', 'name' => 'Phone(US)');
			$data[8] = array('id' => 10, 'rule' => 'postal', 'message' => 'Please enter a valid Postal Code.', 'name' => 'Postal Code');
			$data[9] = array('id' => 11, 'rule' => 'ssn', 'message' => 'Please enter a valid Social Security Number.', 'name' => 'SSN');
			$data[10] = array('id' => 12, 'rule' => 'url', 'message' => 'Please enter a valid URL.', 'name' => 'Url');
	        $rules->create();
	        if ($rules->saveAll($data)) {
	        	if ($this->callback != null) {
	            	$this->callback->out('Initial Validation rules have been created.');
				}
	        }
	    } elseif ($direction === 'down') {
	        //do removal work here.
	    }

		return true;
	}
}
