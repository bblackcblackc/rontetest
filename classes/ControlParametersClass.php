<?php
/**
 * Control Parameters collector Class
 *
 * aggregates control parameters and methods
 */

class ControlParametersClass
{
    /**
     * @var array of ControlParameters objects
     */
    private static $controlParametersObjects = [];

    /**
     * Adds a ControlParameters object to pool
     *
     * @param IControlParametersClass control parameter object
     * @return void
     */
    public static function addControlParametersObject(IControlParametersClass $controlParamsObject) {
        self::$controlParametersObjects[$controlParamsObject->getName()] = $controlParamsObject;
    }

    /**
     * @method Returns all collected control parameters
     * @return array[] parameters as array of 'key' => 'value' arrays
     */
    public static function getParams() {

        // array for collecting parameters
        $controlParams = [];

        // collect parameters
        foreach (self::$controlParametersObjects as $controlParamsObject) {
            $controlParams = array_merge($controlParams,$controlParamsObject->fetchParameters());
        }

        return $controlParams;
    }
}