<?php

declare(strict_types=1);

return [
    'dependencies' => [
        'aliases' => [
            \Mezzio\Template\TemplateRendererInterface::class => \Mezzio\Twig\TwigRenderer::class,
        ],
        'invokables' => [
        ],
        'factories' => [
        ],
    ],
];
