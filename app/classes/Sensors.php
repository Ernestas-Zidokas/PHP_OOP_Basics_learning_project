<?php

namespace App;

Class Sensors {

    /** @var \App\Abstracts\Sensor[] */
    private $sensors;

    public function __construct() {
        $this->sensors = [];
    }

    public function getReading($id) {
        return $this->sensors[$id]->read();
    }

    public function add($id, \App\Abstracts\Sensor $sensor) {
        $this->sensors[$id] = $sensor;
    }

    public function getReadings() {
        $readings = [];

        foreach ($this->sensors as $id => $sensor) {
            $readings[$id] = $sensor->read();
        }

        return $readings;
    }

}
