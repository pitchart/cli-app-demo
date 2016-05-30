<?php

namespace Pitchart\CliAppDemo\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class QuestionCommand extends Command
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('demo:question')
            ->setDescription('Question helper examples')
            ->setHelp(<<<'EOF'
The <info>%command.name%</info> show different usages of the question helper:

  <info>php %command.full_name%</info>

EOF
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $questionHelper = $this->getHelper('question');
        
        $question = new Question("<info>What's your name ?</info> ", 'Pitchart');

        $choice = new ChoiceQuestion(
            '<info>Please choose a language :</info> ',
            ['PHP', 'Javascript', 'Phyton'],
            0
        );

        $confirmation = new ConfirmationQuestion('<comment>Are you OK ?</comment> ', true);

        $name = $questionHelper->ask($input, $output, $question);

        $language = $questionHelper->ask($input, $output, $choice);

        if ($questionHelper->ask($input, $output, $confirmation)) {
            $output->writeln(sprintf('Hey %s, let\'s talk about %s!', $name, $language));
        }
        else {
            $output->writeln('See you later.');
        }

    }

}