<?php

namespace Blog\Bundle\UserBundle\Document;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="users")
 */
class User extends BaseUser
{
    /**
     * @ODM\Id(strategy="auto")
     */
    protected $id;

    /** @ODM\ReferenceMany(targetDocument="\Blog\Bundle\PostBundle\Document\Post", cascade="all") */
    protected $posts = array();


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

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
     * Add post
     *
     * @param \Blog\Bundle\PostBundle\Document\Post $post
     */
    public function addPost(\Blog\Bundle\PostBundle\Document\Post $post)
    {
        $this->posts[] = $post;
    }

    /**
     * Remove post
     *
     * @param \Blog\Bundle\PostBundle\Document\Post $post
     */
    public function removePost(\Blog\Bundle\PostBundle\Document\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection $posts
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
