<?php

namespace Kisphp;

class NoUpdaterException extends \Exception
{
    protected $message = 'Do not run "composer update" without arguments';
}
