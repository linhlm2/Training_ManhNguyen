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

class ColumnTypeGuesser {

    protected $generator;

    public function __construct(\Faker\Generator $generator) {
        $this->generator = $generator;
    }

    public function guessFormat($field) {
        $generator = $this->generator;
        $type = isset($field['data_type']) ? $field['data_type'] : 'null';
        switch ($type) {
            case 'boolean':
                return function() use ($generator) {
                            return $generator->boolean;
                        };
            case 'decimal':
                $size = 2;

                return function() use ($generator, $size) {
                            return $generator->randomNumber($size + 2) / 100;
                        };
            case 'smallint':
                return function() {
                            return mt_rand(0, 65535);
                        };
            case 'integer':
                return function() {
                            return mt_rand(0, intval('4294967295'));
                        };
            case 'bigint':
                return function() {
                            return mt_rand(0, intval('18446744073709551615'));
                        };
            case 'float':
                return function() {
                            return mt_rand(0, intval('4294967295')) / mt_rand(1, intval('4294967295'));
                        };
            case 'string':
                $size = isset($field['validation']['max_length']) ? $field['validation']['max_length'] : 255;

                return function() use ($generator, $size) {
                            return $generator->text($size);
                        };
            case 'text':
                return function() use ($generator) {
                            return $generator->text;
                        };
            case 'datetime':
            case 'date':
            case 'time':
                return function() use ($generator) {
                            return $generator->datetime;
                        };
            default:
                // no smart way to guess what the user expects here
                return null;
        }
    }

}
