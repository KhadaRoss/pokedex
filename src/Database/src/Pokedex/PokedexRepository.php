<?php

namespace Database\Pokedex;

class PokedexRepository
{
    private PokedexDatabase $pokedexDatabase;

    public function __construct(
        PokedexDatabase $pokedexDatabase
    ) {
        $this->pokedexDatabase = $pokedexDatabase;
    }
}
