<?php

namespace App\Handler\Factory;

use App\Handler\PokedexHandler;
use App\Handler\PokemonHandler;
use Database\Pokedex\Repository\PokedexRepository;
use Mezzio\Twig\TwigRenderer;
use Psr\Container\ContainerInterface;

class PokemonHandlerFactory
{
    public function __invoke(ContainerInterface $container): PokemonHandler
    {
        return new PokemonHandler(
            $container->get(TwigRenderer::class),
            $container->get(PokedexRepository::class)
        );
    }
}
