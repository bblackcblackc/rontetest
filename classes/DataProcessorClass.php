<?php
/**
 * Data Processor class
 *
 * Process data by injected classes
 */

class DataProcessorClass
{

    /**
     * @var array $dataProcessors array of DataProcessor objects
     */
    private static $dataProcessors = [];

    /**
     * @param IDataProcessorClass $processor DataProcessor object
     * @method Adds Data processor to data process pool
     */
    public static function addDataProcessor(IDataProcessorClass $processor) {
        self::$dataProcessors[$processor->getName()] = $processor;
    }

    /**
     * @param $data Input data
     * @return array Processed data
     */
    public static function getProcessedData($data) {
        return $data;
    }
}