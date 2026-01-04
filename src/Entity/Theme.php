<?php

class Theme
{
    protected $id;
    protected $userId;
    protected $name;
    protected $color;
    protected $creationDate;
    protected $modificationDate;
    protected $notes = [];

    public function __construct($name, $color, $userId, $id = null)
    {
        $this->name = $name;
        $this->color = $color;
        $this->userId = $userId;
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

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getModificationDate()
    {
        return $this->modificationDate;
    }

    public function setModificationDate($modificationDate)
    {
        $this->modificationDate = $modificationDate;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function addNote($note)
    {
        $this->notes[] = $note;
    }
}