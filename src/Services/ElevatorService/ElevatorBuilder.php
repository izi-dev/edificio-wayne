<?php

namespace IziDev\Services\ElevatorService;

use Carbon\Carbon;

class ElevatorBuilder
{
    private ElevatorInterval $interval;
    private array $elevators = [];
    private array $sequences;

    private function interval()
    {
        $this->interval = new ElevatorInterval(Carbon::parse('09:00'), Carbon::parse('20:01'));
        return $this;
    }

    private function collect()
    {
        foreach (\IziDev\Models\Sequence::all() as $model) {
            $sequence = Sequence::make($model->start, $model->end, $model->period);
            foreach ($model->requests as $req) {
                $sequence->add(new Request($req->destiny->number, $req->origin->number));
            }
            $this->sequences[] = $sequence;
        }
    }

    private function elevator()
    {
        foreach (\IziDev\Models\Elevator::all() as $model) {
            $this->elevators[] = new Elevator($model->name);
        }

        return $this;
    }

    public function get()
    {
        $collect = new ElevatorCollect($this->sequences, $this->elevators);
        $service = new ElevatorService($this->interval, $collect);

        return $service->handle();
    }

    public static function make()
    {
        $builder = new ElevatorBuilder();
        $builder->interval();
        $builder->elevator();
        $builder->collect();
        return $builder;
    }
}