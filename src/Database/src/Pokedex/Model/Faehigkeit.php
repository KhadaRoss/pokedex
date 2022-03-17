<?php

namespace Database\Pokedex\Model;

class Faehigkeit
{
    private string $name;
    private string $description;

    public function __construct(
        string $name,
        string $description
    ) {
        $this->name = $name;
        $this->description = $description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
