<?php

namespace Database\Pokedex\Database;

use PDO;

class PokedexDatabase extends PDO
{
    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=pokedex';
        $username = 'root';
        $password = '';

        parent::__construct($dsn, $username, $password);
    }
}
