<?php

namespace projectAdmin\PaginasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction(a$name)
    {
        return $this->render('projectAdminPaginasBundle:Default:index.html.twig', array('name' => $name));
    }
}
