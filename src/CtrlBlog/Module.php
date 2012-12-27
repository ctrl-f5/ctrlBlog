<?php

namespace CtrlBlog;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\EventManager\EventManager;
use Zend\Mvc\ModuleRouteListener;
use Ctrl\EntityManager\PostLoadSubscriber;

class Module
{
    /**
     * @param $e \Zend\Mvc\MvcEvent
     */
    public function onBootstrap($e)
    {
        /** @var $eventManager EventManager */
        $eventManager           = $e->getApplication()->getEventManager();
        $serviceManager         = $e->getApplication()->getServiceManager();
        $moduleRouteListener    = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {

        return array_merge(
            $this->getRouterConfig(),
            include __DIR__ . '/../../config/module.config.php'
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__.'/../',
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'CtrlBlogNavigation' => 'CtrlBlog\Navigation\BlogNavigationFactory',
            ),
        );
    }

    public function getRouterConfig()
    {
        $config = array('router' => array(
            'routes' => array(
                'ctrl_blog' => \Ctrl\Mvc\Router\Http\DefaultSegment::factory(
                    'CtrlBlog\Controller',
                    '/blog'
                ),
            ),
        ));
        return $config;
    }
}
