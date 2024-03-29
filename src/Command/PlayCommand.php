<?php

namespace App\Command;

use App\Model\Dictionary\Exception\NotEnglishWordException;
use App\Model\Word\Exception\NotAWordException;
use App\Service\GameplayService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

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

    /**
     * @throws NotEnglishWordException
     * @throws NotAWordException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /**
         * @var QuestionHelper $helper
         */
        $helper = $this->getHelper('question');

        $question = new Question('Enter a word: ');

        /**
         * @var string $wordInput
         */
        $wordInput = $helper->ask($input, $output, $question);

        try {
            $points = $this->gameplayService->play($wordInput);
            $output->writeln(sprintf('Points: %d', $points));

            return Command::SUCCESS;
        } catch (NotAWordException|NotEnglishWordException $e) {
            $output->writeln($e->getMessage());

            return Command::FAILURE;
        }
    }
}
