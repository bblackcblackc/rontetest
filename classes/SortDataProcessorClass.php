<?php
/**
 * Sort Data processor. Sort data by fields
 */

class SortDataProcessorClass implements IDataProcessorClass
{
    use ModuleTrait;

    /**
     * Module name
     */
    const MODULENAME = 'Sort Data processor';

    /**
     * @var array Module parameters
     */
    private $parameters;

    /**
     * @inheritdoc
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @inheritdoc
     */
    public function processData($inputData)
    {
        $dataCopy = $inputData;

        return $dataCopy;
    }

}