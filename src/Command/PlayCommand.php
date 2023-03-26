<?php

namespace App\Command;

use App\Service\GameplayService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'PlayCommand',
    description: 'Word game gameplay simulation',
)]
class PlayCommand extends Command
{
    protected static $defaultName = 'play';
    private GameplayService $gameplayService;

    public function __construct(GameplayService $gameplayService)
    {
        parent::__construct();
        $this->gameplayService = $gameplayService;
    }

    protected function configure(): void
    {
        $this->setDescription('Enter a word to calculate points');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        $question = new Question('Enter a word: ');

        $word = $helper->ask($input, $output, $question);
        $points = $this->gameplayService->play($word);

        if (!$points) {
            $output->writeln('Invalid word');
            return Command::FAILURE;
        }

        $output->writeln(sprintf('Points: %d', $points));
        return Command::SUCCESS;
    }
}
