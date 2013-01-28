<?php

namespace CtrlBlog\Form\Article\Tool;

use \CtrlBlog\Domain;
use CtrlBlog\Domain\Article;
use Ctrl\Form\Form;

class Url extends Tool
{
    public function __construct()
    {
        $this->setId('url')
            ->setLabel('url')
            ->setTitle('Generate URL')
            ->setUrl('#')
            ->setTemplate('/ctrl-blog/article/tools/url.phtml');
    }

    public function getArticleList()
    {
        /** @var $service \CtrlBlog\Service\ArticleService */
        $service = $this->getServiceLocator()->get('DomainServiceLoader')->get('CtrlBlogArticle');
        return $service->getAll();
        return array();
    }
}
