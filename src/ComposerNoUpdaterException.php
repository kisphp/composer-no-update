<?php

namespace Kisphp;

class ComposerNoUpdaterException extends \Exception
{
    protected $message = 'You should not run "composer update" without any arguments. If you know what you\'re doing, prepend COMPOSER_ENV=dev to composer command.';
}
