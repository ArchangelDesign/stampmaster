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
use Storage\ConfigStorage;
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
        return $vm;
    }
}