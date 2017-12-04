<?php
/**
 * File Fetcher
 */

class FileFetcherClass implements IDataFetcherClass
{
    use ModuleTrait;

    /**
     * Module name
     */
    const MODULENAME = 'File data source';

    /**
     * @var $dataSourceName Data source name (filename)
     */
    private $dataSourceName;

    /**
     * @inheritdoc
     */
    public function __construct(string $dataSourceName) {
        $this->dataSourceName = $dataSourceName;
    }

    /**
     * @inheritdoc
     */
    public function readData()
    {
        return file_get_contents($this->dataSourceName);
    }
}