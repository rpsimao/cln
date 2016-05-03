<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{


    /**
     * Autoloder Namespaces Resources for Modules
     * @throws Zend_Loader_Exception
     */
    protected function _initAppAutoload ()
    {
        new Zend_Application_Module_Autoloader(array('namespace' => '', 'basePath' => APPLICATION_PATH));

        $loader = new Zend_Loader_Autoloader_Resource(array('basePath'  => APPLICATION_PATH .'/modules/users', 'namespace' => 'Users'));
        $loader->addResourceType('form', 'forms', 'Form')
            ->addResourceType('model', 'models', 'Model')
            ->addResourceType('dbtable', 'models/DbTable', 'Model_DbTable');


        $loader = new Zend_Loader_Autoloader_Resource(array('basePath'  => APPLICATION_PATH .'/modules/default', 'namespace' => 'Default'));
        $loader->addResourceType('form', 'forms', 'Form')
            ->addResourceType('model', 'models', 'Model')
            ->addResourceType('dbtable', 'models/DbTable', 'Model_DbTable');

        $loader = new Zend_Loader_Autoloader_Resource(array('basePath'  => APPLICATION_PATH .'/modules/clients', 'namespace' => 'Clients'));
        $loader->addResourceType('form', 'forms', 'Form')
            ->addResourceType('model', 'models', 'Model')
            ->addResourceType('dbtable', 'models/DbTable', 'Model_DbTable');

        $loader = new Zend_Loader_Autoloader_Resource(array('basePath'  => APPLICATION_PATH .'/modules/clinic', 'namespace' => 'Clinic'));
        $loader->addResourceType('form', 'forms', 'Form')
            ->addResourceType('model', 'models', 'Model')
            ->addResourceType('dbtable', 'models/DbTable', 'Model_DbTable');


        $loader = new Zend_Loader_Autoloader_Resource(array('basePath'  => APPLICATION_PATH .'/modules/appointments', 'namespace' => 'Appointments'));
        $loader->addResourceType('form', 'forms', 'Form')
            ->addResourceType('model', 'models', 'Model')
            ->addResourceType('dbtable', 'models/DbTable', 'Model_DbTable');

        $loader = new Zend_Loader_Autoloader_Resource(array('basePath'  => APPLICATION_PATH .'/modules/consult', 'namespace' => 'Consult'));
        $loader->addResourceType('form', 'forms', 'Form')
               ->addResourceType('model', 'models', 'Model')
               ->addResourceType('dbtable', 'models/DbTable', 'Model_DbTable');


    }



    /*
    protected function _initRegisterPlugins()
    {
        $plugin = new RPS_Plugins_Controllers_Auth();
        Zend_Controller_Front::getInstance()->registerPlugin($plugin);
    }
     */



    /**
     * Define the Language
     * Load files for the translation
     * @uses GETTEXT
     */

    protected function _initTranslate()
    {

        $locale = null;


        $session = new Zend_Session_Namespace('rps.l10n');
        if ($session->locale) {
            $locale = new Zend_Locale($session->locale);
        }

        if ($locale === null) {

            try {
                $locale = new Zend_Locale('fr_FR');
            } catch (Zend_Locale_Exception $e) {
                $locale = new Zend_Locale('browser');
            }
        }

        $registry = Zend_Registry::getInstance();
        $registry->set('Zend_Locale', $locale);

        $translate = new Zend_Translate('gettext', APPLICATION_PATH . '/languages/fr_FR/fr_FR.mo', 'fr_FR');
        $translate->getAdapter()->addTranslation(  APPLICATION_PATH . '/languages/de_DE/de_DE.mo', 'de_DE');
        $translate->getAdapter()->addTranslation(  APPLICATION_PATH . '/languages/en_GB/en_GB.mo', 'en_GB');
        $translate->getAdapter()->addTranslation(  APPLICATION_PATH . '/languages/en_GB/en_GB.mo', 'en_US');
        $translate->getAdapter()->setLocale(Zend_Locale::findLocale());
        $registry = Zend_Registry::getInstance();
        $registry->set('Zend_Translate', $translate);


    }

    /**
     *
     * Load the language for the validation errors
     * @uses Zend_Framework validators errors
     * It wiil be load from the application, not from the Zend Framework path
     */

    protected function _initValidateTranslation()
    {

        $translator = new Zend_Translate(
            array(
                'adapter' => 'array',
                'content' => APPLICATION_PATH . '/languages/resources/languages',
                'locale'  => Zend_Locale::findLocale(),
                'scan'    => Zend_Translate::LOCALE_DIRECTORY
            )
        );
        Zend_Validate_Abstract::setDefaultTranslator($translator);



    }


    /**
     * Fires up layout and view helper
     */
    protected function _initHeader ()
    {

        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $view->addHelperPath("RPS/Views/Helper", "RPS_Views_Helper");

    }

    /**
     * Custom Routes
     */
    protected function _initRoutes ()
    {


        $router = Zend_Controller_Front::getInstance()->getRouter();

        $route = new Zend_Controller_Router_Route('clinic/client/:id', array(
            'module' => "clinic",
            'controller' => 'client',
            'action' => 'index'));
        $router->addRoute('clinic_client_index', $route);


        $route = new Zend_Controller_Router_Route('clients/dashboard/:id', array(
            'module' => "clients",
            'controller' => 'dashboard',
            'action' => 'index'));
        $router->addRoute('clients_dashboard_index', $route);


        $route = new Zend_Controller_Router_Route('appointments/edit/:id', array(
            'module' => "appointments",
            'controller' => 'edit',
            'action' => 'index'));
        $router->addRoute('appointments_edit_index', $route);

    }

    protected function _initLogging() {

        $logsDir = APPLICATION_PATH.'/logs/';

        if (!is_dir($logsDir)) @mkdir($logsDir, 0755);

        // init error logger
        $logger = new Zend_Log();

        $writer = new Zend_Log_Writer_Stream($logsDir.'application.log');
        $logger->addWriter($writer);

        return $logger;

    }


}

