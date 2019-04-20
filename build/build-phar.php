<?php

$phar_file = "knapsack.phar";

// delete previous version if exists
if (file_exists($phar_file)) {
    unlink($phar_file);
}

// create phar
$phar = new Phar($phar_file);

// creating our library using whole directory
$phar->buildFromDirectory('../src/');

// pointing main file which requires all classes
$phar->setDefaultStub('index.php', '/index.php');

echo "$phar_file successfully created";