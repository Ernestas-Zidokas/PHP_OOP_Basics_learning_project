<?php

namespace App;

class Boyfriend extends Boy {

    public function winArgument() {
        $array = ['Not this time!', parent::winArgument()];

        return $array[rand(0, 1)];
    }

}
