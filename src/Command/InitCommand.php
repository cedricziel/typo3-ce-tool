<?php

namespace CedricZiel\T3CETool\Command;

use CedricZiel\T3CETool\Initialization\InitializationServiceInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Yaml\Yaml;

/**
 * Initializes a CE-Tool project
 *
 * @package CedricZiel\T3CETool\Command
 */
class InitCommand extends Command
{
    /**
     * @var InitializationServiceInterface
     */
    protected $initializationService;

    /**
     * @param InitializationServiceInterface $initializationService
     * @param string                         $name
     */
    public function __construct(InitializationServiceInterface $initializationService, $name = null)
    {
        parent::__construct($name);

        $this->initializationService = $initializationService;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('init')
            ->setDescription('Initializes a CE Tool project')
            ->setHelp(
                <<<EOT
Initializes a project and creates a .t3cetool.yml file                
EOT
            )
            ->setDefinition(
                [
                    new InputOption('name', 'p', InputOption::VALUE_REQUIRED, 'Name of your project'),
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var QuestionHelper $interview */
        $interview = $this->getHelper('question');
        $question = new Question('<info>What is the name of your project?</info>'.PHP_EOL, getcwd());

        $name = $interview->ask($input, $output, $question);

        $config = ['name' => $name];
        $content = Yaml::dump($config);

        try {
            file_put_contents(APP_CWD.'/.t3cetool.yml', $content);
        } catch (\Exception $e) {
            $output->writeln('<error>Could not write config file.</error>');
        }
    }
}
