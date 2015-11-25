<?php
/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

namespace Admin\Controller;

use Process\StorageProcess;
use Zend\Mvc\Controller\AbstractActionController;

class AdminController extends AbstractActionController
{
    public function dashboardAction()
    {
        $storage = new StorageProcess($this->serviceLocator->get('adb'));
        return array();
    }

    public function ordersAction()
    {
        return array();
    }

}
