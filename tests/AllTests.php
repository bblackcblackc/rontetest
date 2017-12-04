<?php
/**
 * Global testing class
 */


require_once 'DataValidatorClassTest.php';
require_once 'RandomCharDataProcessorClassTest.php';

class AllTests extends PHPUnit\Framework\TestSuite
{
    public static function suite() {
        // init suite
        $suite = new PHPUnit\Framework\TestSuite('AllTestsSuite');

        // add tests
        $suite->addTestSuite('DataValidatorClassTest');
        $suite->addTestSuite('RandomCharDataProcessorClassTest');

        return $suite;
    }
}