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
            'city'          => '',
            'province'      => '',
            'zip'           => '',
            'street'        => '',
            'apartment'     => '',
            'shipment'      => '',
            'company'       => '',
            'tax_id'        => '',
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
            $storeSession = $userData['store-session'];
            unset($userData['password-confirm']);
            unset($userData['store-session']);
            $userStorage = new UserStorage($this->serviceLocator->get('adb'));
            $outcome = $userStorage->registerUser($userData, $storeSession);
            return ['outcome' => $outcome];
        }
        return [
            'userData' => $userData,
        ];
    }
}
