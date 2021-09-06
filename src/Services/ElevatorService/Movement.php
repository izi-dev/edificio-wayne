<?php

namespace IziDev\Services\ElevatorService;

class Movement
{
    private Elevator $elevator;
    private int $destiny;
    private bool $finish = false;
    private ?Movement $next = null;

    public function __construct(Elevator $elevator, int $destiny, ?Movement $next = null)
    {
        $this->elevator = $elevator;
        $this->destiny = $destiny;
        $this->next = $next;
    }

    public function move()
    {
        if ($this->isPositionLessThanDestiny()) $this->elevator->incrementPosition();

        if ($this->isPositionGreaterThanDestiny()) $this->elevator->decrementPosition();

        if ($this->isPositionEqualThanDestiny()) $this->finish = true;
    }

    private function isPositionGreaterThanDestiny(): bool
    {
        return $this->elevator->getPosition() > $this->destiny;
    }

    private function isPositionLessThanDestiny(): bool
    {
        return $this->elevator->getPosition() < $this->destiny;
    }

    private function isPositionEqualThanDestiny(): bool
    {
        return $this->elevator->getPosition() === $this->destiny;
    }

    public function getElevator(): Elevator
    {
        return $this->elevator;
    }

    public function isFinish(): bool
    {
        return $this->finish;
    }

    public function getNext(): ?Movement
    {
        return $this->next;
    }

    public function getPosition(): int
    {
        return $this->getElevator()->getPosition();
    }
}