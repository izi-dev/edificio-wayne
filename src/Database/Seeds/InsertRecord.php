<?php

namespace IziDev\Database\Seeds;

use Carbon\Carbon;
use IziDev\Models\Elevator;
use IziDev\Models\Floor;
use IziDev\Models\Request;
use IziDev\Models\Sequence;

final class InsertRecord
{
    public static function execute()
    {
        if (Floor::query()->count() == 0) {
            $floor_zero = Floor::query()->create(['name' => 'floor zero', 'description' => 'floor zero', 'number' => 0]);
            $floor_one = Floor::query()->create(['name' => 'floor one', 'description' => 'floor one', 'number' => 1]);
            $floor_two = Floor::query()->create(['name' => 'floor two', 'description' => 'floor two', 'number' => 2]);
            $floor_three = Floor::query()->create(['name' => 'floor three', 'description' => 'floor three', 'number' => 3]);
        }

        if (Elevator::query()->count() == 0) {
            $elevator_one = Elevator::query()->create(['name' => 'Elevator one', 'description' => 'Elevator one']);
            $elevator_two = Elevator::query()->create(['name' => 'Elevator two', 'description' => 'Elevator two']);
            $elevator_three = Elevator::query()->create(['name' => 'Elevator two', 'description' => 'Elevator two']);
        }

        if (Sequence::query()->count() == 0) {
            $sequence_one = Sequence::query()->create([
                'start' => Carbon::parse('09:00'),
                'end' => Carbon::parse('11:00'),
                'period' => 5
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_zero->id,
                'floor_destiny_id' => $floor_two->id,
                'sequence_id' => $sequence_one->id,
            ]);
            $sequence_two = Sequence::query()->create([
                'start' => Carbon::parse('09:00'),
                'end' => Carbon::parse('11:00'),
                'period' => 5
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_zero->id,
                'floor_destiny_id' => $floor_three->id,
                'sequence_id' => $sequence_two->id,
            ]);
            $sequence_three = Sequence::query()->create([
                'start' => Carbon::parse('09:00'),
                'end' => Carbon::parse('10:00'),
                'period' => 10
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_zero->id,
                'floor_destiny_id' => $floor_one->id,
                'sequence_id' => $sequence_three->id,
            ]);
            $sequence_four = Sequence::query()->create([
                'start' => Carbon::parse('11:00'),
                'end' => Carbon::parse('18:20'),
                'period' => 20
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_zero->id,
                'floor_destiny_id' => $floor_one->id,
                'sequence_id' => $sequence_four->id,
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_zero->id,
                'floor_destiny_id' => $floor_two->id,
                'sequence_id' => $sequence_four->id,
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_zero->id,
                'floor_destiny_id' => $floor_three->id,
                'sequence_id' => $sequence_four->id,
            ]);
            $sequence_five = Sequence::query()->create([
                'start' => Carbon::parse('14:00'),
                'end' => Carbon::parse('15:00'),
                'period' => 4
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_one->id,
                'floor_destiny_id' => $floor_zero->id,
                'sequence_id' => $sequence_five->id,
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_two->id,
                'floor_destiny_id' => $floor_zero->id,
                'sequence_id' => $sequence_five->id,
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_three->id,
                'floor_destiny_id' => $floor_zero->id,
                'sequence_id' => $sequence_five->id,
            ]);
            $sequence_six = Sequence::query()->create([
                'start' => Carbon::parse('15:00'),
                'end' => Carbon::parse('16:00'),
                'period' => 7
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_two->id,
                'floor_destiny_id' => $floor_zero->id,
                'sequence_id' => $sequence_six->id,
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_three->id,
                'floor_destiny_id' => $floor_zero->id,
                'sequence_id' => $sequence_six->id,
            ]);
            $sequence_seven = Sequence::query()->create([
                'start' => Carbon::parse('15:00'),
                'end' => Carbon::parse('16:00'),
                'period' => 7
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_zero->id,
                'floor_destiny_id' => $floor_one->id,
                'sequence_id' => $sequence_seven->id,
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_zero->id,
                'floor_destiny_id' => $floor_three->id,
                'sequence_id' => $sequence_seven->id,
            ]);
            $sequence_eight = Sequence::query()->create([
                'start' => Carbon::parse('18:00'),
                'end' => Carbon::parse('20:00'),
                'period' => 3
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_one->id,
                'floor_destiny_id' => $floor_zero->id,
                'sequence_id' => $sequence_eight->id,
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_two->id,
                'floor_destiny_id' => $floor_zero->id,
                'sequence_id' => $sequence_eight->id,
            ]);
            Request::query()->create([
                'floor_origin_id' => $floor_three->id,
                'floor_destiny_id' => $floor_zero->id,
                'sequence_id' => $sequence_eight->id,
            ]);
        }
    }
}