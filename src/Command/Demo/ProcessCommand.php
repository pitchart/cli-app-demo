<?php

namespace Pitchart\CliAppDemo\Command\Demo;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Process\ProcessBuilder;

class ProcessCommand extends Command
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('demo:process')
            ->setDescription('Process helper examples')
            ->setDefinition(array(
                new InputArgument('type', InputArgument::OPTIONAL, 'The process type', ''))
            )
            ->setHelp(<<<'EOF'
The <info>%command.name%</info> show different usages of the process helper:

  <info>php %command.full_name%</info>

EOF
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('process');
        $type = $input->getArgument('type');
        switch ($type) {
            case 'fail' :
                $process = (new ProcessBuilder(array('lslsq', '-lsa')))
                    ->getProcess();
                break;
            default:
                $process = (new ProcessBuilder(array('ls', '-lsa')))
                    ->getProcess();
                break;
        }

        $helper->run($output, $process, 'Oops, something went wrong :(');
    }

}