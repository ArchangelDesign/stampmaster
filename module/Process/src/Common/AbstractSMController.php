<?php

namespace Common;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Storage\SessionStorage;
use Storage\UserStorage;

abstract class AbstractSMController extends AbstractActionController
{
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
    }
}