<?php


class GreedyRatio extends Algorithm
{

    public function __construct($capacity, $item_data)
    {
        parent::__construct($capacity, $item_data);
    }

    /**
     * Method used to fill knapsack - choose best items using greedy algorithm with highest value/weight ratio criterion.
     * @return Knapsack
     */
    public function fillKnapsack(): Knapsack
    {
        uasort($this->item_data, function ($a, $b) {
            return $b['value'] / $b['weight'] <=> $a['value'] / $a['weight'];
        });

        $knapsack = new Knapsack($this->capacity);

        foreach ($this->item_data as $id => $item) {
            if ($item['weight'] + $knapsack->getKnapsackWeight() <= $knapsack->getCapacity()) {
                $knapsack->addItem($id, $item['weight'], $item['value']);
            }
        }

        return $knapsack;
    }
}