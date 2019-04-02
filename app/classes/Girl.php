<?php

namespace App;

class Girl {
    
    protected $age;
    
    public function __construct($age) {
        $this->age = $age;
    }

    public function beSmart() {
        return 'Im Smart';
    }

    public function beBeautiful() {
        return 'Im Beautiful';
    }

}
