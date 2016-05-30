<?php

namespace Pitchart\CliAppDemo\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Humbug\SelfUpdate\Updater;

class SelfUpdateCommand extends Command
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('selfupdate')
            ->setDescription('Updates application')
            ->setHelp(<<<'EOF'
The <info>%command.name%</info> command updates the application to the latest version:

  <info>php %command.full_name%</info>

EOF
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $updater = new Updater(null, false);
        $updater->getStrategy()->setPharUrl('http://pitchart.github.io/cli-app-demo/cli-app-demo.phar');
        $updater->getStrategy()->setVersionUrl('http://pitchart.github.io/cli-app-demo/cli-app-demo.phar.version');
        try {
            $result = $updater->hasUpdate();
            if ($result) {
                $output->writeln(sprintf(
                    'The current stable build available remotely is: %s',
                    $updater->getNewVersion()
                ));
                $questionHelper = $this->getHelper('question');
                $confirmation = new ConfirmationQuestion('Would you like to update the application ?', false);
                if ($questionHelper->ask($input, $output, $confirmation)) {
                    if ($updater->update()) {
                        $output->writeln(sprintf('Application updated to version %s', $updater->getNewVersion()));
                    }
                }
            }
            else {
                $output->writeln('Your application is up to date');
            }
        } catch (\Exception $e) {
            $output->writeln('Well, something happened! Either an oopsie or something involving hackers.');
        }

    }


}
