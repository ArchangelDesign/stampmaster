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
use Common\XmlResponder;
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

        $vm->setTemplate('admin/config/empty.phtml');
        $post = $request->getPost();
        $token = $post['token'];
        $storedToken = $sessionStorage->getValue('set-config-value-token');
        $sessionStorage->setValue('set-config-value-token', null);

        if ($token != $storedToken) {
            echo XmlResponder::generalResponse('300', 'Invalid token provided');
            return $vm;
        }

        $id = isset($post['id'])?$post['id']:null;
        $c_name = $post['c_name'];
        $c_value = $post['c_value'];
        $e_value = $post['e_value'];

        $newId = $configStorage->setValue($c_name, $c_value);

        if (!empty($e_value)) {
            $configStorage->setExtendedValue($newId, $e_value);
        } else {
            // remove extension if exists
            $rec = $configStorage->getRecord($newId);
            if ($rec['extended'] > 0) {
                $configStorage->removeExtension($rec['extended']);
            }
        }
        echo XmlResponder::generalResponse('200', 'OK');
        return $vm;
    }
}