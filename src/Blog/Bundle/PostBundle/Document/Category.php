<?php

namespace Blog\Bundle\PostBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="categories")
 */
class Category
{
    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\String
     */
    private $title;

    /**
     * @ODM\ReferenceOne(targetDocument="Post", inversedBy="category")
     */
    private $post;

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
     * Set post
     *
     * @param Post $post
     * @return self
     */
    public function setPost(Post $post)
    {
        $this->post = $post;
        return $this;
    }

    /**
     * Get post
     *
     * @return Post $post
     */
    public function getPost()
    {
        return $this->post;
    }
}
