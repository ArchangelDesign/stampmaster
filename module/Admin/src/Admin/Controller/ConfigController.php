<?php

/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Admin\Controller;

use Common\AbstractSMController;
use Common\Common;
use Process\StorageProcess;
use Storage\ConfigStorage;
use Storage\SessionStorage;
use Storage\UserStorage;
use Storage\StampStorage;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\View;

class ConfigController extends AbstractSMController
{
    public function generalConfigAction()
    {
        $storage = new ConfigStorage($this->serviceLocator->get('adb'));
        $v = $storage->getValue('test-value');
        echo $v;
        return [
            'entireConfig' => $storage->getConfiguration(null),
            'location'  => self::LOCATION_ADMIN_CONFIG,
        ];
    }

    public function setConfigValueAction()
    {
        $vm = new ViewModel();
        $vm->setTerminal(true);
        $sessionStorage = new SessionStorage();
        $configStorage = new ConfigStorage($this->serviceLocator->get('adb'));
        $request = $this->getRequest();

        if (!$request->isPost()) {
            $id = $this->params()->fromQuery('id');
            if ($id === null) {
                // no config value id given
                $vm->setVariable('error', true);
                return $vm;
            }
            $currentValue = $configStorage->getRecord($id);
            $token = Common::generateToken();
            $vm->setVariables([
                    'token'     => $token,
                    'id'        => $id,
                    'c_name'    => $currentValue['c_name'],
                    'c_value'   => $currentValue['c_value'],
                    'e_value'   => $currentValue['e_value'],
                ]
            );
            $sessionStorage->setValue('set-config-value-token', $token);
            return $vm;
        }

        $post = $request->getPost();
        $token = $post['token'];

        $vm->setTemplate('admin/config/empty.phtml');
        return $vm;
    }
}