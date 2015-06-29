<?php

namespace Blog\Bundle\PostBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Blog\Bundle\PostBundle\Document\Category;
use Blog\Bundle\PostBundle\Form\CategoryType;

/**
 * @Route("/admin/categories")
 */
class CategoryController extends Controller
{
    /**
     * @Route("/", name="admin_categories")
     * @Template()
     */
    public function indexAction()
    {
        $categories = $this->get('doctrine_mongodb')
            ->getRepository('BlogPostBundle:Category')
            ->findAll();

        return array(
            'categories' => $categories,
        );
    }

    /**
     * Add/Edit Category
     *
     * @Route("/add", name="admin_categories_add")
     * @Route("/{id}/edit", name="admin_categories_edit")
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

    /**
     * Delete Category
     *
     * @Route("/{id}/delete", name="admin_categories_delete")
     *
     * @param null $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id = null, Request $request)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $category = $dm->find('BlogPostBundle:Category', $id);
        $dm->remove($category);
        $dm->flush();

        return $this->redirect($request->headers->get('referer'));
    }
}