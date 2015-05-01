<?php

namespace MI\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GamesController extends Controller
{
    public function indexAction()
    {
        return $this->render('MIAppBundle:Games:index.html.twig', array(
                // ...
            ));    }

}
