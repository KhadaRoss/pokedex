<?php

declare(strict_types=1);

namespace Database;

use Laminas\ServiceManager\Factory\InvokableFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'invokables' => [
            ],
            'factories' => [
                Pokedex\Repository\PokedexRepository::class => Pokedex\Repository\Factory\PokedexRepositoryFactory::class,
                Pokedex\Database\PokedexDatabase::class => InvokableFactory::class,
            ],
        ];
    }
}
