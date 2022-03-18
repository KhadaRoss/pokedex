<?php

namespace App\Handler;

use Database\Pokedex\Repository\PokedexRepository;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Twig\TwigRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PokemonHandler implements RequestHandlerInterface
{
    private TwigRenderer $twigRenderer;
    private PokedexRepository $pokedexRepository;

    public function __construct(
        TwigRenderer $twigRenderer,
        PokedexRepository $pokedexRepository
    )
    {
        $this->twigRenderer = $twigRenderer;
        $this->pokedexRepository = $pokedexRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = [];

        $pokemon = $this->pokedexRepository->findById(
            (int) $request->getAttribute('id')
        );

        $params['pokemon'] = $pokemon;
        $params['title'] = $pokemon === null ? '404' : $pokemon->getName();

        return new HtmlResponse(
            $this->twigRenderer->render(
                'app::pokemon',
                $params
            )
        );
    }
}
