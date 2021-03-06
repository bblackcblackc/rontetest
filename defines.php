<?php
/**
 * This file contains definitions
 */

define('FORMAT_MODULE_NAME_METHOD','getFormatName');
define('FORMAT_CLASS_NAME_POSTFIX','FormatParserClass');
define('FORMAT_MODULE_CLASS_NAME_REGEX','/^(.+)' . FORMAT_CLASS_NAME_POSTFIX . '/');

define('DATAPROCESS_MODULE_PROCESS_METHOD','processData');
define('DATAPROCESS_CLASS_NAME_POSTFIX','DataProcessorClass');
define('DATAPROCESS_MODULE_CLASS_NAME_REGEX','/^(.+)' . DATAPROCESS_CLASS_NAME_POSTFIX . '/');

define('CLASSPATH','classes');

define('VALIDATOR_METHOD_PREFIX', 'Validate');
define('VALIDATOR_REQUIRED_ATTR','required');

define('SORT_ASC_ORDER',0);
define('SORT_DESC_ORDER',1);