<?php

require_once(__DIR__ . '/../Services/DBService.php');
use Services\DBService as DBService;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$connected = DBService::connect();

if ($connected) {
    DBService::insert('todo', ['value', 'completed'], [$_POST['value'], 0]);
} else {
    echo "DB not connected";
}  
header("Location: ../index.php");
}