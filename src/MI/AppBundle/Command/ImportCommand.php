<?php
namespace MI\AppBundle\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
class ImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('mi:import:games')
            ->setDescription('Import some games')
            ->addArgument(
                'type',
                InputArgument::REQUIRED,
                'What console games?'
            )
            ->addArgument(
                'url',
                InputArgument::REQUIRED,
                'From which url we want to import?'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument('url');
        $type = $input->getArgument('type');
        $parser = $this->getContainer()->get('mi.parser');
        $parser->analyze($url, $type, $output);
        //$output->writeln('<comment>We will import games from:</comment>');
        //$output->writeln($result);
    }
}