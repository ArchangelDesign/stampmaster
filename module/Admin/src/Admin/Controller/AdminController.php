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
use Storage\SessionStorage;
use Storage\UserStorage;
use Storage\StampStorage;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractSMController
{
	public function onDispatch(MvcEvent $e)
	{
		if (!SessionStorage::userLoggedIn()) {
			$route = (string)$e->getRequest()->getUri();
			SessionStorage::setNextRoute($route);
			return $this->redirect()->toRoute('login-user');
		}
		parent::onDispatch($e);
	}

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
        
        $data = (array)$request->getPost();
        $data['user_created'] = SessionStorage::getUserId();
        $data['thumbnail'] = 'no-thumbnail.jpg';
        $data['large_image'] = 'no-thumbnail.jpg';
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
		$result = [];

		$id = $request->getQuery('id');
		$storage = new StampStorage($this->serviceLocator->get('adb'));

		if ($request->isPost()) {
			$postData = (array)$request->getPost();
			$postData['id'] = $id;
			if (!isset($postData['active'])) {
				$postData['active'] = 0;
			}
			$postData['user_modified'] = SessionStorage::getUserId();
			$storage->updateStampType($postData);
			$result['updated'] = true;
		}

		$stamp = $storage->fetchStamp($id);
		$result['stamp'] = $stamp;
		$result['error'] = false;

		if (empty($stamp)) {
			$result['error'] = true;
		}
		return $result;
	}

}
