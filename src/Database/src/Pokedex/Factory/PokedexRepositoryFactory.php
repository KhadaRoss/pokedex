<?php

namespace Database\Pokedex\Factory;

use Database\Pokedex\PokedexDatabase;
use Database\Pokedex\PokedexRepository;
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
