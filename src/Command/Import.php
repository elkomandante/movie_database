<?php


namespace App\Command;


use App\Import\ImportManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class Import extends Command
{
    protected static $defaultName = 'app:import';
    /*** @var Filesystem */
    private $filesystem;

    /**
     * @var ImportManager
     */
    private $importManager;

    public function __construct(Filesystem $filesystem,ImportManager $importManager, string $name = null)
    {
        parent::__construct($name);
        $this->filesystem = $filesystem;
        $this->importManager = $importManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Imports Data.')
            ->setHelp('This command is used for importing data.');

        $this->addArgument('file', InputArgument::REQUIRED, 'Enter a file to be imported');
        $this->addArgument('import_type', InputArgument::REQUIRED, 'Enter import type');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $file = $input->getArgument('file');
        $importType = $input->getArgument('import_type');


        if(!$this->filesystem->exists($file)) {
            $output->writeln('File does not exist');
            return 0 ;
        }

        $this->importManager->runImport($file,$importType);


        return Command::SUCCESS;
    }
}