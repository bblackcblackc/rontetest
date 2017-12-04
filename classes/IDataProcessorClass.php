<?php
/**
 * Interface definitions for Data processing module
 */

interface IDataProcessorClass extends IModuleClass
{

    /**
     * IDataProcessorClass constructor.
     * @param array $parameters Data process parameters
     */
    public function __construct(array $parameters);

    /**
     * @return array Processed Data
     * @param array $inputData Input Data
     */
    public function processData($inputData);
}