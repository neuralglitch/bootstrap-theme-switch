<?php

namespace NeuralGlitch\BootstrapThemeSwitch\Service;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\RequestStack;

class ThemeService
{
    private const ALLOWED_THEMES = ['dark', 'light'];

    private const ALLOWED_SYSTEM = ['1', '0'];

    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function setTheme(string $theme, string $isSystemTheme): bool
    {
        if ($this->validate($theme,  $isSystemTheme)) {
            $request = $this->requestStack->getCurrentRequest();
            if ($request) {
                $session = $request->getSession();
                $session->set('_theme', $theme);
                $session->set('_is_system_theme', $isSystemTheme);
            }
            return true;
        } else {
            return false;
        }
    }

    private function validate(string $theme, string $isSystemTheme)
    {
        if (
            in_array($theme, self::ALLOWED_THEMES, true) &&
            in_array($isSystemTheme, self::ALLOWED_SYSTEM)
        ) {
            return true;
        }
        return false;
    }
}