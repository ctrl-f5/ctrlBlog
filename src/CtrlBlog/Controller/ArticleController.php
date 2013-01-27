<?php

namespace CtrlBlog\Controller;

use CtrlBlog\Domain\Article;
use Ctrl\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class ArticleController extends AbstractController
{
    public function indexAction()
    {
        /** @var $service \CtrlBlog\Service\ArticleService */
        $service = $this->getDomainService('CtrlBlogArticle');

        return new ViewModel(array(
            'articles' => $service->getAll()
        ));
    }

    public function editAction()
    {
        /** @var $service \CtrlBlog\Service\ArticleService */
        $service = $this->getDomainService('CtrlBlogArticle');
        /** @var $article Article */
        if ($this->params()->fromRoute('id')) {
            $article = $service->getById($this->params()->fromRoute('id'));
        } else {
            $article = new Article();
        }

        $form = $service->getForm($article);
        $form->setAttribute('method', 'post');

        $form->setAttribute('action', $this->url()->fromRoute('ctrl_blog/default/id', array(
            'controller' => 'article',
            'action' => 'edit',
            'id' => $article->getId()
        )));
        $form->setReturnUrl($this->url()->fromRoute('ctrl_blog/default', array(
            'controller' => 'article',
        )));

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $elems = $form->getElements();
                $article->setTitle($elems[$form::ELEM_TITLE]->getValue());
                $article->setSlug($elems[$form::ELEM_SLUG]->getValue());
                $article->setContent($elems[$form::ELEM_CONTENT]->getValue());
                $service->persist($article);
                return $this->redirect()->toUrl($form->getReturnurl());
            }
        }

        return new ViewModel(array(
            'article' => $article,
            'form' => $form
        ));
    }

    public function renderMarkdownAction()
    {
        if ($this->getRequest()->isPost()) {
            $parser = new \Markdown\Text($this->params()->fromPost('markdown'));
            return $this->response->setContent($parser->getHtml());
        }
        return $this->response->setStatusCode('200');
    }
}
