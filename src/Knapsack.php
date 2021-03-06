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
     * @return float
     */
    public function getCapacity(): float
    {
        return $this->capacity;
    }

    /**
     * Add new item to the knapsack
     * @param $item_id
     * @param $item_weight
     * @param $item_value
     */
    public function addItem($item_id, $item_weight, $item_value): void
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
    public function getKnapsackWeight(): float
    {
        $total_weight = 0.0;

        if (is_array($this->knapsack_items)) {
            foreach ($this->knapsack_items as $id => $item) {
                $total_weight += $item['weight'];
            }
        }

        return $total_weight;
    }

    /**
     * Calculate current value of all items in the knapsack
     * @return float
     */
    public function getKnapsackValue(): float
    {
        $total_value = 0.0;

        if (is_array($this->knapsack_items)) {
            foreach ($this->knapsack_items as $id => $item) {
                $total_value += $item['value'];
            }
        }

        return $total_value;
    }

    public function toString(): string
    {
        $return_string = "Items in the knapsack:\n";
        foreach ($this->knapsack_items as $item_id => $item_data) {
            $return_string .= "ID: $item_id, weight: " . $item_data['weight'] . " value: " . $item_data['value'] . "\n";
        }
        return $return_string . "\n" .
            "Total weight: " . $this->getKnapsackWeight() . "\n" .
            "Total value: " . $this->getKnapsackValue() . "\n";
    }
}