<?php
namespace App\Command;

use App\Model\Entry;
use App\Service\FileStorageService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AddIncomeCommand extends Command
{
    public function __construct(private FileStorageService $storageService)
    {
        parent::__construct();
    }



    protected function configure()
    {
        $this->setName("income:add")
        ->setDescription("Add a new Income")
        ->addOption("amount",null,InputOption::VALUE_REQUIRED,"Amount of income")
        ->addOption("category",null,InputOption::VALUE_REQUIRED,"Category of Income")
        ->addOption("date",null, InputOption::VALUE_REQUIRED,"Date of income");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io=new SymfonyStyle($input, $output);
        $amount=$input->getOption("amount")?:$io->ask("Amount"); 
        $category=$input->getOption("category")?:$io->ask("Category");
        $date=$input->getOption("date")?:$io->ask("Date(YYYY-MM-DD)",date("Y-m-d"));

        // var_dump($amount, $category, $date);
        // die();

        $entry =new Entry((float)$amount, $category, $date);
        $this->storageService->addIncome($entry);
        $this->storageService->addCategory($category);
        $io->success("Income added successfully");


        return Command::SUCCESS;
    }
}