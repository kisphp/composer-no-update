<?php

namespace Kisphp;

class ComposerNoUpdaterException extends \Exception
{
    protected $message = 'Do not run "composer update" without arguments';
}
