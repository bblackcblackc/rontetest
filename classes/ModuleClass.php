<?php
/**
 * Module class -- base class for all modules
 */

class ModuleClass implements IModuleClass
{
    /**
     * @return string module name defined as const at every module
     */
    public function getName() {
        return self::MODULENAME;
    }
}