<?php

namespace Blog\Bundle\PostBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Blog\Bundle\PostBundle\Document\Post;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
//        $post = new Post();
//        $post->setTitle('My First Blog Post');
//        $post->setBody('MongoDB + Doctrine 2 ODM = awesomeness!');
//
//        $dm = $this->get('doctrine_mongodb')->getManager();
//        $dm->persist($post);
//        $dm->flush();

        return array();
    }

    /**
     * @Route("/view")
     * @Template()
     */
    public function viewAction()
    {
        return array();
    }
}
