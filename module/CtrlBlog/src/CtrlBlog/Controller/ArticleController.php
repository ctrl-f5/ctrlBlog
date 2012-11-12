<?php

namespace Ctrl\Blog\Controller;

use Ctrl\Blog\Domain\Article;
use Ctrl\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class ArticleController extends AbstractController
{
    public function indexAction()
    {
        /** @var $service \Ctrl\Blog\Service\ArticleService */
        $service = $this->getDomainService('Article');

        return new ViewModel(array(
            'articles' => $service->getAll()
        ));
    }

    public function editAction()
    {
        /** @var $service \Ctrl\Blog\Service\ArticleService */
        $service = $this->getDomainService('Article');
        /** @var $article Article */
        $article = $service->getById($this->params()->fromRoute('id'));

        $form = $service->getForm($article);
        $form->setAttribute('method', 'post');

        $form->setAttribute('action', $this->url()->fromRoute('default/id', array(
            'controller' => 'article',
            'action' => 'edit',
            'id' => $article->getId()
        )));
        $form->setReturnUrl($this->url()->fromRoute('default', array(
            'controller' => 'article',
            'action' => 'index',
        )));

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $elems = $form->getElements();
                $article->setTitle($elems[$form::ELEM_TITLE]->getValue());
                $article->setContent($elems[$form::ELEM_CONTENT]->getValue());
                $service->persist($article);
                return $this->redirect()->toUrl('/article/index');
            }
        }

        return new ViewModel(array(
            'article' => $article,
            'form' => $form
        ));
    }
}
