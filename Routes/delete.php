<?php

require_once(__DIR__ . '/../Services/DBService.php');
use Services\DBService as DBService;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

$connected = DBService::connect();

if ($connected) {

    if (isset($_POST['id'])) {
    DBService::delete('todo', $_POST["id"]);
    }
} else {
    echo "DB not connected";
} 

header("Location: ../index.php");
}