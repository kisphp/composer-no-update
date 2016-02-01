<?php

namespace Kisphp;

use Symfony\Component\Console\Input\InputInterface;

class CommandChecker
{
    const COMPOSER_UPDATE_FORCE = 'COMPOSER_UPDATE_FORCE';
    const COMPOSER_UPDATE_FORDE_VALUE = 1;

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
        if (isset($_SERVER[self::COMPOSER_UPDATE_FORCE]) && $_SERVER[self::COMPOSER_UPDATE_FORCE] === self::COMPOSER_UPDATE_FORDE_VALUE) {
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
