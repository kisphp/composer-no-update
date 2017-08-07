<?php


class CommandCheckerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Kisphp\CommandChecker
     */
    protected $commandChecker;

    public function setUp()
    {
        $this->commandChecker = new \Kisphp\CommandChecker();
    }

    /**
     * @expectedException Kisphp\ComposerNoUpdaterException
     */
    public function test_exception()
    {
        $input = $this->createMock('Symfony\Component\Console\Input\InputInterface');

        $input
            ->expects($this->any())
            ->method('getArguments')
            ->will(
                $this->returnValue([
                    'command' => 'update',
                    'packages' => [],
                ])
            )
        ;

        $this->commandChecker->setInput($input);
        $this->commandChecker->validate();
    }

    public function test_install()
    {
        $input = $this->createMock('Symfony\Component\Console\Input\InputInterface');

        $input
            ->expects($this->any())
            ->method('getArguments')
            ->will(
                $this->returnValue([
                    'command' => 'install',
                    'packages' => [],
                ])
            )
        ;

        $this->commandChecker->setInput($input);

        $this->assertTrue($this->commandChecker->validate());
    }

    public function test_devEnvironment()
    {
        $input = $this->createMock('Symfony\Component\Console\Input\InputInterface');
        $_SERVER[\Kisphp\CommandChecker::COMPOSER_UPDATE_FORCE] = \Kisphp\CommandChecker::COMPOSER_UPDATE_FORDE_VALUE;

        $input
            ->expects($this->any())
            ->method('getArguments')
            ->will(
                $this->returnValue([
                    'command' => 'update',
                    'packages' => [],
                ])
            )
        ;

        $this->commandChecker->setInput($input);

        $this->assertTrue($this->commandChecker->validate());
    }
}
