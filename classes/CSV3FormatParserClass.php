<?php
/**
 * CSV Detector and parser class
 */

class CSV3FormatParserClass implements IFormatParserClass
{
    use ModuleTrait, FormatNameTrait;

    /**
     * Module name
     */
    const MODULENAME = 'CSV 3 field data detector and parser';

    /**
     * Format name
     */
    const FORMATNAME = 'CSV3';

    /**
     * @param string $data data
     * @return float format match probability
     */
    public static function formatMatchProbability(string $data)
    {
        return 1;
    }

    /**
     * Method parses CSV data
     *
     * @param string $data Input data
     * @return array parsed data
     */
    public function parseData(string $data)
    {
        $dataByLines = explode(PHP_EOL,$data);
        $dataArray = [];
        $fieldSpec = [];
        $firstLine = true;

        // iterate over all data lines
        foreach ($dataByLines as $dataLine) {
            if (!empty($dataLine)) {
                $parsedString = str_getcsv($dataLine);

                // if it is 1st line
                if ($firstLine) {

                    // we have to extract field specification
                    $fieldSpec = $parsedString;

                    $firstLine = false;

                } else {

                    $tmpArray = [];

                    // add parsed data to array
                    foreach ($parsedString as $key => $item) {

                        // if we have a field spec
                        if (isset($fieldSpec[$key])) {
                            $tmpArray[$fieldSpec[$key]] = $item;
                        } else {
                            // no field specification
                            $tmpArray[] = $item;
                        }
                    }

                    // copy to data array
                    $dataArray[] = $tmpArray;
                }
            }
        }

        return $dataArray;
    }

}