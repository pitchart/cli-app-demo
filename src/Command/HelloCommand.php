<?php

namespace Pitchart\CliAppDemo\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class HelloCommand extends Command
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('hello')
            ->setDefinition(array(
                new InputArgument('name', InputArgument::OPTIONAL, 'The command name', ''),
            ))
            ->setDescription('Says hello')
            ->setHelp(<<<'EOF'
The <info>%command.name%</info> command says hello thanks to symfony console:

  <info>php %command.full_name%</info>

You can also say hello to someone using the 'name' argument

  <info>php %command.full_name% pitchart</info>

EOF
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        if ($name) {
            $output->writeln("Hello $name!");
        }
        else {
            $output->writeln('Hello!');
        }

    }


}
