<?php

namespace App;

class SensorFartHumidity extends Abstracts\Sensor {

    public function read() {
        return $this->reading = rand(0, 100) . '%';
    }

}
