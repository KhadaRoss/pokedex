<?php

namespace App\Handler;

use Database\Pokedex\Repository\PokedexRepository;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Twig\TwigRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SearchHandler implements RequestHandlerInterface
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
        $searchParams = $request->getQueryParams();

        $params = [];
        $params['pokemonModels'] = $this->pokedexRepository->findAllBy($searchParams);
        $params['h1'] = 'Pokedex - Suche';
        $params['search_name_value'] = $searchParams['name'] ?? '';
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
