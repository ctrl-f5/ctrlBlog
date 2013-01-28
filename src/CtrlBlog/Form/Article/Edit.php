<?php

namespace CtrlBlog\Form\Article;

use \CtrlBlog\Domain;
use CtrlBlog\Domain\Article;
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
    const ELEM_SLUG = 'slug';
    const ELEM_CONTENT = 'content';

    protected $entity = 'CtrlBlog\Domain\Article';

    /**
     * @var \CtrlBlog\Form\Article\Tool\ToolManager
     */
    protected $articleToolManager = array();

    public function __construct($name = null)
    {
        parent::__construct('article-edit');

        //$input = new HiddenInput(self::ELEM_ID);
        //$this->add($input);

        $input = new TextInput(self::ELEM_TITLE);
        $input->setLabel('title');
        $this->add($input);

        $input = new TextInput(self::ELEM_SLUG);
        $input->setLabel('slug');
        $this->add($input);

        $input = new TextareaInput(self::ELEM_CONTENT);
        $input->setLabel('content');
        $this->add($input);

        $this->setInputFilter($this->getInputFilter());
    }

    public function getArticleToolManager()
    {
        if (!($this->articleToolManager instanceof \CtrlBlog\Form\Article\Tool\ToolManager)) {
            //$this->articleToolManager = new \CtrlBlog\Form\Article\Tool\ToolManager($this->get);
        }
        return $this->articleToolManager;
    }

    public function setArticleToolManager(\CtrlBlog\Form\Article\Tool\ToolManager $manager)
    {
        $this->articleToolManager = $manager;
    }

    public function getArticleTools()
    {
        return array(
            $this->getArticleToolManager()->get('url'),
            $this->getArticleToolManager()->get('img'),
        );
    }

    /**
     * @param \Ctrl\Domain\Model|Article $article
     * @throws \CtrlBlog\Exception
     */
    public function loadModel(\Ctrl\Domain\Model $article)
    {
        if (!($article instanceof Article)) {
            throw new \CtrlBlog\Exception('explecting instance of \\Ctrl\\Domain\\Article got '.get_class($article));
        }
        $this->elements[self::ELEM_TITLE]->setValue($article->getTitle());
        $this->elements[self::ELEM_CONTENT]->setValue($article->getContent());
        $this->elements[self::ELEM_SLUG]->setValue($article->getSlug());

        foreach ($this->getArticleTools() as $tool) {
            $tool->setArticle($article);
        }
    }

    public function getInputFilter()
    {
        $factory = new FilterFactory();
        $filter = new InputFilter();
        $filter->add($factory->createInput(array(
            'name'     => 'title',
            'required' => true,
        )))->add($factory->createInput(array(
            'name'     => 'slug',
            'required' => true,
        )))->add($factory->createInput(array(
            'name'     => 'content',
            'required' => true,
        )));

        return $filter;
    }
}
