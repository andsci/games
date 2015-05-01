<?php

namespace MI\AppBundle\Controller;

use MI\AppBundle\Entity\Console;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConsoleController extends Controller
{
    public function consoleAction($type)
    {
        /** @var Console $console */
        $console = $this->getDoctrine()->getRepository('MIAppBundle:Console')->findOneBy(array('type'=>$type));

        return $this->render('MIAppBundle:Console:console.html.twig', array(
                'type' => $type,
            'games'=> $console->getGames()
            ));    }
}
