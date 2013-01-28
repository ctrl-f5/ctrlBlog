<?php

namespace CtrlBlog\Form\Article\Tool;

use Zend\ServiceManager\AbstractPluginManager;

class ToolManager extends AbstractPluginManager
{
    /**
     * Default set of helpers
     *
     * @var array
     */
    protected $invokableClasses = array(
        'url' => 'CtrlBlog\Form\Tool\Url',
        'img' => 'CtrlBlog\Form\Tool\Img',
    );

    public function validatePlugin($plugin)
    {
        if ($plugin instanceof Tool) {
            return true;
        }

        throw new \Zend\View\Exception\InvalidHelperException(sprintf(
            'Plugin of type %s is invalid; must implement %s\Tool',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}
