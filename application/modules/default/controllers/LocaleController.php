<?php

class Default_LocaleController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        if (Zend_Validate::is($this->getRequest()->getParam('locale'), 'InArray', array('haystack' => array('en_US', 'de_DE', 'fr_FR')))) {
            $session = new Zend_Session_Namespace('rps.l10n');
            $session->locale = $this->getRequest()->getParam('locale');
        }

        // redirect to requesting URL
        $url = $this->getRequest()->getServer('HTTP_REFERER');
        $this->redirect($url);
    }


}

