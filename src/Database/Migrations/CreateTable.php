<?php

namespace IziDev\Database\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

final class CreateTable
{
    public static function execute()
    {
        if (!Capsule::schema()->hasTable('elevators')) {
            Capsule::schema()->create('elevators', function (Blueprint $table) {
                $table->id();
                $table->string("name");
                $table->text("description");
                $table->timestamps();
            });
        }

        if (!Capsule::schema()->hasTable('floors')) {
            Capsule::schema()->create('floors', function (Blueprint $table) {
                $table->id();
                $table->string("name");
                $table->text("description");
                $table->integer("number");
                $table->timestamps();
            });
        }

        if (!Capsule::schema()->hasTable('sequences')) {
            Capsule::schema()->create('sequences', function (Blueprint $table) {
                $table->id();
                $table->dateTime("start");
                $table->dateTime("end");
                $table->integer("period");
                $table->timestamps();
            });
        }

        if (!Capsule::schema()->hasTable('requests')) {
            Capsule::schema()->create('requests', function (Blueprint $table) {
                $table->id();
                $table->integer("floor_origin_id");
                $table->integer("floor_destiny_id");
                $table->integer("sequence_id");
                $table->timestamps();
            });
        }
    }
}