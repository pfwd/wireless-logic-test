<?php
namespace Console\App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class ScrapperCommand extends Command
{
    protected function configure()
    {
        $this->setName('scrapper')
            ->setDescription('scraps page')
            ->setHelp('');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Attempting to scrap');

        
        return Command::SUCCESS;
    }
}