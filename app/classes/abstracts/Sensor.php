<?php

namespace App\Abstracts;

abstract class Sensor {

    private $reading;

    abstract protected function getLastReading();

    public function read() {
        $this->reading = true;
    }

}
