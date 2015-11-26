<?php
/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Admin\Controller;

use Process\StorageProcess;
use Storage\UserStorage;
use Zend\Mvc\Controller\AbstractActionController;

class AdminController extends AbstractActionController
{
    public function dashboardAction()
    {
        $userStorage = new UserStorage($this->serviceLocator->get('adb'));
        return array(
            'allUsers' => $userStorage->fetchAllUsers(),
        );
    }

    public function ordersAction()
    {
        return array();
    }

}
