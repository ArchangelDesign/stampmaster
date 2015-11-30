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
        $userData = [
            'first_name'    => '',
            'last_name'     => '',
            'email'         => '',
            'username'      => '',
        ];

        if ($request->isPost()) {
            $userData = $request->getPost();
            if ($userData['password'] != $userData['password-confirm']) {
                return [
                    'outcome' => [
                        'result' => false, 'msg' => 'Passwords do not match'
                    ],
                    'userData' => $userData,
                ];
            }
            unset($userData['password-confirm']);
            $userStorage = new UserStorage($this->serviceLocator->get('adb'));
            $outcome = $userStorage->registerUser($userData);
            return ['outcome' => $outcome];
        }
        return [
            'userData' => $userData,
        ];
    }
}
