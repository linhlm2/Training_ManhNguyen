<?php

/**
 * LbFaker
 *
 * @package    LbFaker
 * @version    v1.00
 * @author     Julien Huriez
 * @license    MIT License
 * @copyright  2013 Julien Huriez
 * @link   https://github.com/jhuriez/fuel-lbFaker
 */

Autoloader::add_core_namespace('LbFaker');
Autoloader::add_namespace('Faker', __DIR__.'/vendors/Faker/src/Faker/', true);

Autoloader::add_classes(array(
	'Lb\\Faker'                => __DIR__.'/classes/faker.php',
	'Lb\\Faker\\Populator\\FuelORM\\Populator'                => __DIR__.'/classes/populator/FuelORM/populator.php',
	'Lb\\Faker\\Populator\\FuelORM\\EntityPopulator'                => __DIR__.'/classes/populator/FuelORM/entitypopulator.php',
	'Lb\\Faker\\Populator\\FuelORM\\ColumnTypeGuesser'                => __DIR__.'/classes/populator/FuelORM/columntypeguesser.php',
));

// Load config
\Config::load('lbfaker');

/* End of file bootstrap.php */
