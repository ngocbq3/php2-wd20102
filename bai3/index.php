<?php
require_once __DIR__ . "/vendor/autoload.php";

use App\HKBank;

$person1 = new HKBank('Khánh', 12345, 10000);
$person2 = new HKBank('Quân', 12346, 1000);

$person1->transfer($person2, 5000);
echo "Số tiền còn lại của TK " . $person1->getNumberAcc() . " là " . $person1->getBalace();
