<?php
/**
 * Data fetch interface class
 */

interface IDataFetcherClass extends IModuleClass
{

    /**
     * IDataFetcherClass constructor.
     * @param string $dataSourceName
     */
    public function __construct(string $dataSourceName);

    /**
     * @method read from data source until EOF
     * @return string Data
     */
    public function readData();
}