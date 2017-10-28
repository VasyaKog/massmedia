<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.10.2017
 * Time: 16:24
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Post;
use AppBundle\Entity\PostComment;
use AppBundle\Form\PostCommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostCommentController extends Controller
{
    public function newAction($post_id)
    {
        $post = $this->getPost($post_id);

        $comment = new PostComment();
        $comment->setPost($post);
        $form = $this->createForm(PostCommentType::class, $comment);
        return $this->render('post/comment/form.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView()
        ));
    }

    public function showAction($post_id)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $comments = $em->getRepository('AppBundle:PostComment')->getCommentsByPost($post_id);
        return $this->render('post/comment/show.html.twig', array(
            'comments' => $comments,
        ));
    }

    public function createAction(Request $request, $post_id)
    {
        $post = $this->getPost($post_id);

        $comment = new PostComment();
        $comment->setPost($post);
        $form = $this->createForm(PostCommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()
                ->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect(
                $this->generateUrl(
                    'app_post_show', array(
                        'id' => $post_id
                    )
                )
            );
        }
        return $this->render('VasyaKogBlogBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView()
        ));
    }

    protected function getPost($post_id)
    {
        $em = $this->getDoctrine()
            ->getManager();

        $post = $em->getRepository('AppBundle:Post')->find($post_id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }
        return $post;
    }

}