<?php

namespace App\Command;

use App\Factory\GenericItemFactory;
use App\Model\GenericSecretEntry;
use App\Model\OnePasswordEntry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\SerializerInterface;

class Migrate1passwordKeepassxcCommand extends Command
{
    protected static $defaultName = 'migrate:1password:keepassxc';

    /**
     * @var SerializerInterface
     */
    protected $serializer;
    /**
     * @var GenericItemFactory
     */
    protected $itemFactory;

    public function __construct($name = null, SerializerInterface $serializer, GenericItemFactory $itemFactory)
    {
        parent::__construct($name);
        $this->serializer = $serializer;
        $this->itemFactory = $itemFactory;
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

        // now use the generic item factory to convert these items to generic "secret" models
        $entries = array_map(function (OnePasswordEntry $entry) {
            return $this->itemFactory->create($entry);
        }, $entries);

        // use the symfony serializer to turn this into csv
        $csv = $this->serializer->serialize($entries, 'csv');

        dump($csv);
    }
}
