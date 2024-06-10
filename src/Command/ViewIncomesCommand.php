<?php

namespace App\Command;

use App\Service\FileStorageService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ViewIncomesCommand extends Command
{
    public function __construct(private FileStorageService $storageService)
    {
        parent::__construct();
    }


    protected function configure()
    {
        $this->setName("income:view")
            ->setDescription("View all incomes");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $incomes = $this->storageService->getIncomes();

        $tableData = array_map(
            function ($income) {
                return [$income->getAmount(), $income->getCategory(), $income->getDate()];
            },
            $incomes
        );

        $io->table(["Amount","Category","Date"],$tableData);


        return Command::SUCCESS;
    }
}
