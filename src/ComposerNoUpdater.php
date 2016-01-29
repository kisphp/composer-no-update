<?php

namespace Kisphp;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\CommandEvent;
use Composer\Plugin\PluginEvents;
use Composer\Plugin\PluginInterface;

class ComposerNoUpdater implements PluginInterface, EventSubscriberInterface
{
    /**
     * @var Composer
     */
    protected $composer;

    /**
     * @var IOInterface
     */
    protected $io;

    /**
     * @var CommandChecker
     */
    protected $commandChecker;

    /**
     * @param Composer $composer
     * @param IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
        $this->commandChecker = new CommandChecker();
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            PluginEvents::COMMAND => [
                ['checkUpdateCommand'],
            ],
        ];
    }

    /**
     * @param CommandEvent $commandEvent
     *
     * @throws ComposerNoUpdaterException
     */
    public function checkUpdateCommand(CommandEvent $commandEvent)
    {
        $this->commandChecker->validate($commandEvent);
    }

}
