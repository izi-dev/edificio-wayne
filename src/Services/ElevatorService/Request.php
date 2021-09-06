<?php

namespace IziDev\Services\ElevatorService;

class Request
{
    public int $destiny;
    public  int $origin;

    public function __construct(int $destiny, int $origin)
    {
        $this->destiny = $destiny;
        $this->origin = $origin;
    }
}