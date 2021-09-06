<?php

namespace IziDev\Controllers\Api;

use IziDev\Services\ElevatorService\ElevatorBuilder;

class GetReportController
{
    public function __invoke()
    {
        return ElevatorBuilder::make()->get();
    }
}