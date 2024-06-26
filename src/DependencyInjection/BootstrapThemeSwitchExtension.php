<?php

declare(strict_types=1);

namespace NeuralGlitch\BootstrapThemeSwitch\DependencyInjection;

use NeuralGlitch\BootstrapThemeSwitch\BootstrapThemeSwitchBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class BootstrapThemeSwitchExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        // do nothing
    }

    public function getAlias(): string
    {
        return BootstrapThemeSwitchBundle::ALIAS;
    }

    public function prepend(ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('services.yaml');

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config/packages'));
        $loader->load('twig.yaml');
    }
}
