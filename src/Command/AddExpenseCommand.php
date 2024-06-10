<?php

namespace App\Command;

use App\Model\Entry;
use App\Service\FileStorageService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AddExpenseCommand extends Command
{
    public function __construct(private FileStorageService $storageService)
    {
        parent::__construct();
    }


    protected function configure()
    {
        $this->setName("expense:add")
            ->setDescription("Add a new Expense")
            ->addOption("amount", null, InputOption::VALUE_REQUIRED, "Amount of expense")
            ->addOption("category", null, InputOption::VALUE_REQUIRED, "Category of expense")
            ->addOption("date", null, InputOption::VALUE_REQUIRED, "Date of expense");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $amount = $input->getOption("amount") ?: $io->ask("Amount");
        $category = $input->getOption("category") ?: $io->ask("Category");
        $date = $input->getOption("date") ?: $io->ask("Date(YYYY-MM-DD)", date("Y-m-d"));

        $entry = new Entry((float) $amount, $category, $date);
        $this->storageService->addExpense($entry);
        $this->storageService->addCategory($category);
        $io->success("Expense added successfully");


        return Command::SUCCESS;
    }
}