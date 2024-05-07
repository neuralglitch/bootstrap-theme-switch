<?php

declare(strict_types=1);

namespace NeuralGlitch\BootstrapThemeSwitch\Controller;

use NeuralGlitch\BootstrapThemeSwitch\Service\ThemeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SwitchController extends AbstractController
{
    public function __invoke(Request $request, ThemeService $themeService): Response
    {
        $parameters = json_decode($request->getContent(), true);

        $theme = $parameters['theme'];
        $isSystemTheme = $parameters['isSystemTheme'];

        $result = $themeService->setTheme($theme, $isSystemTheme);

        $mode = sprintf('"%s mode"%s',
            $theme,
            (($isSystemTheme === '1') ? ' (system default)' : '')
        );

        if ($result) {
            $response = sprintf('BootstrapThemeSwitch: Successfully set %s.', $mode);
        } else {
            $response = sprintf('BootstrapThemeSwitch: Failed to set %s.', $mode);
        }
        return new Response($response);
    }
}
