<?php
/**
 * Sorter Data processor. Sort data by specified field.
 */

class SorterDataProcessorClass implements IDataProcessorClass
{
    use ModuleTrait;

    /**
     * Module name
     */
    const MODULENAME = 'Sorter Data processor';

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
        return $inputData;
    }
}