<?php

namespace App\Handler;

use Database\Pokedex\PokedexRepository;
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
        return new HtmlResponse(
            $this->twigRenderer->render(
                'app::pokedex',
                []
            )
        );
    }
}
