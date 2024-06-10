<?php
namespace App\Model;

class Entry
{
public function __construct(private float $amount, private string $category, private string $date)
{
    
}
public function getAmount():float
{
    return $this->amount;
}

public function getCategory():string
{
    return $this->category;
}
public function getDate():string
{
    return $this->date;
}

public function toArray():array
{
    return [
        "amount"=>$this->amount,
        "category"=>$this->category,
        "date"=>$this->date
    ];
}



public static function fromArray(array $data):self
{
    return new self($data["amount"],$data["category"],$data["date"]);
}

}