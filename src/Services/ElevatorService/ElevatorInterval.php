<?php

namespace IziDev\Services\ElevatorService;

use Carbon\Carbon;

class ElevatorInterval
{
    public Carbon $start;
    public Carbon $end;

    public function __construct(Carbon $start, Carbon $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function map($callback)
    {
        $interval = new \DateInterval('P0YT1M');
        $periods = new \DatePeriod($this->start, $interval, $this->end);

        return collect($periods)->map(fn($period) => $callback($period, (int)$period->format('i')));
    }
}