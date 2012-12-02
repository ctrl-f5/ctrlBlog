<?php

namespace Ctrl\Blog\Form\Article;

use \Ctrl\Blog\Domain;
use Ctrl\Blog\Domain\Article;
use Ctrl\Form\Form;
use Zend\InputFilter\Factory as FilterFactory;
use Zend\InputFilter\InputFilter;
use Ctrl\Form\Element\Hidden as HiddenInput;
use Ctrl\Form\Element\Text as TextInput;
use Ctrl\Form\Element\Textarea as TextareaInput;
use Ctrl\Form\Element\Select as SelectInput;

class Edit extends \Ctrl\Form\Form
{
    const ELEM_ID = 'id';
    const ELEM_TITLE = 'title';
    const ELEM_CONTENT = 'content';

    protected $entity = 'Ctrl\Blog\Domain\Article';

    public function __construct($name = null)
    {
        parent::__construct('article-edit');

        //$input = new HiddenInput(self::ELEM_ID);
        //$this->add($input);

        $input = new TextInput(self::ELEM_TITLE);
        $input->setLabel('title');
        $this->add($input);

        $input = new TextareaInput(self::ELEM_CONTENT);
        $input->setLabel('content');
        $this->add($input);

        $this->setInputFilter($this->getInputFilter());
    }

    public function loadModel(Article $article)
    {
        $this->elements[self::ELEM_TITLE]->setValue($article->getTitle());
        $this->elements[self::ELEM_CONTENT]->setValue($article->getContent());
    }

    public function getInputFilter()
    {
        $factory = new FilterFactory();
        $filter = new InputFilter();
        $filter->add($factory->createInput(array(
            'name'     => 'title',
            'required' => true,
        )))->add($factory->createInput(array(
            'name'     => 'content',
            'required' => true,
        )));

        return $filter;
    }
}
