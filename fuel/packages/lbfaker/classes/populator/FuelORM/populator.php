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

class Populator {

    protected $generator;
    protected $entities = array();
    protected $quantities = array();

    public function __construct(\Faker\Generator $generator) {
        $this->generator = $generator;
    }

    /**
     * Add an order for the generation of $number records for $entity.
     *
     * @param mixed $entity ORM/Model classname, or a \Lb\Faker\Populator\FuelORM\EntityPopulator instance
     * @param int   $number The number of entities to populate
     */
    public function addEntity($entity, $number, $customColumnFormatters = array()) {
        if (!$entity instanceof \Lb\Faker\Populator\FuelORM\EntityPopulator) {
            $entity = new \Lb\Faker\Populator\FuelORM\EntityPopulator($entity);
        }
        $entity->setColumnFormatters($entity->guessColumnFormatters($this->generator));
        if ($customColumnFormatters) {
            $entity->mergeColumnFormattersWith($customColumnFormatters);
        }
        $f = $entity->getColumnFormatters();
        
        $class = $entity->getClass();
        $this->entities[$class] = $entity;
        $this->quantities[$class] = $number;
        
    }

    /**
     * Populate the database using all the Entity classes previously added.
     *
     * @return array A list of the inserted entities.
     */
    public function execute() {
        $insertedEntities = array();
        foreach ($this->quantities as $class => $number) {
            for ($i = 0; $i < $number; $i++) {
                $insertedEntities[$class][] = $this->entities[$class]->execute($insertedEntities);
            }
        }
        
        return $insertedEntities;
    }

}

