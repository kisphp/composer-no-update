<?php

namespace Kisphp;

use Composer\Plugin\CommandEvent;
use Symfony\Component\Console\Input\ArgvInput;

class CommandChecker
{
    /**
     * @param CommandEvent $command
     *
     * @throws ComposerNoUpdaterException
     *
     * @return void
     */
    public function validate(CommandEvent $command)
    {
        /** @var ArgvInput $input */
        $input = $command->getInput();
        $arguments = $input->getArguments();

        if (isset($_SERVER['COMPOSER_ENV']) && $_SERVER['COMPOSER_ENV'] === 'dev') {
            return;
        }

        if ($arguments['command'] === 'update'
            && count($arguments['packages']) === 0
            && ! $input->getOption('dry-run')
        ) {
            throw new ComposerNoUpdaterException();
        }
    }
}
