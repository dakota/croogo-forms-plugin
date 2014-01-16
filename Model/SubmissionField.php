<?php
class SubmissionField extends CformsAppModel {

	public $name = 'SubmissionField';
	public $validate = array(
		//'submission_id' => array('numeric'),
		//'form_field' => array('notempty')
	);

	public $belongsTo = array('Submission' => array('className' => 'Cforms.Submission'));

}