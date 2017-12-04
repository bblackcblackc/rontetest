<?php
/**
 * Exception class for Reader/Sorter
 */

class RSExceptionClass extends Exception
{

    /**
     * RSExceptionClass constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function log($message = "") {
        print(date('d.m.Y H:i:s') . ' | ' . $message .  PHP_EOL);
    }
}