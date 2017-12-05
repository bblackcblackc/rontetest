<?php
/**
 * Format detector and parser class
 */

class FormatParserClass
{
    /**
     * @var array Format parser objects
     */
    private static $formatParsers = [];

    /**
     * @var IFormatParserClass Selected parser
     */
    private static $selectedParser;

    /**
     * add Format parser to pool
     *
     * @param IFormatParserClass $formatParser Format parser class
     * @return void
     */
    public static function addFormatParserObject(IFormatParserClass $formatParser) {
        self::$formatParsers[$formatParser->getName()] = [
                                                            'formatName' => $formatParser->getFormatName(),
                                                            'parser' => $formatParser
                                                         ];
    }

    /**
     * Return Format parsers list
     *
     * @return array Format parsers list
     */
    public static function getFormatParsers() {
        return self::$formatParsers;
    }

    /**
      Method selects the best match (or force specified) data format and parse data
     *
     * @param string $data Input data
     * @return array Parsed data
     */
    public static function recognizeFormatAndParse($data) {

        $score = PHP_INT_MIN;
        $selectedParser = null;

        // iterate over all parsers
        foreach (self::$formatParsers as $parser) {
            // call scoring
            $currentScore = $parser['parser']->formatMatchProbability($data);

            if ($currentScore > $score) {
                $score = $currentScore;
                $selectedParser = $parser['parser'];
            }
        }

        return $selectedParser->parseData($data);
    }
}