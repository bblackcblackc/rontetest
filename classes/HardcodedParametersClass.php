<?php
/**
 * Hardcoded parameters class.
 *
 * It returns hardcoded parameters from class constant.
 *
 */

class HardcodedParametersClass implements IControlParametersClass
{
    use ModuleTrait;

    /**
     * Module name
     */
    const MODULENAME = 'Hardcoded control parameters extractor';

    /**
     * Hardcoded parameters
     */
    const PARAMETERS = [
            [ 'param1' => 'value1' ],
            [ 'showLogo' => 'false' ]
        ];

    /**
     * @inheritdoc
     */
    public function fetchParameters()
    {
        return self::PARAMETERS;
    }
}