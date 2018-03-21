<?php

require_once 'vendor/autoload.php';
require_once 'classes/autoload.php';


use \Classes\Model;

$model = new Model();


$model->addDrink(
	[
		'name' => 'Coffee',
		'description' => 'Aroma – Though inherent in the bean, Aroma intensifies as the Roast reaches medium dark, then tapers off to become a singular Roast note'
	],
	[
		[
			'name' => 'Coffee',
			'price' => '0.4'
		],
		[
			'name' => 'Water',
			'price' => '0.1'
		],
		[
			'name' => 'Sugar',
			'price' => '0.3'
		],
	]
);

$model->addDrink(
	[
		'name' => 'Tea',
		'description' => 'Black Tea'
	],
	[
		[
			'name' => 'TeaBag',
			'price' => '0.2'
		],
		[
			'name' => 'Water',
			'price' => '0.1'
		]
	]
);

$model->addDrink(
	[
		'name' => 'Cappuccino',
		'description' => 'Flavored cappuccinos'
	],
	[
		[
			'name' => 'Coffee',
			'price' => '0.4'
		],
		[
			'name' => 'Water',
			'price' => '0.1'
		],
		[
			'name' => 'Milk',
			'price' => '0.2'
		]
	]
);

echo '3 drinks added';
