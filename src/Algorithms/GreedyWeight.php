<?php


class GreedyWeight extends Algorithm
{

    public function __construct($capacity, $item_data)
    {
        parent::__construct($capacity, $item_data);
    }

    /**
     * Method used to fill knapsack - choose best items using greedy algorithm with lowest weight criterion.
     * @return Knapsack
     */
    public function fillKnapsack(): Knapsack
    {
        uasort($this->item_data, function ($a, $b) {
            return $a['weight'] <=> $b['weight'];
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