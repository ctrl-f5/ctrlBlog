<?php

namespace Ctrl\Blog\Service;

use \Ctrl\Blog\Domain;
use Ctrl\Blog\Domain\Article;
use Ctrl\Form\Form;
use Zend\InputFilter\Factory as FilterFactory;
use Zend\InputFilter\InputFilter;
use Ctrl\Form\Element\Text as TextInput;
use Ctrl\Form\Element\Textarea as TextareaInput;
use Ctrl\Form\Element\Select as SelectInput;

class ArticleService extends \Ctrl\Service\AbstractDomainModelService
{
    protected $entity = 'Ctrl\Blog\Domain\Article';

    public function getForm(Article $article = null)
    {
        $form = new Form('article');

        $input = new TextInput('title');
        $input->setLabel('title');
        if ($article) $input->setValue($article->getTitle());
        $form->add($input);

        $input = new TextareaInput('content');
        $input->setLabel('content');
        if ($article) $input->setValue($article->getContent());
        $form->add($input);

        $form->setInputFilter($this->getModelInputFilter($article));

        return $form;
    }

    public function getModelInputFilter(Article $article = null)
    {
        $factory = new FilterFactory();
        $filter = new InputFilter();
        $filter->add($factory->createInput(array(
            'name'     => 'title',
            'required' => true,
        )))->add($factory->createInput(array(
            'name'     => 'content',
            'required' => true,
        )))->add($factory->createInput(array(
            'name'     => 'content',
            'required' => true,
        )));

        return $filter;
    }
}
