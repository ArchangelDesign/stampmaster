<?php

namespace Display\Controller;

use Storage\SessionStorage;
use Storage\UserStorage;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;

class DisplayController extends AbstractActionController
{

    public function onDispatch(MvcEvent $e)
    {
        parent::onDispatch($e);
        $userStorage = new UserStorage($this->serviceLocator->get('ADB'));
        $userStorage->userLoggedIn();
        $loggedIn = SessionStorage::getValue('user-logged-in');
        $this->layout()->setVariable('loggedIn', $loggedIn);
        echo "dispatched";
    }

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
                        'result'    => false,
                        'msg'       => 'Passwords do not match'
                    ],
                    'userData' => $userData,
                ];
            }
            $storeSession = isset($userData['store-session'])?true:false;
            unset($userData['password-confirm']);
            unset($userData['store-session']);
            $userStorage = new UserStorage($this->serviceLocator->get('adb'));
            var_dump($storeSession);
            $outcome = $userStorage->registerUser($userData, $storeSession);
            return [
                'outcome'   => $outcome,
                'userData'  => $userData,
            ];
        }
        return [
            'userData' => $userData,
        ];
    }
}
