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

namespace Lb\Faker\Populator\FuelORM;

/**
 * Service class for populating a table through a FuelORM class.
 */
class EntityPopulator {

    protected $class;
    protected $columnFormatters = array();

    /**
     * Class constructor.
     *
     * @param string $class A FuelORM classname
     */
    public function __construct($class) {
        $this->class = $class;
    }

    public function getClass() {
        return $this->class;
    }

    public function setColumnFormatters($columnFormatters) {
        $this->columnFormatters = $columnFormatters;
    }

    public function getColumnFormatters() {
        return $this->columnFormatters;
    }

    public function mergeColumnFormattersWith($columnFormatters) {
        $this->columnFormatters = array_merge($this->columnFormatters, $columnFormatters);
    }

    public function guessColumnFormatters(\Faker\Generator $generator) {
        $formatters = array();
        $nameGuesser = new \Faker\Guesser\Name($generator);
        $columnTypeGuesser = new \Lb\Faker\Populator\FuelORM\ColumnTypeGuesser($generator);

        $obj = new $this->class;
        $fields = $obj->properties();

        // fields
        foreach ($fields as $fieldName => $field) {
                if ($formatter = $nameGuesser->guessFormat($fieldName)) {
                    $formatters[$fieldName] = $formatter;
                    continue;
                }
                if ($formatter = $columnTypeGuesser->guessFormat($field)) {
                    $formatters[$fieldName] = $formatter;
                    continue;
                }
        }

        // references
        $relations = $obj->relations();

        foreach ($relations as $fieldName => $relation) {
            
            // Has One
            if ($relation instanceof \Orm\HasOne) {
                $referenceClass = $relation->model_to;
                $formatters[$fieldName] = function($inserted) use ($referenceClass) {
                            if (isset($inserted[$referenceClass]))
                                return $inserted[$referenceClass][mt_rand(0, count($inserted[$referenceClass]) - 1)];
                            else if (isset($inserted['\\' . $referenceClass]))
                                return $inserted['\\' . $referenceClass][mt_rand(0, count($inserted['\\' . $referenceClass]) - 1)];
                            else
                                return null;
                        };
            }
        }

        return $formatters;
    }

    /**
     * Insert one new record using the Entity class.
     */
    public function execute($insertedEntities) {
        $obj = new $this->class;
        $metadata = $obj->properties();
        $relations = $obj->relations();

        foreach ($this->columnFormatters as $column => $format) {
            if (null !== $format) {
                $value = is_callable($format) ? $format($insertedEntities, $obj) : $format;
                if (isset($metadata[$column]) || isset($relations[$column])) {
                    $obj->$column = $value;
                }
            }
        }
        
        $obj->save();
        return $obj;
    }

}