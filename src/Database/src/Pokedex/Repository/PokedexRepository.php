<?php

namespace Database\Pokedex\Repository;

use Database\Pokedex\Database\PokedexDatabase;
use Database\Pokedex\Model\Area;
use Database\Pokedex\Model\Faehigkeit;
use Database\Pokedex\Model\Gender;
use Database\Pokedex\Model\Pokemon;
use Database\Pokedex\Model\Type;
use Database\Pokedex\Model\VFaehigkeit;

class PokedexRepository
{
    /**
     * @var array<int, Pokemon[]>
     */
    private array $pokemon = [];
    private PokedexDatabase $pokedexDatabase;

    public function __construct(
        PokedexDatabase $pokedexDatabase
    ) {
        $this->pokedexDatabase = $pokedexDatabase;
    }

    private function initPokemon(): void
    {
        if (count($this->pokemon) > 0) {
            return;
        }

        $query = <<<SQL
SELECT
    pokemon.Name as name,
    pokemon.DexID as id,
    pokemon.Beschreibung as description,

    v.VFID as vFaehigkeitId,
    v.Name as vFaehigkeitName,
    v.Beschreibung as vFaehigkeitDescription,

    g.GeschID as genderId,
    g.Name as gender,

    t.TypID as typeId,
    t.Name as type,

    f.FID as faehigkeitId,
    f.Name as faehigkeitName,
    f.Beschreibung as faehigkeitDescription,

    a.AreaID as areaId,
    a.Name as areaName
FROM pokemon
    LEFT JOIN vfaehigkeiten v ON pokemon.VFID = v.VFID
    LEFT JOIN pgeschlecht p ON pokemon.DexID = p.DexID
    LEFT JOIN geschlecht g ON p.GeschID = g.GeschID
    LEFT JOIN ptyp p2 ON pokemon.DexID = p2.DexID
    LEFT JOIN typen t ON p2.TypID = t.TypID
    LEFT JOIN pfaehigkeiten p3 ON pokemon.DexID = p3.DexID
    LEFT JOIN faehigkeiten f ON p3.FID = f.FID
    LEFT JOIN fundort f2 ON pokemon.DexID = f2.DexID
    LEFT JOIN area a ON f2.AreaID = a.AreaID
SQL;

        foreach ($this->pokedexDatabase->query($query) as $row) {
            $pokemonId = (int)$row['id'];

            if (!isset($this->pokemon[$pokemonId])) {
                $this->pokemon[$pokemonId] = new Pokemon(
                    $pokemonId,
                    $row['name'],
                    $row['description'],
                );
            }

            if ($row['vFaehigkeitName'] !== null && $row['vFaehigkeitDescription'] !== null) {
                $this->pokemon[$pokemonId]->addVFaehigkeit(
                    new VFaehigkeit(
                        $row['vFaehigkeitName'],
                        $row['vFaehigkeitDescription']
                    ),
                    (int)$row['vFaehigkeitId']
                );
            }

            $this->pokemon[$pokemonId]->addFaehigkeit(
                new Faehigkeit(
                    $row['faehigkeitName'],
                    $row['faehigkeitDescription']
                ),
                (int)$row['faehigkeitId']
            );

            $this->pokemon[$pokemonId]->addGender(
                new Gender(
                    $row['gender'],
                ),
                (int)$row['genderId']
            );

            $this->pokemon[$pokemonId]->addType(
                new Type(
                    $row['type'],
                ),
                (int)$row['typeId']
            );

            if ($row['areaName'] !== null) {
                $this->pokemon[$pokemonId]->addArea(
                    new Area(
                        $row['areaName'],
                    ),
                    (int)$row['areaId']
                );
            }
        }
    }

    public function findById(int $id): ?Pokemon
    {
        $this->initPokemon();

        return $this->pokemon[$id] ?? null;
    }

    /**
     * @return Pokemon[]
     */
    public function findAll(): array
    {
        $this->initPokemon();

        return $this->pokemon;
    }
}
