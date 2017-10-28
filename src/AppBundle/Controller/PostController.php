<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Post controller.
 *
 */
class PostController extends Controller
{
    /**
     * Lists all post entities.
     *
     */
    public function indexAction($categoryId)
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('AppBundle:Post')->getPosts($categoryId);

        return $this->render('post/index.html.twig', array(
            'categoryId' => $categoryId,
            'posts' => $posts,
        ));
    }

    /**
     * Creates a new post entity.
     *
     */
    public function newAction($categoryId, Request $request, FileUploader $fileUploader)
    {
        $post = new Post();
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:Category')->find($categoryId);
        $post->setCategory($category);
        $form = $this->createForm('AppBundle\Form\PostType', $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $post->getFile();
            if ($file) {
                $fileName = $fileUploader->upload($file);

                $post->setFileName($fileName);
            }
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('app_category_show', array('id' => $category->getId()));
        }

        return $this->render('post/new.html.twig', array(
            'post' => $post,
            'category' => $category,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a post entity.
     *
     */
    public function showAction(Post $post)
    {
        $deleteForm = $this->createDeleteForm($post);

        return $this->render('post/show.html.twig', array(
            'post' => $post,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing post entity.
     *
     */
    public function editAction(Request $request, Post $post, FileUploader $fileUploader)
    {
        $deleteForm = $this->createDeleteForm($post);
        $editForm = $this->createForm('AppBundle\Form\PostType', $post);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $post->getFile();
            if ($file) {
                $fileName = $fileUploader->upload($file);
                $post->setFileName($fileName);
            }
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('app_post_show', array('id' => $post->getId()));
        }

        return $this->render('post/edit.html.twig', array(
            'post' => $post,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a post entity.
     *
     */
    public function deleteAction(Request $request, Post $post)
    {
        $form = $this->createDeleteForm($post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush();
        }

        return $this->redirectToRoute('app_category_show', array('id' => $post->getCategory()->getId()));
    }

    /**
     * Creates a form to delete a post entity.
     *
     * @param Post $post The post entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private
    function createDeleteForm(Post $post)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_post_delete', array('id' => $post->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
