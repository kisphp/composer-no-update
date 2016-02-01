<?php

namespace Kisphp;

class ComposerNoUpdaterException extends \Exception
{
    /**
     * @param string $message
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        if (empty($message)) {
            $message = $this->getDefaultMessage();
        }
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    protected function getDefaultMessage()
    {
        return "!!! You should not run \"composer update\" without any arguments. !!!\nIf you know what you're doing, prepend "
            . CommandChecker::COMPOSER_UPDATE_FORCE . '=' . CommandChecker::COMPOSER_UPDATE_FORDE_VALUE
            . " to composer command.\n";
    }
}
