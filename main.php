<?php

require_once __DIR__."/vendor/autoload.php";

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Output\ConsoleOutput;
use App\Command\AddIncomeCommand;
use App\Command\AddExpenseCommand;
use App\Command\ViewIncomesCommand;
use App\Command\ViewSavingsCommand;
use App\Service\FileStorageService;
use App\Command\ViewExpensesCommand;
use App\Command\ViewCategoriesCommand;

$app =new Application();

$storageService=new FileStorageService(

    __DIR__."/data/incomes.json",
    __DIR__."/data/expenses.json",
    __DIR__."/data/categories.json"

);

$app->add(new AddIncomeCommand($storageService));
$app->add(new AddExpenseCommand($storageService));
$app->add(new ViewIncomesCommand($storageService));
$app->add(new ViewExpensesCommand($storageService));
$app->add(new ViewSavingsCommand($storageService));
$app->add(new ViewCategoriesCommand($storageService));




$input = new ArgvInput();
$output = new ConsoleOutput();

$io = new SymfonyStyle($input, $output);

$io->title('Income & Expense Manager CLI');


$options = [
    'income:add' => 'Add income',
    'expense:add' => 'Add expense',
    'income:view' => 'View incomes',
    'expense:view' => 'View expenses',
    'savings:view' => 'View savings',
    'category:view' => 'View categories',
    'exit'=>'Exit'
];


while (true) {
    $io->text('Please select an option:');
    $selection = $io->choice('Choose a command', $options);

    if ($selection === 'exit') {
        $io->success('Exiting the Income & Expense Manager CLI. Goodbye!');
        break; // Exit the loop if the user selects 'exit'
    }

    $commandInput = new ArrayInput(['command' => $selection]);

    try {
        // $app->run($commandInput);
        $app->doRun($commandInput, $output);
        $io->success('Command executed successfully!');
    } catch (Exception $e) {
        $io->error('An error occurred: ' . $e->getMessage());
    }
}

