<?php
/**
 * Read & Sort Class
 *
 * Main class
 */

abstract class ReaderSorter
{

    abstract public function fetchControlWords();
    abstract public function readInputData();
    abstract public function writeOutputData();
}