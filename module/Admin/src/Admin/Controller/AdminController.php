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
use Storage\StampStorage;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractSMController
{
	private function _setLocation($location = self::LOCATION_ADMIN_DASHBOARD)
	{
		$this->layout()->setVariable('location', $location);
	}

    public function dashboardAction()
    {
    	$this->_setLocation();
        $userStorage = new UserStorage($this->serviceLocator->get('adb'));
        return array(
            'allUsers' => $userStorage->fetchAllUsers(),
            'location' => self::LOCATION_ADMIN_DASHBOARD,
        );
    }

    public function ordersAction()
    {
    	$this->_setLocation(self::LOCATION_ADMIN_ORDERS);
        return array(
            'location' => self::LOCATION_ADMIN_ORDERS,
        );
    }

    public function stampTypesAction()
    {
    	$this->_setLocation(LOCATION_ADMIN_STAMPTYPES);
        return array(
            'location' => self::LOCATION_ADMIN_STAMPTYPES,
        );
    }

    public function fetchStampTypesAction()
    {
        $vm = new ViewModel();
        $vm->setTerminal(true);
        $db = $this->serviceLocator->get('adb');
        $storage = new StampStorage($db);

        $allTypes = $storage->fetchAllStampTypes();

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
        $request = $this->getRequest();
        
        if (!$request->isPost()) {
            return $this->redirect()->toRoute('');
        }
        
        $data = $request->getPost();
        $storage = new StampStorage($this->serviceLocator->get('ADB'));
        $result = $storage->insertStampType($data);
        
        $vm = new ViewModel();
        $vm->setTerminal(true);
        $vm->setTemplate('admin/admin/empty.phtml');
        echo \Common\XmlResponder::generalResponse($result['code'], $result['message']);
        return $vm;
    }

    public function editStampTypeAction()
	{
		$request = $this->getRequest();

		$id = $request->getQuery('id');

		$storage = new StampStorage($this->serviceLocator->get('adb'));
		$stamp = $storage->fetchStamp($id);
		$result = [
			'stamp' => $stamp,
			'error' => false,
		];
		if (empty($stamp)) {
			$result['error'] = true;
		}
		return $result;
	}

}
