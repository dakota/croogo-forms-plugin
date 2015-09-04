<?php
$this->extend('/Common/admin_edit');

$this->Html
    ->addCrumb('', '/admin', array('icon' => $this->Theme->getIcon('home')))
    ->addCrumb(__d('cforms', 'Forms'), array('controller' => 'cforms', 'action' => 'index'))
    ->addCrumb(__d('cforms', 'Add'), '/' . $this->request->url);

$this->append('tab-content');
    echo $this->Form->input('name');
$this->end();

$this->start('panels');
echo $this->Html->beginBox(__d('croogo', 'Actions')) .
    $this->Form->button(__d('croogo', 'Next'), array('button' => 'success')) .
    $this->Html->link(__d('croogo', 'Cancel'), array('action' => 'index'), array('class' => 'cancel btn btn-danger'));

echo $this->Html->endBox();

echo $this->Croogo->adminBoxes();

$this->end();

$this->append('form-end', $this->Form->end());
?>