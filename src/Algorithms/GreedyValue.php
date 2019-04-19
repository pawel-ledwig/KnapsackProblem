<?php


class GreedyValue extends Algorithm
{

    public function __construct($capacity, $item_data)
    {
        parent::__construct($capacity, $item_data);
    }

    /**
     * Method used to fill knapsack - choose best items using greedy algorithm with highest value criteria.
     * @return Knapsack
     */
    public function fillKnapsack(): Knapsack
    {

    }
}