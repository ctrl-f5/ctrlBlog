<?php

namespace CtrlBlog\Form\Article\Tool;

use \CtrlBlog\Domain;
use CtrlBlog\Domain\Article;
use Ctrl\Form\Form;
use Zend\ServiceManager\ServiceLocatorInterface;

class Tool implements \Zend\ServiceManager\ServiceLocatorAwareInterface
{
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceLocator;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var Article
     */
    protected $article;

    /**
     * @param string $id
     * @return Tool
     */
    public function setLabel($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $label
     * @return Tool
     */
    public function setId($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $title
     * @return Tool
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $url
     * @return Tool
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $template
     * @return Tool
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param \CtrlBlog\Domain\Article $article
     * @return Tool
     */
    public function setArticle($article)
    {
        $this->article = $article;
        return $this;
    }

    /**
     * @return \CtrlBlog\Domain\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return Tool
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}
