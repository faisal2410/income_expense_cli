<?php

namespace App\Command;

use App\Service\FileStorageService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ViewExpensesCommand extends Command
{
    public function __construct(private FileStorageService $storageService)
    {
        parent::__construct();
    }


    protected function configure()
    {
        $this->setName("expense:view")
            ->setDescription("View all expenses");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $expenses = $this->storageService->getExpenses();

        $tableData = array_map(
            function ($expense) {
                return [$expense->getAmount(), $expense->getCategory(), $expense->getDate()];
            },
            $expenses
        );

        $io->table(["Amount", "Category", "Date"], $tableData);


        return Command::SUCCESS;
    }
}
