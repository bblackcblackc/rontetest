<?php
/**
 * Data detector & parser interface
 */

interface IFormatParserClass extends IModuleClass
{

    /**
     * @return float Match probability (0..1)
     * @param string $data data for format detection
     */
    public static function formatMatchProbability(string $data);

    /**
     * @return array Parsed data
     * @param string $data Input data
     */
    public function parseData(string $data);
}