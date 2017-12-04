<?php
/**
 * Module name trait
 */

trait ModuleTrait
{
    /**
     * @return string module name defined as const at every module
     */
    public function getName() {
        return self::MODULENAME;
    }
}