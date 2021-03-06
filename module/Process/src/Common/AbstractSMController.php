<?php
/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Common;

use Storage\ConfigStorage;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Storage\SessionStorage;
use Storage\UserStorage;

abstract class AbstractSMController extends AbstractActionController
{
    const LOCATION_HOME				= 0;
	const LOCATION_ADMIN_DASHBOARD  = 1;
    const LOCATION_ADMIN_ORDERS     = 2;
    const LOCATION_ADMIN_STAMPTYPES = 3;
    const LOCATION_ADMIN_CONFIG     = 4;
    const LOCATION_ORDER_BEGIN		= 5;

    /**
     * @param MvcEvent $e
     * @return void
     */
    public function onDispatch(MvcEvent $e)
    {
        parent::onDispatch($e);
        $userStorage = new UserStorage($this->serviceLocator->get('ADB'));
        $userStorage->userLoggedIn();
        $loggedIn = SessionStorage::getValue('user-logged-in');
        $this->layout()->setVariable('loggedIn', $loggedIn);
        if ($loggedIn) {
            $this->layout()->setVariable('userData', $userStorage->fetchCurrentUser());
        } else {
            $this->layout()->setVariable('userData', ['username' => 'not logged in']);
        }
        $configStorage = new ConfigStorage($this->serviceLocator->get('ADB'));
        $this->layout()->setVariable('configuration', $configStorage->getConfiguration(1));
    }
}