<?php
/**
 * Random Char Data processor. Adds a random character to specified field
 */

class RandomCharDataProcessorClass implements IDataProcessorClass
{
    use ModuleTrait;

    /**
     * Module name
     */
    const MODULENAME = 'Random character Data processor';

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

        // iterate over each field from modify list
        foreach ($this->parameters['fields'] as $fieldName) {
            // iterate over input data
            foreach ($dataCopy as &$row) {
                if (isset($row[$fieldName])) {
                    // dataset have this field

                    // add random char to field
                    $row[$fieldName] .= ' ' . chr(ord('A') + rand(0,25));
                }
            }
        }

        return $dataCopy;
    }
}