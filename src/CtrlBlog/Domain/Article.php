<?php

namespace CtrlBlog\Domain;

use DateTime;

class Article extends \Ctrl\Domain\PersistableModel
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var DateTime
     */
    protected $dateCreated;

    public function __construct()
    {
        $this->dateCreated = new \DateTime('now', new \DateTimeZone('UTC'));
    }

    /**
     * @param string $title
     * @return Artile
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
     * @param string $slug
     * @return Article
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @return User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param string $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param bool $asHtml parse markdown to html
     * @return string
     */
    public function getContent($asHtml = false)
    {
        if ($asHtml) {
            $parser = new \Markdown\Text($this->content);
            return $parser->getHtml();
        }
        return $this->content;
    }
}
