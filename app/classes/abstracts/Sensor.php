<?php

namespace App\Abstracts;

abstract class Sensor {

    protected $reading;

    abstract public function read();

    public function getLastReading() {
        return $this->reading;
    }

}
