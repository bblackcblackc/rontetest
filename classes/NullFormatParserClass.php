<?php
/**
 * Null (fake) Detector and parser class
 */

class NullFormatParserClass implements IFormatParserClass
{
    use ModuleTrait, FormatNameTrait;

    /**
     * Module name
     */
    const MODULENAME = 'Null (fake) data detector and parser';

    /**
     * Format name
     */
    const FORMATNAME = 'NULL';

    /**
     * @param string $data data
     * @return float format match probability
     */
    public static function formatMatchProbability(string $data)
    {
        return 0;
    }

    /**
     * @param string $data Input data
     * @return array Parsed data
     */
    public function parseData(string $data)
    {
        return [];
    }

}