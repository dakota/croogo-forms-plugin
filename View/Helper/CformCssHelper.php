<?php
class CformCssHelper extends AppHelper {
    public $helpers = array('Html', 'Form', 'Js');

    public function beforeRender($viewFile) {
        if(!isset($this->params['admin']) || $this->params['admin'] == false){
            if($this->_View){
                $this->Html->script(array('/cforms/js/form/form.js'), array('once' => true, 'inline' => false));
            }
        }
    }
}