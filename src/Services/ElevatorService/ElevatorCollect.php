<?php

namespace IziDev\Services\ElevatorService;

final class ElevatorCollect
{
    public array $sequences;
    public array $elevators;
    public array $queues;
    public array $movements;

    public function __construct(array $sequences, array $elevators)
    {
        $this->sequences = $sequences;
        $this->elevators = $elevators;
    }

    public function each($period, int $min)
    {
        collect($this->sequences)->each(fn(Sequence $sequence) => $this->add($sequence, $period, $min));

        return $this;
    }

    public function process()
    {
        $available = array_filter($this->elevators, fn(Elevator $elevator) => $elevator->isAvailable());

        while (count($this->queues) > 0 && count($available) > 0) {
            /** @var Request $request */
            $request = array_shift($this->queues);
            /** @var Elevator $elevator */
            $elevator = array_shift($available);
            $elevator->hasAvailable(false);
            $this->movements[] = new Movement($elevator, $request->origin, new Movement($elevator, $request->destiny));
        }

        return $this;
    }

    public function move(): ElevatorCollect
    {
        $movements = [];

        while (count($this->movements) > 0) {
            /** @var Movement $movement */
            $movement = array_shift($this->movements);
            $movement->move();

            if (!$movement->isFinish()) {
                $movements[] = $movement;
            } else {
                if ($movement->getNext()) $movements[] = $movement->getNext();

                $key = $this->findKeyElevatorByName($movement->getElevator()->getName());
                $this->elevators[$key]->setPosition($movement->getPosition());

                if (!$movement->getNext()) $this->elevators[$key]->hasAvailable(true);
            }
        }

        return $this->addMovements($movements);
    }

    private function addMovements(array $movements): ElevatorCollect
    {
        $this->movements = array_merge($this->movements, $movements);

        return $this;
    }

    private function findKeyElevatorByName($name)
    {
        return collect($this->elevators)
            ->filter(fn(Elevator $elevator) => $elevator->getName() === $name)
            ->keys()
            ->first();
    }

    private function add(Sequence $sequence, $period, int $min)
    {
        if (!$sequence->hasRequestElevator($period, $min)) return;

        foreach ($sequence->getRequests() as $request) {
            $this->queues[] = $request;
        }
    }

    public function get($moment)
    {
        return collect($this->elevators)->map(fn(Elevator $elevator) => [
            'date' => $moment->format("H:i"),
            'floor' => $elevator->getPosition(),
            'name' => $elevator->getName(),
        ]);
    }
}