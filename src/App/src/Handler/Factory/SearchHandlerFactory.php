<?php

namespace App\Handler\Factory;

use App\Handler\PokedexHandler;
use App\Handler\PokemonHandler;
use App\Handler\SearchHandler;
use Database\Pokedex\Repository\PokedexRepository;
use Mezzio\Twig\TwigRenderer;
use Psr\Container\ContainerInterface;

class SearchHandlerFactory
{
    public function __invoke(ContainerInterface $container): SearchHandler
    {
        return new SearchHandler(
            $container->get(TwigRenderer::class),
            $container->get(PokedexRepository::class)
        );
    }
}
