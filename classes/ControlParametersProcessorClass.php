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

        // load all data formats
        $classFiles = glob(CLASSPATH . '/*' . FORMAT_CLASS_NAME_POSTFIX . '*');
        foreach ($classFiles as $classFile)
            require_once $classFile;

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
            if (class_exists($param . FORMAT_CLASS_NAME_POSTFIX, true) &&
                method_exists($param . FORMAT_CLASS_NAME_POSTFIX, FORMAT_MODULE_NAME_METHOD)) {

                // all ok, parser exists
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

    /**
     * @param string $param Not matters
     * @method Method for processing '-listProcessors' option. Syntax: '-listProcessors'
     *
     * !!! This method will terminate the program after format listing
     */
    public function actionListProcessors($param) {

        // load all data processors
        $classFiles = glob(CLASSPATH . '/*' . DATAPROCESS_CLASS_NAME_POSTFIX . '*');
        foreach ($classFiles as $classFile)
            require_once $classFile;

        $classList = get_declared_classes();
        $dataProcessors = [];
        $dataProcClassMatches = [];

        // go over all classes
        foreach ($classList as $className) {
            // create list of Format parser classes
            if (preg_match(DATAPROCESS_MODULE_CLASS_NAME_REGEX,$className,$dataProcClassMatches) &&
                method_exists($className, DATAPROCESS_MODULE_PROCESS_METHOD)) {

                $dataProcessors[] = $dataProcClassMatches[1];
            }
        }

        print('Available processors: ' . implode(', ',$dataProcessors) . PHP_EOL);
        exit(0);
    }

    /**
     * @param string $param Specifies data processors and parameters
     * @throws Exception
     * @return void
     * @method Method for processing '-processData' parameter
     *
     * Example:
     * <exe> -processData=RandomChar='{ "fields": [ "name", "url" ] }'
     * <exe> -processData=Sort='{ "fields": { "name": 0, "url": 1 } }'
     *
     * for sorting 0 means asc, 1 means desc
     * parameter can be specified multiple times
     */
    public function actionProcessData($param)
    {

        if (empty($param)) {
            return;
        }

        // parse parameter
        $parsedParam = explode('=',$param);
        $processorName = $parsedParam[0];
        $processorParams = (array) json_decode($parsedParam[1]);

        // check if we have such parser
        try {
            if (class_exists($processorName . DATAPROCESS_CLASS_NAME_POSTFIX, true) &&
                method_exists($processorName . DATAPROCESS_CLASS_NAME_POSTFIX, DATAPROCESS_MODULE_PROCESS_METHOD)) {

                // all ok, processor exists
                $className = $processorName . DATAPROCESS_CLASS_NAME_POSTFIX;
                DataProcessorClass::addDataProcessor(new $className($processorParams));

            } else {
                throw new RSExceptionClass('No such processor - ' . $param);
            }
        } catch (RSExceptionClass $e) {
            RSExceptionClass::log($e->getMessage());
            exit(1);
        }
    }
}