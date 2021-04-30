<?php

namespace Tests;

use Kisphp\ComposerNoUpdaterException;
use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
class CommandCheckerTest extends TestCase
{
    /**
     * @var \Kisphp\CommandChecker
     */
    protected $commandChecker;

    protected function setUp(): void
    {
        $this->commandChecker = new \Kisphp\CommandChecker();
    }

    public function testException()
    {
        $input = $this->createMock('Symfony\Component\Console\Input\InputInterface');

        $input
            ->expects($this->any())
            ->method('getArguments')
            ->willReturn(
                $this->returnValue([
                    'command' => 'update',
                    'packages' => [],
                ])
            )
        ;

        $this->expectException(ComposerNoUpdaterException::class);

        $this->commandChecker->setInput($input);
        $this->commandChecker->validate();
    }

    public function testInstall()
    {
        $input = $this->createMock('Symfony\Component\Console\Input\InputInterface');

        $input
            ->expects($this->any())
            ->method('getArguments')
            ->willReturn(
                $this->returnValue([
                    'command' => 'install',
                    'packages' => [],
                ])
            )
        ;

        $this->commandChecker->setInput($input);

        $this->assertTrue($this->commandChecker->validate());
    }

    public function testDevEnvironment()
    {
        $input = $this->createMock('Symfony\Component\Console\Input\InputInterface');
        $_SERVER[\Kisphp\CommandChecker::COMPOSER_UPDATE_FORCE] = \Kisphp\CommandChecker::COMPOSER_UPDATE_FORDE_VALUE;

        $input
            ->expects($this->any())
            ->method('getArguments')
            ->willReturn(
                [
                    'command' => 'update',
                    'packages' => [],
                ]
            )
        ;

        $this->commandChecker->setInput($input);

        $this->assertTrue($this->commandChecker->validate());
    }
}
