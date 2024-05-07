<?php

declare(strict_types=1);

namespace NeuralGlitch\BootstrapThemeSwitch;

use NeuralGlitch\BootstrapThemeSwitch\DependencyInjection\Compiler\BootstrapThemeSwitchPass;
use NeuralGlitch\BootstrapThemeSwitch\DependencyInjection\BootstrapThemeSwitchExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BootstrapThemeSwitchBundle extends Bundle
{
    public const ALIAS = 'bs_theme_switch';

    public function getContainerExtension(): ExtensionInterface
    {
        return $this->extension ??= new BootstrapThemeSwitchExtension();
    }
}
