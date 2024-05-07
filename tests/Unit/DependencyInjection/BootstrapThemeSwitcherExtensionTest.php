<?php

declare(strict_types=1);

namespace NeuralGlitch\BootstrapThemeSwitch\Tests\DependencyInjection;

use NeuralGlitch\BootstrapThemeSwitch\BootstrapThemeSwitchBundle;
use NeuralGlitch\BootstrapThemeSwitch\DependencyInjection\BootstrapThemeSwitchExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class BootstrapThemeSwitchExtensionTest extends TestCase
{
    private $container;
    private $extension;

    protected function setUp(): void
    {
        $this->container = $this->createMock(ContainerBuilder::class);
        $this->extension = new BootstrapThemeSwitchExtension();
    }

    public function testGetAlias(): void
    {
        $this->assertEquals(BootstrapThemeSwitchBundle::ALIAS, $this->extension->getAlias());
    }

    public function testPrepend(): void
    {
        $this->markTestSkipped();
        $fileLocator = $this->createMock(FileLocator::class);
        $yamlFileLoader = $this->getMockBuilder(YamlFileLoader::class)
            ->setConstructorArgs([$this->container, $fileLocator])
            ->onlyMethods(['load'])
            ->getMock();

        $yamlFileLoader->method('load')->willReturn(['some_key' => 'some_value']);
        $yamlFileLoader->expects($this->exactly(2))->method('load');

        $this->extension->prepend($this->container);
    }
}