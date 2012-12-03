<?php

namespace CtrlBlog\Controller;

use Ctrl\Controller\AbstractController as Controller;
use Zend\View\Model\ViewModel;

abstract class AbstractController extends Controller
{
    public function getPropertyType($typeName)
    {
        $loader = $this->getServiceLocator()->get('PropertyTypeLoader');
        return $loader->get($typeName);
    }

    /**
     * @return \CtrlBlog\Domain\User
     */
    public function getCurrentUser()
    {
        return $this->getDomainService('User')->getCurrentUser();
    }
}
