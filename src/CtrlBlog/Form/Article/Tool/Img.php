<?php

namespace CtrlBlog\Form\Article\Tool;

use \CtrlBlog\Domain;
use CtrlBlog\Domain\Article;
use Ctrl\Form\Form;

class Img extends Tool
{
    public function __construct()
    {
        $this->setId('img')
            ->setLabel('img')
            ->setTitle('Insert image')
            ->setUrl('#')
            ->setTemplate('/ctrl-blog/article/tools/img.phtml');
    }
}
