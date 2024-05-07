<?php

declare(strict_types=1);

namespace Tests\Unit\Controller;

use PHPUnit\Framework\TestCase;
use NeuralGlitch\BootstrapThemeSwitch\Controller\SwitchController;
use NeuralGlitch\BootstrapThemeSwitch\Service\ThemeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SwitchControllerTest extends TestCase
{
    public function testInvoke(): void
    {
        $request = $this->createMock(Request::class);
        $themeService = $this->createMock(ThemeService::class);

        $parameters = [
            'theme' => 'dark',
            'isSystemTheme' => '1',
        ];

        $request->expects($this->once())
            ->method('getContent')
            ->willReturn(json_encode($parameters));

        $themeService->expects($this->once())
            ->method('setTheme')
            ->with('dark', '1')
            ->willReturn(true);

        $response = (new SwitchController())($request, $themeService);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('BootstrapThemeSwitch: Successfully set "dark mode" (system default).', $response->getContent());
    }

    public function testInvokeFailure(): void
    {
        $request = $this->createMock(Request::class);
        $themeService = $this->createMock(ThemeService::class);

        $parameters = [
            'theme' => 'light',
            'isSystemTheme' => '0',
        ];

        $request->expects($this->once())
            ->method('getContent')
            ->willReturn(json_encode($parameters));

        $themeService->expects($this->once())
            ->method('setTheme')
            ->with('light', '0')
            ->willReturn(false);

        $response = (new SwitchController())($request, $themeService);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('BootstrapThemeSwitch: Failed to set "light mode".', $response->getContent());
    }
}