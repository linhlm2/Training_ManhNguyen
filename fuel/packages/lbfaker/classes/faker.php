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

namespace Lb;

class Faker {

    public static function faker($group = 'default') {
        if ($group = \Config::get('lb.faker.' . $group)) {
            $seed = (isset($group['seed']) && is_int($group['seed'])) ? $group['seed'] : null;
            $locale = (isset($group['locale'])) ? $group['locale'] : 'en_US';

            $generator = \Faker\Factory::create($locale);
            if ($seed !== null)
                $generator->seed($seed);

            // Instance populator
            $classPopulator = (isset($group['populator'])) ? $group['populator'] : "\Lb\Faker\Populator\FuelORM\Populator";
            $populator = new $classPopulator($generator);            
            
            // Fetch entities
            foreach ($group['entities'] as $className => $entity) {
                $number = (isset($entity['number']) && is_int($entity['number'])) ? $entity['number'] : 1;

                // Custom  formatters
                $customColumnFormatters = array();
                $customFormatters = (isset($entity['custom_formatters'])) ? $entity['custom_formatters'] : array();
                foreach ($customFormatters as $fieldName => $customFormatter) {

                    if (array_key_exists('method', $customFormatter)) {
                        $method = $customFormatter['method'];

                        if ($customFormatter['method'] === null) {
                            $customColumnFormatters[$fieldName] = null;
                        }
                        // If the method is callable, we set the closure
                        else {
                            $parameters = (isset($customFormatter['parameters'])) ? $customFormatter['parameters'] : array();
                            if (count($parameters) === 0)
                                $closure = function() use ($generator, $method) {
                                            return $generator->$method();
                                        };
                            else
                                $closure = function() use ($generator, $method, $parameters) {
                                            return call_user_func_array(array($generator, $method), (array) $parameters);
                                        };

                            $customColumnFormatters[$fieldName] = $closure;
                        }
                    }
                }

                // Add the entity
                $populator->addEntity($className, $number, $customColumnFormatters);
            }

            return $populator->execute();
        } else {
            return false;
        }
    }

}

class Faker_Exception extends \FuelException {
    
}