<?php

namespace IziDev\Services\ElevatorService;

final class Elevator
{
    private int $position = 0;
    private bool $available = true;
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function incrementPosition()
    {
        $this->position = $this->position + 1;
    }

    public function decrementPosition()
    {
        $this->position = $this->position - 1;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function hasAvailable(bool $available): void
    {
        $this->available = $available;
    }

    public function getName(): string
    {
        return $this->name;
    }
}