<?php


abstract class Algorithm
{
    protected $capacity;
    protected $item_data;

    public function __construct($capacity, $item_data)
    {
        $this->capacity = $capacity;
        $this->item_data = $item_data;
    }

    abstract public function calculateKnapsack(): Knapsack;
}