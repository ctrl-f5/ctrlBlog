<?php

namespace CtrlBlog\Navigation;

use Zend\Navigation\Service\AbstractNavigationFactory;

class BlogNavigationFactory extends AbstractNavigationFactory
{
    /**
     * @return string
     */
    protected function getName()
    {
        return 'ctrl_blog';
    }
}
