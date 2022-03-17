<?php

namespace App\Handler\Factory;

use App\Handler\PokedexHandler;
use Mezzio\Twig\TwigRenderer;
use Psr\Container\ContainerInterface;

class PokedexHandlerFactory
{
    public function __invoke(ContainerInterface $container): PokedexHandler
    {
        return new PokedexHandler(
            $container->get(TwigRenderer::class)
        );
    }
}
