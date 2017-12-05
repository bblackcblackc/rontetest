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
    private static $parameters;

    /**
     * @inheritdoc
     */
    public function __construct(array $parameters)
    {
        self::$parameters = $parameters;
    }

    /**
     * @inheritdoc
     */
    public function processData($inputData)
    {
        $dataCopy = $inputData;

        usort($dataCopy,[__CLASS__,'_compare']);

        return $dataCopy;
    }

    /**
     * @param $a First parameter
     * @param $b Second parameter
     * @return bool
     * @method Comparing two arrays by criterias in $parameters
     */
    private static function _compare($a, $b) {

        // iterate over all sort fields
        foreach (self::$parameters['fields'] as $key => $parameter) {

            // check for fields existence
            if (!isset($a[$key]) || !isset($b[$key])) {
                continue;
            }

            // if a > b
            if ($a[$key] > $b[$key]) {
                return ($parameter == SORT_DESC_ORDER) ? -1 : 1;
            }

            // if b < a
            if ($a[$key] < $b[$key]) {
                return ($parameter == SORT_DESC_ORDER) ? 1 : -1;
            }

            // if it equals
            continue;
        }

        return 0;
    }

}