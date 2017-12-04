<?php
/**
 * Control parameters interface
 */

interface IControlParametersClass extends IModuleClass
{
    /**
     * @method returns control parameters in array as 'key' => 'value'
     * @return string[]
     */
    public function fetchParameters();

}