<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.10.2017
 * Time: 16:24
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Post;
use AppBundle\Entity\CategoryComment;
use AppBundle\Form\CategoryCommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryCommentController extends Controller
{
    public function newAction($category_id)
    {
        $category = $this->getCategory($category_id);

        $comment = new CategoryComment();
        $comment->setCategory($category);
        $form = $this->createForm(CategoryCommentType::class, $comment);
        return $this->render('category/comment/form.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView()
        ));
    }

    public function showAction($category_id)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $comments = $em->getRepository('AppBundle:CategoryComment')->getCommentsByCategory($category_id);
        return $this->render('category/comment/show.html.twig', array(
            'comments' => $comments,
        ));
    }

    public function createAction(Request $request, $category_id)
    {
        $category = $this->getCategory($category_id);

        $comment = new CategoryComment();
        $comment->setCategory($category);
        $form = $this->createForm(CategoryCommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()
                ->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect(
                $this->generateUrl(
                    'app_category_show', array(
                        'id' => $category_id
                    )
                )
            );
        }
        return $this->render('category/comment/form.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView()
        ));
    }

    protected function getCategory($category_id)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $category = $em->getRepository('AppBundle:Category')->find($category_id);

        if (!$category) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }
        return $category;
    }

}