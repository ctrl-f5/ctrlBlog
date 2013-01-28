<?php

namespace CtrlBlog\Form\Article\Tool;

use Zend\Mvc\Service\AbstractPluginManagerFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class ToolManagerFactory extends AbstractPluginManagerFactory
{
    const PLUGIN_MANAGER_CLASS = '\CtrlBlog\Form\Article\Tool\ToolManager';

    /**
     * Default set of helpers
     *
     * @var array
     */
    protected $invokableClasses = array(
        'url' => '\CtrlBlog\Form\Article\Tool\Url',
        'img' => '\CtrlBlog\Form\Article\Tool\Img',
    );

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $manager ToolManager */
        $manager = parent::createService($serviceLocator);

        foreach ($this->invokableClasses as $toolName => $toolClass) {
            if (is_string($toolClass) && class_exists($toolClass)) {
                $tool = new $toolClass;

                if (!$tool instanceof Tool) {
                    throw new \RuntimeException(sprintf(
                        'Invalid service manager invokable class provided; received "%s", expected class implementing %s',
                        $toolClass,
                        'CtrlBlog\Form\Article\Tool\Tool'
                    ));
                }

                $tool->setServiceLocator($serviceLocator);
                $manager->setService($toolName, $tool);
            }
        }

        return $manager;
    }
}
