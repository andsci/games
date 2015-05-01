<?php

namespace MI\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConsoleController extends Controller
{
    public function consoleAction($type)
    {
        return $this->render('MIAppBundle:Console:console.html.twig', array(
                'type' => $type
            ));    }

}
