<?php

namespace Database\Pokedex;

use PDO;

class PokedexDatabase extends PDO
{
    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=pokedex';
        $username = 'root';
        $password = 'password';

        parent::__construct($dsn, $username, $password);
    }
}
