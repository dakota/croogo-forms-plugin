<?php
Croogo::hookRoutes('Cforms');
Croogo::hookComponent('Nodes', 'Cforms.Cforms');
Croogo::hookHelper('Nodes', 'Cforms.CformCss');
//Croogo::hookAdminMenu('Cforms');

/**
 * Admin menu (navigation)
 */
CroogoNav::add('content.children.cforms', array(
	'title' => 'Contact Forms',
	'url' => '#',
	'children' => array(
		'index' => array(
			'title' => 'List Forms',
			'url' => array(
				'admin' => true,
				'plugin' => 'cforms',
				'controller' => 'cforms',
				'action' => 'index',
			),
		),
		'add' => array(
			'title' => 'Create Form',
			'url' => array(
				'admin' => true,
				'plugin' => 'cforms',
				'controller' => 'cforms',
				'action' => 'add',
			),
		),
		'validate' => array(
			'title' => 'Validation Rules',
			'url' => array(
				'admin' => true,
				'plugin' => 'cforms',
				'controller' => 'validation_rules',
				'action' => 'index',
			)
		)
	)
));