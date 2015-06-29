<?php

namespace Blog\Bundle\PostBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Blog\Bundle\PostBundle\Document\Post;

/**
 * @Route("/categories")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/", name="categories")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}