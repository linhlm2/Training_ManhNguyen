<?php

return array(
    'lb' => array(
        'faker' => array(
            
            // Group 'example'
            'example' => array(
                
                // Other populator :
                //     \Faker\ORM\Doctrine\Populator
                //     \Faker\ORM\Mandango\Populator
                //     \Faker\ORM\Propel\Populator
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

            'test' => array(
                
                // Other populator :
                //     \Faker\ORM\Doctrine\Populator
                //     \Faker\ORM\Mandango\Populator
                //     \Faker\ORM\Propel\Populator
                'populator' => '\Lb\Faker\Populator\FuelORM\Populator',
                'seed' => null,
                'locale' => 'en_US',
                // Entities
                'entities' => array(
                    '\Model_User' => array(
                        'number' => 1,
                        'username' => array(
                            'method' => 'username',
                            'parameters' => array(10, 70),
                        ),
                        'name' => array(
                            'method' => 'name',
                        ),
                        'email' => array(
                            'method' => 'mail',
                        ),
                    ),
                ),
            ),
            
        ),
    ),
);

