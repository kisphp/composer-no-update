<?php

namespace Kisphp;

use Symfony\Component\Console\Input\ArgvInput;

class CommandChecker
{
    /**
     * @var ArgvInput
     */
    protected $input;

    /**
     * @param ArgvInput $input
     *
     * @return $this
     */
    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     * @throws ComposerNoUpdaterException
     *
     * @return void
     */
    public function validate()
    {
        if ($this->isDevEnvironment() === true) {
            return;
        }

        if ($this->isUpdateWithoutArguments() === true) {
            throw new ComposerNoUpdaterException();
        }
    }

    /**
     * @return bool
     */
    protected function isDevEnvironment()
    {
        if (isset($_SERVER['COMPOSER_ENV']) && $_SERVER['COMPOSER_ENV'] === 'dev') {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    protected function isUpdateWithoutArguments()
    {
        $arguments = $this->input->getArguments();

        if ( ! $this->input->getOption('dry-run'
            && count($arguments['packages']) === 0
            && $arguments['command'] === 'update')
        ) {
            return true;
        }

        return false;
    }
}
