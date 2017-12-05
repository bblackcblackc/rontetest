<?php
/**
 * Main executable
 */

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

require_once 'defines.php';

print('Started.' . PHP_EOL);

// control parameters modules load
ControlParametersClass::addControlParametersObject(new CmdStrControlParametersClass());
ControlParametersClass::addControlParametersObject(new HardcodedParametersClass());

// parameters processor
new ControlParametersProcessorClass(ControlParametersClass::getParams());

// check if parsers loaded
if (empty(FormatParserClass::getFormatParsers())) {
    // load parsers
    FormatParserClass::addFormatParserObject(new NullFormatParserClass());
    FormatParserClass::addFormatParserObject(new CSV3FormatParserClass());
}

// Data fetchers
$inputData = DataFetcherClass::getAllData();
$parsedData = FormatParserClass::recognizeFormatAndParse($inputData);

// Data validation
$dataRules = [
    'name'  => [ 'string', [ 'required' => true ] ],
    'url'   => [ 'url', [ 'required' => true ] ],
    'stars' => [ 'int', [ 'required' => true , 'range' => [ 'min' => 1, 'max' => 5 ] ] ]
];

$validData = DataValidatorClass::validateData($parsedData, $dataRules);

// Data processing
$processedData = DataProcessorClass::getProcessedData($validData);

print_r($processedData);

exit(0);