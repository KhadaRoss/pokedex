<?php

namespace Database\Pokedex\Repository\Factory;

use Database\Pokedex\Database\PokedexDatabase;
use Database\Pokedex\Repository\PokedexRepository;
use Psr\Container\ContainerInterface;

class PokedexRepositoryFactory
{
    public function __invoke(ContainerInterface $container): PokedexRepository
    {
        return new PokedexRepository(
            $container->get(PokedexDatabase::class)
        );
    }
}
