<?php

namespace Blog\Bundle\PostBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Blog\Bundle\PostBundle\Document\Post;

/**
 * @Route("/admin/posts")
 */
class PostController extends Controller
{
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
            $post = $dm->find('BlogPostBundle:Post', $id);
            if (!$post) {
                throw $this->createNotFoundException('The category does not exist');
            }
        } else {
            $post = new Category();
        }

        $form = $this->categoryForm($post, $request->get('_route'));
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()) {
            $dm->persist($post);
            $dm->flush();
            return $this->redirect($request->headers->get('referer'));
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * Create Category Form
     *
     * @param Category $category
     * @param $action
     * @return \Symfony\Component\Form\Form
     */
    public function categoryForm(Category $category, $action)
    {
        return $this->createForm(new CategoryType(), $category, array(
            'action' => $this->generateUrl($action, array('id' => $category->getId())),
            'method' => 'POST',
        ));
    }
}
