<?php

require_once 'vendor/autoload.php';
require_once 'classes/autoload.php';


use \Classes\Model;
use \Classes\Helper;

$model = new Model();

echo "<h1>Cafe</h1>\n";


$drinks = $model->getDrinks();
//
//var_dump($drinks);

Helper::displayDrinks($drinks);



