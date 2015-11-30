<?php

namespace Display\Controller;

use Storage\UserStorage;
use Zend\Mvc\Controller\AbstractActionController;

class DisplayController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }

    public function orderBeginAction()
    {
        return array();
    }

    public function registerUserAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $userData = $request->getPost();
            unset($userData['password-confirm']);
            $userStorage = new UserStorage($this->serviceLocator->get('adb'));
            $outcome = $userStorage->registerUser($userData);
            return ['outcome' => $outcome];
        }
        return array();
    }
}
