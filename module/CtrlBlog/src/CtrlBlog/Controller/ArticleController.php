<?php

namespace Ctrl\Blog\Controller;

use Ctrl\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class ArticleController extends AbstractController
{
    public function editAction()
    {
        $service = $this->getDomainService('Article');
        $article = $service->getById($this->params()->fromRoute('id'));
        return new ViewModel(array(
            'article' => $article,
            'form' => $service->getForm()
        ));
    }
}
