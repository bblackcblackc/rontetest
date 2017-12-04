<?php
/**
 * Hardcoded data Fetcher
 */

class HardcodedFetcherClass implements IDataFetcherClass
{
    use ModuleTrait;

    /**
     * Module name
     */
    const MODULENAME = 'Hardcoded data source';

    /**
     * Hardcoded data
     */
    //const DATA = 'Хостел «Три таракана»,http://h3t.ru,1' . PHP_EOL;
    const DATA = ',http://h3t.ru,1' . PHP_EOL;

    /**
     * @inheritdoc
     */
    public function __construct(string $dataSourceName) {
    }

    /**
     * @inheritdoc
     */
    public function readData()
    {
        return self::DATA;
    }
}