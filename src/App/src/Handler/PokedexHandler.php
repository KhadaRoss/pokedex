<?php

namespace App\Handler;

use Database\Pokedex\Repository\PokedexRepository;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Twig\TwigRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PokedexHandler implements RequestHandlerInterface
{
    private TwigRenderer $twigRenderer;
    private PokedexRepository $pokedexRepository;

    public function __construct(
        TwigRenderer $twigRenderer,
        PokedexRepository $pokedexRepository
    ) {
        $this->twigRenderer = $twigRenderer;
        $this->pokedexRepository = $pokedexRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = [];

        $params['pokemonModels'] = $this->pokedexRepository->findAll();
        $params['h1'] = 'Pokedex';
        $params['types'] = $this->pokedexRepository->getAllTypes();
        $params['search_types'] = $searchParams['type'] ?? [];

        return new HtmlResponse(
            $this->twigRenderer->render(
                'app::pokedex',
                $params
            )
        );
    }
}
