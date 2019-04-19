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
        uasort($this->item_data, function ($a, $b) {
            return $b['value'] <=> $a['value'];
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