<h1>Fuel LbFaker</h1>

FuelPHP package for use Faker PHP Library with FuelORM Model. This library generates fake data for you as simple as possible.

<h2>Installation</h2>

### Manual

1. Clone or download the fuel-lbFaker repository
2. Move it in fuel/packages/
3. Edit the config file fuel/packages/lbfaker/config/lbfaker.php
4. Add 'lbfaker' to the 'always_load/packages' array in app/config/config.php (or call `\Fuel\Core\Package::load('lbfaker');` whenever you want to use it).

Recommended :
If you don't want to change the config file in `fuel/packages/lbfaker/config/lbfaker.php`, you can create your own config file in `fuel/app/config/lbfaker.php`.
And copy the entirely of the original config file.


<h2>Usage</h2>

The usage is simple, once you have configured the package, use this method :
```php
\Lb\Faker::faker($groupName);
```

With the group 'example' : 
```php
\Lb\Faker::faker('example');
```

You can use this package with a simple oil command here : https://github.com/jhuriez/fuel-lbFakerTask

<h2>Configuration</h2>

For use this package, you have to configure it.

You need to create 'group', here the example :

```php
    'lb' => array(
        'faker' => array(
            
            // Group 'example'
            'example' => array(
                'populator' => '\Lb\Faker\Populator\FuelORM\Populator',
                'seed' => null,
                'locale' => 'en_US',
           ),
        ),
    ),
```

You have some optional options like "populator", "seed" and "local".
For real example look the configuration file "lbfaker/config/lbfaker.php"


<h2>Configure entities</h2>

Once you have create the group in configuration file, you need to add your entities you want to populate, and their quantities (default: 1) :
```php
                // Entities
                'entities' => array(
                    '\Model_Profile' => array(
                        'number' => 1,
                        'custom_formatters' => array(

                        ),
                    ),
                    '\Model_Person' => array(
                        'number' => 4,
                        'custom_formatters' => array(

                        ),
                    ),
                ),
```

<h2>Custom formatters</h2>

You can use custom formatters for each column of each entity :

```php
                // Entities
                'entities' => array(
                    '\Model_Profile' => array(
                        'number' => 1,
                        'custom_formatters' => array(
                            'label' => array(
                                'method' => 'sentence',
                                'parameters' => 3,
                            ),
                        ),
                    ),
                    '\Model_Person' => array(
                        'number' => 1,
                        'custom_formatters' => array(
                            'age' => array(
                                'method' => 'randomNumber',
                                'parameters' => array(10, 70),
                            ),
                            'name' => array(
                                'method' => 'name',
                            ),
                            'email' => array(
                                'method' => null,
                            ),
                        ),
                    ),
                ),
```

Here is the list of all custom formatter method : https://github.com/fzaninotto/Faker#formatters

Note: If you use null in 'method', the column will not be populate

<h2>Use custom ORM Populator</h2>

You use Doctrine, Propel or Mandango ORM ? Just set the specific populator class in the group array :

```php
    'lb' => array(
        'faker' => array(
            
            // Group 'example'
            'example' => array(
                
                // Other populator :
                //     \Faker\ORM\Doctrine\Populator
                //     \Faker\ORM\Mandango\Populator
                //     \Faker\ORM\Propel\Populator
                'populator' => '\Lb\Faker\Populator\FuelORM\Populator',
            ),
        ),
     ),
```

<h2>Complete example of configuration :</h2>

```php
    'lb' => array(
        'faker' => array(
            
            // Group 'example'
            'example' => array(
                'populator' => '\Lb\Faker\Populator\FuelORM\Populator',
                'seed' => null,
                'locale' => 'en_US',
                // Entities
                'entities' => array(
                    '\Model_Profile' => array(
                        'number' => 1,
                        'custom_formatters' => array(
                            'label' => array(
                                'method' => 'sentence',
                                'parameters' => 3,
                            ),
                        ),
                    ),
                    '\Model_Person' => array(
                        'number' => 1,
                        'custom_formatters' => array(
                            'age' => array(
                                'method' => 'randomNumber',
                                'parameters' => array(10, 70),
                            ),
                            'name' => array(
                                'method' => 'name',
                            ),
                            'email' => array(
                                'method' => null,
                            ),
                        ),
                    ),
                ),
            ),
            // END group example
            
        ),
    ),
```

<h2>Column type configuration</h2>

The package use the field "data_type" of properties of the model for know the column type

### Example with \Model_Profile :

```php
<?php

class Model_Profile extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'label' => array(
                                        'data_type' => 'string'
                                    ),
		'active' => array(
                                        'data_type' => 'boolean',
                                    ),
                                    'idUser',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);
}
```

<h2>FuelORM Model Relations</h2>

For the moment, only `Has_One` relation work. For example if you have `Profile` and `Person` entities, the `Person` `Has_One` `Profil`.

When fake data will be generated, `Person` entity will contains a fake generated `Profil` entity in his relation (Has_One)

Note: `Profil` entity need to be before the `Person` entity in the configuration array 

<h2>Fake PHP Library</h2>

More info with the Fake PHP Library : https://github.com/fzaninotto/Faker