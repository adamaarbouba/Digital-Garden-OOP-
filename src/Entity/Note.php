<?php

class Note
{
    protected $id;
    protected $themeId;
    protected $title;
    protected $content;
    protected $importance;
    protected $createdAt;

    public function __construct($title, $content, $importance, $themeId, $id = null)
    {
        $this->title = $title;
        $this->content = $content;
        $this->importance = $importance;
        $this->themeId = $themeId;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getThemeId()
    {
        return $this->themeId;
    }

    public function setThemeId($themeId)
    {
        $this->themeId = $themeId;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getImportance()
    {
        return $this->importance;
    }

    public function setImportance($importance)
    {
        $this->importance = $importance;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}
