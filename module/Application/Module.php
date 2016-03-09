<?php

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $e->getApplication()
            ->getServiceManager()
            ->get('MvcTranslator')
            ->setLocale('pl_PL');

        try {
            $throw = false;
            $adb = $e->getApplication()->getServiceManager()->get('adb');
            $conf = $adb->tableExists('config');
            if (!$conf) {
                $throw = true;
            }
        } catch (\Exception $e) {
            $throw = true;
        }
        if ($throw)
            throw new \Exception("StampMaster bootstrap database check failed. Check your configuration.");
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
