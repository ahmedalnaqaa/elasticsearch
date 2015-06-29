<?php

namespace Blog\Bundle\PostBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="posts")
 */
class Post
{
    /** @ODM\Id */
    private $id;

    /** @ODM\String */
    private $title;

    /**
     * @ODM\ReferenceOne(targetDocument="Category", mappedBy="post")
     */
    private $category;

    /** @ODM\String */
    private $body;

    /** @ODM\Date */
    private $createdAt;

    // ---------------------------------------------------------------------

    /**
     * @ODM\PrePersist()
     */
    public function onPrePersist()
    {
        $this->setCreatedAt(new \DateTime());
    }

    // ---------------------------------------------------------------------


    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return self
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Get body
     *
     * @return string $body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set createdAt
     *
     * @param date $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return date $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set category
     *
     * @param Category $category
     * @return self
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return Category $category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
