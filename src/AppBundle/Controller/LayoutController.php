<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 29.10.2017
 * Time: 17:30
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LayoutController extends Controller
{
    public function browserAction()
    {
        $em = $this->getDoctrine()->getManager();

        $browsers = $em->getRepository('AppBundle:Session')->getListBrowserWithSum();

        return $this->render('layout/browser.html.twig', array(
            'browsers' => $browsers,
        ));
    }
}