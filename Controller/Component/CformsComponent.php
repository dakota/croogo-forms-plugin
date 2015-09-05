<?php

App::uses('CakeEmail', 'Network/Email');

class CformsComponent extends Object{

    public $components = array('RequestHandler');

/**
 * Holds the data required to build the form
 *
 * @var array
 * @access public
 */
    public $formData;

/**
 * Holds the path to the view variable  in $this->request->controller->viewVars
 * which contains the {cform_ID} tag
 *
 * $this->viewVar = 'page/Page/content'
 * would be the path for a view variable $page['Page']['content']
 *
 * Overridden with the controller beforeFilter() or Component init
 *
 * @var string
 * @access public
 */
    public $viewVar = null;


/**
 * Which action/views the component will look for
 * the {cform_ID} tag and replace it with the form,
 * where ID is the id of the form to show
 *
 * Overridden with the controller beforeFilter() or Component init
 *
 * @var string
 * @access public
 */
    public $actions = array();


/**
 * Pointer to view variable which contains content to check for
 * {cform_ID} tag
 *
 * @var array
 * @access public
 */
    public $content;

/**
 * Whether or not the form has been successfuly submitted
 *
 * @var boolean
 * @access public
 */
    public $submitted = false;
		
    public function beforeRedirect($controller, $url, $status=null, $exit=true){
    }

/**
 * Sets Controller values, loads Cform.Form model
 *
 * @param string $content Content to render
 * @return array Email ready to be sent
 * @access public
 *
 */
    function initialize($controller, $settings = array()) {
        $this->request->controller =& $controller;

        $this->Form = ClassRegistry::init('Cforms.Form');
        $this->Submission = ClassRegistry::init('Cforms.Submission');

        if(empty($settings)){
            Configure::load('Cforms.cforms');
            $settings =  Configure::read('Cforms');
        }

        if(!empty($settings['email'])){
                foreach($settings['email'] as $key => $setting){
                        $this->Email->{$key} = $setting;
                }
        }

        if(!empty($settings['viewVar'])){
                $this->viewVar = $settings['viewVar'];
        }

        if(!empty($settings['actions'])){
                if(is_string($settings['actions'])){
                        $settings['actions'] = array($settings['actions']);
                }
                $this->actions = $settings['actions'];
        }
    }

/**
 * Loads Cform helper.
 * Checks for form submission, if so, calls $this->submit() to process it
 * Called after the Controller::beforeFilter() and before the controller action
 *
 * @access public
 * @param object $controller Controller with components to startup
 * @return void
 */
    function startup($controller){
        $this->request->controller = $controller;
        $this->request->controller->set('cformsComponent', 'CformsComponent startup');
        $this->request->controller->helpers[] = "Cforms.Cakeform";

        if(!empty($this->request->controller->data['Cform']['submitHere']) && $this->request->controller->data['Cform']['id']){
               $this->submit();
        }
    }

/**
 * If autoParse is set to true, gets view variable content
 * and replaces it with rendered content
 *
 * @access public
 */
    function beforeRender($controller){
        Configure::write('Admin.menus.cforms', 1);
        $controller->set('cformsHookBeforeRender', 'CformsHook beforeRender');

        $this->request->controller = $controller;
        if(!empty($this->viewVar) && in_array($this->request->controller->action, $this->actions)){
            if($this->getContent()){
                $this->content = $this->insertForm($this->content);
            }
        }
    }


/**
 * sets $this->content to the content of the view variable
 *
 * @access public
 */
    function getContent(){
        $content_to_replace = '';
        $keys = explode('/', $this->viewVar);
        $this->content =& $this->request->controller->viewVars;

        foreach($keys as $key){
            $this->content =& $this->content[$key];
        }

        if(!empty($this->content) && is_string($this->content)){
            return true;
        } else {
            return false;
        }
    }

/**
 * parses $this->content and replaces {cform_ID} with the form
 *
 * @param string $content The content to parse
 *
 * @access public
 */
    function insertForm($content){
        $newcontent = '';
        //$pattern = '/({cform_)([0-9])*[}]/';

        $start = strpos($content, '{cform_');
        $end = strpos($content, '}', $start);
        $replace = substr($content, $start, $end + 1 - $start);

        if(strlen($replace) > 8){ #make sure it at least the length of {cform_1}
            $length = strlen($replace) - 2;

            $formId = substr($replace, 1, $length);
            $formId = explode('_', $formId);
            $formId = $formId[1];

            $formData = $this->loadForm($formId);

            if(!empty($formData)){
                    $newcontent = $this->__renderForm($formData);
            }

            if(!empty($newcontent)){
                    $content = str_replace($replace, $newcontent, $content);
            }
        }

        return $content;
    }

/**
 * Render the form
 *
 * @param string $formData Data used to build form
 *
 * @return string The rendered form
 * @access private
 */
 
