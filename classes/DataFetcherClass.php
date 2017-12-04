<?php
/**
 * Data fetcher collector class
 *
 * Aggregates all data collectors
 */

class DataFetcherClass
{
    /**
     * @var array of DataFetchers objects
     */
    private static $dataFetchersObjects = [];

    /**
     * Adds a DataFetcher object to pool
     *
     * @param IDataFetcherClass data fetcher object
     * @return void
     */
    public static function addDataFetcherObject(IDataFetcherClass $dataFetcherObject) {
        self::$dataFetchersObjects[$dataFetcherObject->getName()] = $dataFetcherObject;
    }

    /**
     * Returns data from all data sources
     *
     * @return string Fetched data
     */
    public static function getAllData() {
        $retData = '';

        // Iterate over all data fetchers and fetch data
        foreach (self::$dataFetchersObjects as $fetchObject) {
            $retData .= $fetchObject->readData();
        }

        return $retData;
    }
}