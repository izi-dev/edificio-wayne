<?php

namespace IziDev\Services\ElevatorService;

final class ElevatorService
{
    private ElevatorInterval $interval;
    private ElevatorCollect $collect;

    public function __construct(ElevatorInterval $interval, ElevatorCollect $collect)
    {
        $this->interval = $interval;
        $this->collect = $collect;
    }

    public function handle()
    {
        return $this->interval->map(fn($period, $min) => $this->execute($period, $min));
    }

    private function execute($period, $min)
    {
        return $this->collect->each($period, $min)->process()->move()->get($period);
    }
}