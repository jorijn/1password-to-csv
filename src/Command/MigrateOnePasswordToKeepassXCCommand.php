<?php

namespace App\Command;

use App\Factory\GenericEntryFactory;
use App\Model\OnePasswordEntry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class MigrateOnePasswordToKeepassXCCommand extends Command
{
    protected static $defaultName = 'migrate:1password:keepassxc';

    /** @var SerializerInterface|DenormalizerInterface */
    protected $serializer;
    /** @var GenericEntryFactory */
    protected $genericEntryFactory;

    public function __construct($name = null, SerializerInterface $serializer, GenericEntryFactory $genericEntryFactory)
    {
        parent::__construct($name);
        $this->serializer = $serializer;
        $this->genericEntryFactory = $genericEntryFactory;
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

        // parse the input file to a list of 1Password models
        /** @var OnePasswordEntry[] $entries */
        $entries = $this->serializer->deserialize(file_get_contents($inFile), OnePasswordEntry::class.'[]', '1pif');

        // use the symfony serializer to convert them to generic entries
        $entries = array_map(function (OnePasswordEntry $entry) {
            return $this->genericEntryFactory->mapFrom($entry);
        }, $entries);

        // use the symfony serializer to turn this into csv
        $csv = $this->serializer->serialize($entries, 'csv');

//        dump($csv);
    }
}
