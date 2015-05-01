<?php
namespace MI\AppBundle\Service;
use Doctrine\ORM\EntityManager;
use MI\AppBundle\Entity\Game;
use Symfony\Component\Console\Output\OutputInterface;

class Parser
{
    /**
     * @var
     */
    private $domCrawler;
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct($domCrawler, $em)
    {
        $this->domCrawler = $domCrawler;
        $this->em = $em;
    }

    public function analyze($url, $type, OutputInterface $output)
    {
        $html = new \simple_html_dom();
        $html->load_file($url);

        foreach ($html->find('table.wikitable tr') as $row) {
            $title = $row->children(0);
            $genre = $row->Children(1);
            $developer = $row->children(2);

            $gameRep = $this->em->getRepository('MIAppBundle:Game');
            $consoleRep = $this->em->getRepository('MIAppBundle:Console');
            $console = $consoleRep->findOneBy(array('type' => $type));

            if ($title->tag == 'th') { continue; }

            if(count($gameRep->findBy(['title' => $title->plaintext])) == 0){
                $game = new Game();
                $game->setConsole($console);
                $game->setTitle($title->plaintext);
                $game->setDeveloper($developer->plaintext);
                $game->setGenre($genre->plaintext);
                $game->setYear(2015);

                $this->em->persist($game);
            }

            $output->writeln($title->plaintext);
        }

        $this->em->flush();
    }
}