<?php

declare(strict_types=1);

namespace App;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                \App\Handler\PokedexHandler::class => \App\Handler\Factory\PokedexHandlerFactory::class,
                \App\Handler\PokemonHandler::class => \App\Handler\Factory\PokemonHandlerFactory::class,
            ],
        ];
    }

    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