	function __renderForm($formData) {
        $content = '';
        
        App::uses('View','View');        
		$viewClass = $this->request->controller->view;
		if ($viewClass != 'View') {
			if (strpos($viewClass, '.') !== false) {
				list($plugin, $viewClass) = explode('.', $viewClass);
			}
			$viewClass = 'View';
			//App::import('View', $this->request->controller->view);
		}

        $View = new $viewClass($this->request->controller);
        $View->plugin = 'Cforms';
        $content = $View->element('form', array('formData' => $formData));

        ClassRegistry::removeObject('view');

        return $content;
	}

/**
 * Loads the data to create the form, calls model to build
 * schema and validation
 *
 * @return array Data used to build form
 * @access public
 */
    function loadForm($id){
        if(empty($this->formData) || $this->formData['Cform']['id'] != $id){
            $this->formData = $this->Form->buildSchema($id);
        }

        $this->formData['Cform']['submitted'] = $this->submitted;

        return $this->formData;
    }

/**
 * Processes form
 *
 * @return bool true if form is successfuly saved to db
 * @access public
 */
    function submit(){
        $id = $this->request->controller->data['Cform']['id'];

        $this->loadForm($id);
        $uploadsProcessed = $this->_processUploads();

        $validate = $this->request->controller->data;
        foreach($validate['Form'] as $field){
            if(is_array($field)){
                $field = implode("\n", $field);
            }
        }

        $this->Form->set($validate);
        if($uploadsProcessed && $this->Form->validates()){
            $form = Hash::merge($this->request->controller->data, $this->formData);

            if(!empty($form['Form']['email'])){
                $form['Submission']['email'] = $form['Form']['email'];
            }
            $form['Submission']['cform_id'] = $id;


            $controllerMethods = get_class_methods($this->request->controller);
            $saveToDb = true;
            if(in_array('beforeFormSave', $controllerMethods)) {
                $saveToDb = $this->request->controller->beforeFormSave($form);
            }

            if($saveToDb && $this->Submission->submit($form)){

                if(in_array('afterFormSave', $controllerMethods)) {
                    $this->request->controller->afterFormSave($this->Submission->id, $form);
                } else {
                    $this->request->controller->Session->setFlash(__("Thank you! Your form has been submitted."));

                    $this->send($form);
                }

                if(!empty($form['Cform']['redirect'])){
                    $this->request->controller->redirect($form['Cform']['redirect']);
                }

                return true;
            } else {
                $this->request->controller->Session->setFlash(__("There was a problem saving your submission. Please check for errors and try again."));

                return false;
            }
        } else {
            $this->request->controller->Session->setFlash(__("There was a problem saving your submission. Please check this form for errors or omissions and try again."));
            return false;
        }
    }
/**
 * Emails form
 *
 * @todo allow configuration
 *
 * @return bool true if form is successfuly sent
 * @access public
 */
	function send($response){
        $email = new CakeEmail('default');
        $email->emailFormat('both')
            ->from($this->formData['Cform']['from'])
            ->to($this->formData['Cform']['recipient'])
            ->subject(__('[%s] New %s Submission', Configure::read('Site.title'), $response['Cform']['name']))
            ->template('Cforms.submission')
            ->viewVars(array(
                'response' => $response,
            ));

        $success = true;

        try {
            $email->send();
        } catch (SocketException $e) {
            $this->Session->setFlash('Error sending contact notification: %s', $e->getMessage());
            $this->log(sprintf('Error sending contact notification: %s', $e->getMessage()));

            $success = false;
        }

        return $success;
	}











/**
 * Processes any uploaded files
 *
 *
 *
 */
    private function _processUploads(){
        $files = array();
        foreach($this->request->controller->data['Form'] as $key => $formField){

                if( is_array($formField) && array_key_exists('tmp_name', $formField) && array_key_exists('name', $formField)){

                        if(empty($formField['tmp_name'])){
                                $this->request->controller->data['Form'][$key] = null;

                        } else {
                                $i = null;
                                $duplicate = true;

                                while($duplicate == true){

                                        $full_path = WWW_ROOT . DS . '..' . DS . $this->settings['uploadPath'] . $i . $formField['name'];
                                        $short_path = APP . DS . $this->settings['uploadPath'] . $i . $formField['name'];

                                        if(!file_exists($full_path)){
                                                $duplicate = false;
                                                if(is_uploaded_file($formField['tmp_name']) && move_uploaded_file($formField['tmp_name'], $full_path)){
                                                        $formField = "http://" . $_SERVER['SERVER_NAME'] . Router::url(array('plugin' => 'cforms', 'controller' => 'submissions', 'action' => 'view_upload', base64_encode($full_path)));
                                                        $files[] = $full_path;
                                                } else {
                                                        foreach($files as $file){
                                                                unlink($file);
                                                        }
                                                        return false;
                                                }
                                        }
                                        $i++;
                                }
                        }
                }
        }
        return true;
    }

/**
 * Called after Controller::render() and before the output is printed to the browser.
 *
 * @param object $controller Controller with components to shutdown
 * @return void
 */
    public function shutdown($controller) {
    }

}