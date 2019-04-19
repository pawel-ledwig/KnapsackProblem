<?php


class Knapsack
{
    private $capacity;
    private $knapsack_items;

    public function __construct($capacity)
    {
        $this->capacity = $capacity;
    }

    /**
     * Get maximum capacity of the knapsack
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Add new item to the knapsack
     * @param $item_id
     * @param $item_weight
     * @param $item_value
     */
    public function addItem($item_id, $item_weight, $item_value)
    {
        $this->knapsack_items[$item_id] = array(
            'weight' => $item_weight,
            'value' => $item_value,
        );
    }

    /**
     * Calculate current weight of the knapsack
     * @return float
     */
    public function getKnapsackWeight(){
        $total_weight = 0.0;

        foreach ($this->knapsack_items as $id => $item){
            $total_weight += $item['weight'];
        }

        return $total_weight;
    }

    /**
     * Calculate current value of all items in the knapsack
     * @return float
     */
    public function getKnapsackValue(){
        $total_value = 0.0;

        foreach ($this->knapsack_items as $id => $item){
            $total_value += $item['value'];
        }

        return $total_value;
    }
}