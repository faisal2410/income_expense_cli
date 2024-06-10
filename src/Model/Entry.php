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


/*
: self: This indicates that the function returns an instance of the Entry class itself (denoted by self).

Purpose:

This fromArray method provides a convenient way to create an Entry object from an existing associative array containing the necessary data (amount, category, date). This allows you to populate Entry objects from various sources like databases or external data feeds that provide information in an array format.

*/ 
public static function fromArray(array $data):self
{
    return new self($data["amount"],$data["category"],$data["date"]);
}

}