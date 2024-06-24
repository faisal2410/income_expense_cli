<?php

$incomes = [];
$expenses = [];
$categories = [];

while (true) {
    echo "\nOptions:\n";
    echo "1. Add income\n";
    echo "2. Add expense\n";
    echo "3. View incomes\n";
    echo "4. View expenses\n";
    echo "5. View savings\n";
    echo "6. View categories\n";
    echo "7. Quit\n";
    echo "Enter your option: ";

    $user_input = (int) readLine(prompt: "Enter your option: ");

    switch ($user_input) {
        case 1:
            // Read income amount as a float
            $incomeAmount = floatval(readLine(prompt: "Enter income amount: "));
            $incomeCategory = readLine(prompt: "Enter income category: ");
            $incomes[] = ["amount" => $incomeAmount, "category" => $incomeCategory];
            echo "Income added successfully!\n";
            break;

        case 2:
            // Read expense amount as a float
            $expenseAmount = floatval(readLine(prompt: "Enter expense amount: "));
            $expenseCategory = readLine(prompt: "Enter expense category: ");
            $expenses[] = ["amount" => $expenseAmount, "category" => $expenseCategory];
            echo "Expense added successfully!\n";
            break;

        case 3:
            echo "\nIncome List:\n";
            foreach ($incomes as $income) {
                echo "Amount: {$income['amount']}, Category: {$income['category']}\n";
            }
            break;

        case 4:
            echo "\nExpense List:\n";
            foreach ($expenses as $expense) {
                echo "Amount: {$expense['amount']}, Category: {$expense['category']}\n";
            }
            break;

        case 5:
            $totalIncome = 0;
            foreach ($incomes as $income) {
                $totalIncome += $income['amount'];
            }

            $totalExpense = 0;
            foreach ($expenses as $expense) {
                $totalExpense += $expense['amount'];
            }

            $savings = $totalIncome - $totalExpense;
            echo "\nTotal Income: $totalIncome\n";
            echo "Total Expense: $totalExpense\n";
            echo "Savings: $savings\n";
            break;

        case 6:
            // Gather and display unique categories
            $allCategories = [];

            foreach ($incomes as $income) {
                $allCategories[] = $income['category'];
            }

            foreach ($expenses as $expense) {
                $allCategories[] = $expense['category'];
            }

            $uniqueCategories = array_values(array_unique($allCategories));

            echo "\nCategories:\n";
            foreach ($uniqueCategories as $category) {
                echo "$category\n";
            }
            break;

        case 7:
            exit(0);

        default:
            echo "Invalid option. Please choose a valid option.\n";
            break;
    }
}
?>
