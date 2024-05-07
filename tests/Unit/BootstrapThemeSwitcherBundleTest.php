<?php

declare(strict_types=1);

namespace NeuralGlitch\BootstrapThemeSwitch\Tests\Unit;

use PHPUnit\Framework\TestCase;
use NeuralGlitch\BootstrapThemeSwitch\BootstrapThemeSwitchBundle;
use NeuralGlitch\BootstrapThemeSwitch\DependencyInjection\BootstrapThemeSwitchExtension;
use NeuralGlitch\BootstrapThemeSwitch\DependencyInjection\Compiler\MakeBundlePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class BootstrapThemeSwitchBundleTest extends TestCase
{
    public function testContainerExtensionIsRegistered(): void
    {
        $bundle = new BootstrapThemeSwitchBundle();
        $extension = $bundle->getContainerExtension();

        $this->assertInstanceOf(BootstrapThemeSwitchExtension::class, $extension);
    }
}