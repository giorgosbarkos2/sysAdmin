<?php

namespace projectAdmin\UploadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('projectAdminUploadBundle:Default:index.html.twig', array('name' => $name));
    }
}
