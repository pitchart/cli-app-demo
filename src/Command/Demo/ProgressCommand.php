<?php

namespace Pitchart\CliAppDemo\Command\Demo;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Helper\ProgressBar;

class ProgressCommand extends Command
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('demo:progress')
            ->setDescription('Progress bar helper examples')
            ->setHelp(<<<'EOF'
The <info>%command.name%</info> show different usages of the progress helper:

  <info>php %command.full_name%</info>

EOF
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $progress = new ProgressBar($output, 50);

        // start and displays the progress bar
        $output->writeln('<info>Task start</info>');
        $progress->start();

        $i = 0;
        while ($i++ < 50) {
            // ... do some work

            // advance the progress bar 1 unit
            $progress->advance();
            if ($i % 5) {
                usleep(rand(1,3)* 100000);
            }
            else {
                usleep(rand(4, 8) * 100000);
            }
            // you can also advance the progress bar by more than 1 unit
            // $progress->advance(3);
        }

        // ensure that the progress bar is at 100%
        $progress->finish();
        $output->writeln('');
        $output->writeln('<comment>Task finished!!!</comment>');
        
    }

}