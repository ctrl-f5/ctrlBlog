<?php

namespace Ctrl\Blog;

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

        $this->initDoctrine($serviceManager);
        $this->setViewHelpers($serviceManager);
        $this->initLayout($serviceManager, $eventManager);
        $this->initLoginTriggers($serviceManager);
    }

    protected function setViewHelpers(ServiceLocatorInterface $serviceManager)
    {
        /** @var $viewManager \Zend\Mvc\View\Http\ViewManager */
        $viewManager = $serviceManager->get('ViewManager');
        if (method_exists($viewManager, 'getHelperManager')) {
            //$viewManager->getHelperManager()
                //->setInvokableClass('ItemState', 'Ctrl\Blog\View\Helper\ItemState');
        }
    }

    protected function initDoctrine(ServiceLocatorInterface $serviceManager)
    {
        /** @var $entityManager \Doctrine\ORM\EntityManager */
        $entityManager = $serviceManager->get('doctrine.entitymanager.orm_default');
        $entityManager->getEventManager()->addEventListener(
            array(\Doctrine\ORM\Events::postLoad),
            new PostLoadSubscriber($serviceManager)
        );
    }

    protected function initLayout(ServiceLocatorInterface $serviceManager, EventManager $eventManager)
    {
        //feed the flashMessenger vars into the layout
        /** @var $e \Zend\Mvc\MvcEvent */
        $eventManager->attach(\Zend\Mvc\MvcEvent::EVENT_RENDER, function ($e) {
            $serviceManager = $e->getApplication()->getServiceManager();
            $view = $e->getViewModel();
            if ($view->getTemplate() == 'layout/layout') {
                /**
                 * add flash messages
                 */
                /** @var $flashMessenger \Zend\Mvc\Controller\Plugin\FlashMessenger */
                $flashMessenger = $serviceManager->get('ControllerPluginManager')->get('flashMessenger');
                $messages = array();
                foreach (array('error', 'success', 'info') as $ns) {
                    if ($flashMessenger->setNamespace($ns)->hasMessages()) {
                        $messages[$ns] = $flashMessenger->getMessages();
                    }
                }
                $view->appMessages = $messages;

                /*
                 * Add current user
                 */
                //$userService = $serviceManager->get('DomainServiceLoader')->get('User');
                //$userService->getCurrentUser

                /*
                 * compose navigation
                 */
                $authNav = $serviceManager->get('CtrlAuthNavigation');

                /** @var $navigation \Zend\Navigation\Navigation */
                $factory = new \Zend\Navigation\Service\ConstructedNavigationFactory(array());
                $navigation = $factory->createService($serviceManager);
                $navigation->addPage(array(
                    'label' => 'Auth Module',
                    'route' => 'ctrl_auth',
                    'pages' => $authNav->getPages(),
                    'type' => 'Ctrl\Navigation\Page\Mvc',
                    'router' => $e->getRouter(),
                    'routeMatch' => $e->getRouteMatch(),
                ));

                $view->navigation = array(
                    'main' => $navigation,
                    'ctrl_auth' => $authNav,
                );
            }
        });
    }

    protected function initLoginTriggers(ServiceLocatorInterface $serviceManager)
    {
        $domainServiceLoader = $serviceManager->get('DomainServiceLoader');
        /** @var $authUserService \Ctrl\Module\Auth\Service\UserService */
        $authUserService = $domainServiceLoader->get('CtrlAuthUser');
        $authUserService->getEventManager()->attach(\Ctrl\Module\Auth\Service\UserService::EVENT_ON_LOGIN, function ($e) use ($domainServiceLoader) {
            /** @var $authUser \Ctrl\Module\Auth\Domain\User */
            $authUser = $e->getParam('user');
            /** @var $userService \Ctrl\Blog\Service\UserService */
            $userService = $domainServiceLoader->get('User');
            $user = $userService->getByAuthUser($authUser);
            $session = new \Zend\Session\Container('ctrl_blog');
            $session->offsetSet('auth.user', $user->getId());
        });
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
                    __NAMESPACE__ => __DIR__.'/src/CtrlBlog/',
                ),
            ),
        );
    }
}
