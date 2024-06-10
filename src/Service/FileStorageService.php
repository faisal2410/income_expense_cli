<?php
namespace App\Service;

use App\Model\Entry;

class FileStorageService
{
    public function __construct(private string $incomeFile, private string $expenseFile, private string $categoryFile)
    {
        
    }

    private function readFile(string $filePath):array
    {
        if(!file_exists($filePath)){
            return [];
        }
        $content=file_get_contents($filePath);
        if($content==false){
            return [];
        }
        return json_decode($content,true);  //need explanation why true flag is used

    }

    private function writeFile(string $filePath, array $data):void
    {
        file_put_contents($filePath, json_encode($data,JSON_PRETTY_PRINT));  //need explanation
    }

    public function addIncome(Entry $entry):void
    {
        $incomes=$this->readFile($this->incomeFile);
        $incomes[]=$entry->toArray();
        $this->writeFile($this->incomeFile, $incomes);
    }

    public function addExpense(Entry $entry):void
    {
        $expenses=$this->readFile($this->expenseFile);
        $expenses[]=$entry->toArray();
        $this->writeFile($this->expenseFile, $expenses);
    }

    public function getIncomes():array
    {
        $data=$this->readFile($this->incomeFile);
        return array_map([Entry::class,"fromArray"], $data);
    }

    public function getExpenses():array
    {
        $data=$this->readFile($this->expenseFile);
        return array_map([Entry::class,"fromArray"],$data);
    }

    public function getCategories():array
    {
        return $this->readFile($this->categoryFile);
    }

    public function addCategory(string $category):void
    {
        $categories=$this->readFile($this->categoryFile);
        if(!in_array($category, $categories)){
            $categories[]=$category;
            $this->writeFile($this->categoryFile,$categories);
        }
    }
}