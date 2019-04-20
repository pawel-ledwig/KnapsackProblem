<?php


define('CSV_COLUMNS', 3);
include('CustomAutoloader.php');

$cli = new CLI();
$cli->init($_SERVER['argv']);

$controller = $cli->getController();
$controller->run();

$knapsack = $controller->getKnapsack();

if (!is_null($knapsack))
    echo $knapsack->toString();
else
    echo "Program failed. Check an error messages and run program again.\n";