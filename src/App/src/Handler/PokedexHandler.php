<?php

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Twig\TwigRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PokedexHandler implements RequestHandlerInterface
{
    private TwigRenderer $twigRenderer;

    public function __construct(
        TwigRenderer $twigRenderer
    ) {
        $this->twigRenderer = $twigRenderer;
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
