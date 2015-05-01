<?php

namespace MI\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function IndexAction()
    {
        return $this->render('MIAppBundle:Home:Index.html.twig', array(
                // ...
            ));    }

}
