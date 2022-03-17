<?php

namespace Database\Pokedex\Model;

class Pokemon
{
    private int $id;
    private string $name;
    private string $description;
    /**
     * @var VFaehigkeit[]
     */
    private array $vFaehigkeiten = [];
    /**
     * @var Faehigkeit[]
     */
    private array $faehigkeiten = [];
    /**
     * @var Gender[]
     */
    private array $gender = [];
    /**
     * @var Type[]
     */
    private array $types = [];
    /**
     * @var Area[]
     */
    private array $areas = [];

    public function __construct(
        int $id,
        string $name,
        string $description
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getVFaehigkeiten(): array
    {
        return $this->vFaehigkeiten;
    }

    public function getFaehigkeiten(): array
    {
        return $this->faehigkeiten;
    }

    public function getGender(): array
    {
        return $this->gender;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

    public function getAreas(): array
    {
        return $this->areas;
    }

    public function addVFaehigkeit(VFaehigkeit $vFaehigkeit, int $index): void
    {
        $this->vFaehigkeiten[$index] = $vFaehigkeit;
    }

    public function addFaehigkeit(Faehigkeit $faehigkeit, int $index): void
    {
        $this->faehigkeiten[$index] = $faehigkeit;
    }

    public function addGender(Gender $gender, int $index): void
    {
        $this->gender[$index] = $gender;
    }

    public function addType(Type $type, int $index): void
    {
        $this->types[$index] = $type;
    }

    public function addArea(Area $area, int $index): void
    {
        $this->area[$index] = $area;
    }
}

