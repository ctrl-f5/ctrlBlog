<?php

namespace Ctrl\Blog\Controller;

use Ctrl\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractController
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em = null;

    /**
     * @param \Doctrine\ORM\EntityManager $manager
     * @return IndexController
     */
    public function setEntityManager(\Doctrine\ORM\EntityManager $manager)
    {
        $this->em = $manager;
        return $this;
    }

    /**
     * @return \Doctrine\ORM\EntityManager|null
     */
    public function getEntityManager()
    {
        return $this->em;
    }

    public function indexAction()
    {
        $service = $this->getDomainService('Article');
        var_dump($service->getAll());
    }
}
