<?php
/**
 * Class for processing control parameters
 *
 * Every parameter action is a method named as 'action<Action>'
 */

class ControlParametersProcessorClass
{

    /**
     * ControlParametersProcessorClass constructor.
     * @param array[] $controlParameters
     */
    public function __construct(array $controlParameters) {

        // iterate all parameters
        foreach ($controlParameters as $parameter) {
            foreach ($parameter as $pName => $pValue) {

                // check if we have processing method for this parameter
                $methodName = 'action' . ucwords($pName);
                if (method_exists($this, $methodName)) {
                    $this->$methodName($pValue);
                }
            }
        }
    }

    /**
     * @param string $param Input file
     * @method Method for processing '-inputFile' option. Syntax: '-inputFile=<filename>'
     */
    public function actionInputFile($param) {
        DataFetcherClass::addDataFetcherObject(new FileFetcherClass($param));
    }

    /**
     * @param string $param Not matters
     * @method Method for processing '-HCData' option. Syntax: '-HCData'
     */
    public function actionUseHardcodedData($param) {
        DataFetcherClass::addDataFetcherObject(new HardcodedFetcherClass($param));
    }

    /**
     * @param string $param Not matters
     * @method Method for processing '-listFormats' option. Syntax: '-listFormats'
     *
     * !!! This method will terminate the program after format listing
     */
    public function actionListFormats($param) {
        $classList = get_declared_classes();
        $formatNames = [];

        // go over all classes
        foreach ($classList as $className) {
            // create list of Format parser classes
            if (preg_match(FORMAT_MODULE_CLASS_NAME_REGEX,$className) &&
                method_exists($className, FORMAT_MODULE_NAME_METHOD)) {

                // if class name match and method exists
                $formatNames[] = $className::{FORMAT_MODULE_NAME_METHOD}();
            }
        }

        print('Available formats: ' . implode(', ',$formatNames) . PHP_EOL);
        exit(0);
    }

    /**
     * @param string $param Force parser name
     * @throws Exception
     * @return void
     */
    public function actionForceFormat($param)
    {

        // check if we have such parser
        try {
            if (class_exists($param . FORMAT_CLASS_NAME_POSTFIX, false) &&
                method_exists($param . FORMAT_CLASS_NAME_POSTFIX, FORMAT_MODULE_NAME_METHOD)) {

                // all ok, parser exists
                // clear all parsers stack and add expected
                FormatParserClass::clearFormatParsers();
                $className = $param . FORMAT_CLASS_NAME_POSTFIX;
                FormatParserClass::addFormatParserObject(new $className());
            } else {
                throw new RSExceptionClass('No such parser - ' . $param);
            }
        } catch (RSExceptionClass $e) {
            RSExceptionClass::log($e->getMessage());
            exit(1);
        }
    }
}