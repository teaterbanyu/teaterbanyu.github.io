<?php
require "vendor/autoload.php";

use App\SQLiteConnection as SQLiteConnection;
use App\SQLiteQuerySelect as SQLiteQuerySelect;

$pdo = (new SQLiteConnection())->connect();
$sqlite = new SQLiteQuerySelect($pdo);

header('Content-type: application/json; charset=utf-8');

if(isset($_POST['one'])){
    $q =  trim($_POST['one']);
    $tabForm = $sqlite->getAsetById($q);
    echo json_encode($tabForm, true);
    
}
?>