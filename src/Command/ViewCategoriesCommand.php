<?php

namespace App\Command;

use App\Service\FileStorageService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ViewCategoriesCommand extends Command
{
    public function __construct(private FileStorageService $storageService)
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName("category:view")
        ->setDescription("View all categories");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $categories = $this->storageService->getCategories();

        $io->listing($categories);


        return Command::SUCCESS;
    }


}
