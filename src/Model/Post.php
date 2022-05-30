<?php

namespace App\Model;

use DateTime;
use DateTimeZone;

class Post
{

    protected $id;

    public $title;

    public $image;

    public $created_at;

    public $updated_at;

    public $chapo;

    public $auteur;

    public $content;

    public $isPublished;


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage(string $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at()
    {
        $timeZone = new DateTimeZone('Europe/Paris');
        $date = new DateTime();
        $date->setTimezone($timeZone);

        $this->created_at = $date->format('Y-m-d H:i:s.u');

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdated_at(DateTime $updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of chapo
     */
    public function getChapo()
    {
        return $this->chapo;
    }

    /**
     * Set the value of chapo
     *
     * @return  self
     */
    public function setChapo(string $chapo)
    {
        $this->chapo = $chapo;

        return $this;
    }

    /**
     * Get the value of auteur
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set the value of auteur
     *
     * @return  self
     */
    public function setAuteur(string $auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of isPublished
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Set the value of isPublished
     *
     * @return  self
     */
    public function setIsPublished(bool $isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }
}
