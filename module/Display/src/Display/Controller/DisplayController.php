<?php
/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Display\Controller;

use Storage\SessionStorage;
use Storage\UserStorage;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;

/**
 * Class DisplayController
 *
 * @package Display\Controller
 */
class DisplayController extends AbstractActionController
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
    }

    public function indexAction()
    {
        return array();
    }

    /**
     * @return array
     */
    public function orderBeginAction()
    {
        return array();
    }

    /**
     * @return array
     */
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
            $outcome = $userStorage->registerUser($userData, $storeSession);

            if ($outcome['result']) {
                return $this->redirect()->toRoute('display-index');
            }

            return [
                'outcome'   => $outcome,
                'userData'  => $userData,
            ];
        }
        return [
            'userData' => $userData,
        ];
    }

    /**
     * @return array|\Zend\Http\Response
     */
    public function loginUserAction()
    {
        $req = $this->getRequest();

        if ($req->isPost()) {
            $data = $req->getPost();
            $storage = new UserStorage($this->serviceLocator->get('ADB'));
            $res = $storage->loginUser($data['username'], $data['password'], true);

            if ($res['result']) {
                return $this->redirect()->toRoute('display-index');
            }

            return [
                'outcome' => $res,
                'username' => $data['username'],
            ];
        }
        return [];
    }

    /**
     * @return \Zend\Http\Response
     */
    public function logoutUserAction()
    {
        $storage = new UserStorage($this->serviceLocator->get('ADB'));
        $storage->logout();
        return $this->redirect()->toRoute('display-index');
    }
}
