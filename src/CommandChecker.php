<?php

namespace Kisphp;

use Symfony\Component\Console\Input\InputInterface;

class CommandChecker
{
    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @param InputInterface $input
     *
     * @return $this
     */
    public function setInput(InputInterface $input)
    {
        $this->input = $input;

        return $this;
    }

    /**
     * @throws ComposerNoUpdaterException
     *
     * @return null
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

        if ( ! $this->input->getOption('dry-run')
            && $arguments['command'] === 'update'
            && count($arguments['packages']) === 0
        ) {
            return true;
        }

        return false;
    }
}
