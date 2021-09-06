<?php

namespace IziDev\Services\ElevatorService;

use Carbon\Carbon;

final class Sequence
{
    private Carbon $start;
    private Carbon $end;
    private int $period;
    private array $requests = [];

    public function __construct(Carbon $start, Carbon $end, int $period)
    {
        $this->start = $start;
        $this->end = $end;
        $this->period = $period;
    }

    public function hasInterval(Carbon $moment): bool
    {
        return $this->start->getTimestamp() <= $moment->getTimestamp() && $this->end->getTimestamp() >= $moment->getTimestamp();
    }

    public function getPeriod(): int
    {
        return $this->period;
    }

    public function add(Request $request)
    {
        $this->requests[] = $request;

        return $this;
    }

    public function getRequests(): array
    {
        return $this->requests;
    }

    public function hasRequestElevator(Carbon $moment, int $min): bool
    {
        return $this->hasInterval($moment) && ($min % $this->getPeriod()) === 0;
    }

    public static function make(Carbon $start, Carbon $end, int $period): Sequence
    {
        return new Sequence($start, $end, $period);
    }
}