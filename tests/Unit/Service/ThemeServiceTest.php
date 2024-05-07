<?php

namespace NeuralGlitch\BootstrapThemeSwitch\Tests\Service;

use PHPUnit\Framework\TestCase;
use NeuralGlitch\BootstrapThemeSwitch\Service\ThemeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ThemeServiceTest extends TestCase
{
    public function testSetTheme()
    {
        // Mock RequestStack and Request
        $requestStack = $this->createMock(RequestStack::class);
        $request = $this->createMock(Request::class);
        $session = $this->createMock(SessionInterface::class);

        $requestStack->expects($this->once())
            ->method('getCurrentRequest')
            ->willReturn($request);

        $request->expects($this->once())
            ->method('getSession')
            ->willReturn($session);

        // Test data
        $theme = 'dark';
        $isSystemTheme = '1';

        // Mock SessionInterface methods
        $session->expects($this->exactly(2))
            ->method('set')
            ->withConsecutive(
                ['_theme', $theme],
                ['_is_system_theme', $isSystemTheme]
            );

        // Instantiate the ThemeService with mocked dependencies
        $themeService = new ThemeService($requestStack);

        // Test setTheme method
        $this->assertTrue($themeService->setTheme($theme, $isSystemTheme));
    }

    public function testSetThemeWithInvalidInputs()
    {
        // Mock RequestStack and Request
        $requestStack = $this->createMock(RequestStack::class);

        // Instantiate the ThemeService with mocked dependencies
        $themeService = new ThemeService($requestStack);

        // Test invalid theme and isSystemTheme
        $this->assertFalse($themeService->setTheme('invalid', '1'));
        $this->assertFalse($themeService->setTheme('dark', 'invalid'));
    }
}