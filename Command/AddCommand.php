<?php

namespace Naroga\SearchBundle\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this
            ->setName('search:add')
            ->setDescription('Adds a new entry to the search engine.')
            ->addArgument('filename')
            ->addArgument('content');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = $input->getArgument('filename');
        $content = $input->getArgument('content');
    }
}