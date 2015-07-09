<?php

namespace Blog\Bundle\PostBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Blog\Bundle\PostBundle\Document\Post;

class PostController extends Controller
{
    /**
     * @Route("/", name="blog_home")
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

    /**
     * Add/Edit Post
     *
     * @Route("/post", name="add_post")
     * @Route("/{id}/edit", name="edit_post")
     * @Template()
     *
     * @param Request $request
     * @param null $id
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request, $id = null)
    {
        $is_edit_mode = !empty($id);
        $dm = $this->get('doctrine_mongodb')->getManager();

        if ($is_edit_mode) {
            $category = $dm->find('BlogPostBundle:Category', $id);
            if (!$category) {
                throw $this->createNotFoundException('The category does not exist');
            }
        } else {
            $category = new Category();
        }

        $form = $this->categoryForm($category, $request->get('_route'));
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()) {
            $dm->persist($category);
            $dm->flush();
            return $this->redirect($request->headers->get('referer'));
        }

        return array(
            'form' => $form->createView(),
        );
    }
}
