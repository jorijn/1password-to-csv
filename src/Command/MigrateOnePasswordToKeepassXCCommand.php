<?php

namespace App\Command;

use App\Factory\GenericEntryFactory;
use App\Model\OnePasswordEntry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class MigrateOnePasswordToKeepassXCCommand extends Command
{
    protected static $defaultName = 'migrate:1password:keepassxc';

    /** @var SerializerInterface|DenormalizerInterface|NormalizerInterface */
    protected $serializer;
    /** @var GenericEntryFactory */
    protected $genericEntryFactory;
    /** @var Filesystem */
    protected $filesystem;

    /**
     * @param null                $name
     * @param SerializerInterface $serializer
     * @param GenericEntryFactory $genericEntryFactory
     * @param Filesystem          $filesystem
     */
    public function __construct(
        $name = null,
        SerializerInterface $serializer,
        GenericEntryFactory $genericEntryFactory,
        Filesystem $filesystem
    ) {
        parent::__construct($name);
        $this->serializer = $serializer;
        $this->genericEntryFactory = $genericEntryFactory;
        $this->filesystem = $filesystem;
    }

    protected function configure()
    {
        $this
            ->setDescription('Migrates 1Password 1pif files to KeepassXC compatible CSV files')
            ->addOption('in', null, InputOption::VALUE_REQUIRED, 'Location to the 1Password .1pif file')
            ->addOption('out', null, InputOption::VALUE_REQUIRED, 'Location to the KeepassXC .csv file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $inFile = $input->getOption('in');
        $outFile = $input->getOption('out');

        if (!is_readable($inFile)) {
            $io->error('file '.$inFile.' is not readable');

            return 1;
        }

        if ($this->filesystem->exists($outFile)) {
            $io->error('file '.$outFile.' already exists, please remove or rename this before attempting migration');

            return 1;
        }

        // parse the input file to a list of 1Password models
        /* @var \App\Model\OnePasswordEntry[] $entries */
        $entries = $this->serializer->deserialize(file_get_contents($inFile), OnePasswordEntry::class.'[]', '1pif');
        $entries = array_values($entries);

        // use the symfony serializer to convert them to generic entries
        $entries = array_map(function (OnePasswordEntry $entry) {
            return $this->genericEntryFactory->mapFrom($entry);
        }, $entries);

        // use the symfony serializer to turn this into csv
        $csv = $this->serializer->serialize($entries, 'csv');

        $this->filesystem->dumpFile($outFile, $csv);
        $io->block('successfully processed '.count($entries).' entries, wrote output to '.$outFile, null, 'success');
    }
}
