<?php
/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Admin\Controller;

use Common\AbstractSMController;
use Process\StorageProcess;
use Storage\UserStorage;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractSMController
{
    public function dashboardAction()
    {
        $userStorage = new UserStorage($this->serviceLocator->get('adb'));
        return array(
            'allUsers' => $userStorage->fetchAllUsers(),
            'location' => 1
        );
    }

    public function ordersAction()
    {
        return array(
            'location' => 2
        );
    }

    public function stampTypesAction()
    {
        return array(
            'location' => 3
        );
    }

    public function fetchStampTypesAction()
    {
        $vm = new ViewModel();
        $vm->setTerminal(true);
        $db = $this->serviceLocator->get('adb');

        $allTypes = $db->fetchAll('stamp_types');

        $params = $this->params()->fromQuery();

        $page = isset($params['page'])?$params['page']:1;

        $vm->setVariables(
            [
                'stamps' => $allTypes
            ]
        );
        return $vm;
    }

    public function addStampTypeAction()
    {

    }

}
