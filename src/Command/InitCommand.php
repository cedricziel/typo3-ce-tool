<?php

namespace CedricZiel\T3CETool\Command;

use CedricZiel\T3CETool\Configuration\ConfigurationManagerInterface;
use CedricZiel\T3CETool\Domain\Project;
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
     * @var ConfigurationManagerInterface
     */
    private $configurationManager;

    /**
     * @param ConfigurationManagerInterface  $configurationManager
     * @param InitializationServiceInterface $initializationService
     * @param string                         $name
     */
    public function __construct(
        ConfigurationManagerInterface $configurationManager,
        InitializationServiceInterface $initializationService,
        $name = null
    ) {
        parent::__construct($name);

        $this->configurationManager = $configurationManager;
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
        // Try to read existing configuration or create a new one
        try {
            $project = $this->configurationManager->get();
        } catch (\TypeError $e) {
            $project = new Project();
        }

        /** @var QuestionHelper $interview */
        $interview = $this->getHelper('question');

        $output->writeln('<info>Please provide the following information:</info>');

        $defaultTitle = $project->getTitle() ?? basename(getcwd());
        $projectTitleQuestion = new Question(
            "<question>Title of the project / the extension (not the extension key):</question> <info>{$project->getTitle()}</info>".PHP_EOL,
            $defaultTitle
        );

        $projectTitle = $interview->ask($input, $output, $projectTitleQuestion);
        $project->setTitle($projectTitle);

        $defaultExtensionKeyAnswer = $project->getExtensionKey() ?? basename(getcwd());
        $extensionKeyQuestion = new Question(
            "<question>What is the extension key of your project?</question> <info>{$project->getExtensionKey()}</info>".PHP_EOL,
            $defaultExtensionKeyAnswer
        );

        $name = $interview->ask($input, $output, $extensionKeyQuestion);
        $project->setExtensionKey($name);

        $defaultVendor = $project->getVendor() ?? ucfirst($project->getTitle()).'\\';
        $namespaceQuestion = new Question(
            "<question>Vendor name for your project?</question> <info>{$project->getVendor()}</info>".PHP_EOL,
            $defaultVendor
        );

        $vendor = $interview->ask($input, $output, $namespaceQuestion);
        $project->setVendor($vendor);

        $defaultNamespace = $project->getNamespace() ?? ucfirst($project->getTitle()).'\\';
        $namespaceQuestion = new Question(
            "<question>Namespace of your project?</question> <info>{$project->getNamespace()}</info>".PHP_EOL,
            $defaultNamespace
        );

        $namespace = $interview->ask($input, $output, $namespaceQuestion);
        $project->setNamespace($namespace);

        try {
            $this->configurationManager->write($project);

            $output->writeln(
                '<info>Wrote the configuration to disk. You can now generate the skeleton using the "generate" command</info>'
            );
        } catch (\Exception $e) {
            $output->writeln('<error>Could not write config file.</error>');
        }
    }
}
