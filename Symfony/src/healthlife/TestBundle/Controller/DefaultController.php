<?php

namespace healthlife\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('healthlifeTestBundle:Default:index.html.twig', array('name' => $name));
    }
}
