<?php
/**
 * Command Line parameters extractor
 *
 * Process command line parameters as pair of strings, delimited with '=' where key begins with '-'
 *
 * example:
 *      -key1=value1 -key2=value2
 */

class CmdStrControlParametersClass implements IControlParametersClass
{
    use ModuleTrait;

    /**
     * Module name
     */
    const MODULENAME = 'Command Line control parameters extractor';

    /**
     * @inheritdoc
     */
    public function fetchParameters()
    {
        $aArgs = [];
        foreach ($_SERVER['argv'] as $sArgument) {

            // copy arguments beginning with '-' to result array
            if (strpos($sArgument, '-') === 0) {

                // process argument pair without leading '-'
                $parsedArgs = explode('=', substr($sArgument,1),2);
                $aArgs[] = [ $parsedArgs[0] => $parsedArgs[1] ?? '' ];
            }
        }
        return $aArgs;
    }
}