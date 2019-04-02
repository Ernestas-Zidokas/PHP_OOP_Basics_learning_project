<?php

namespace App;

class Husband extends Boyfriend {

    public function winArgument() {        
        return (!rand(0, 1000000)) ? parent::winArgument() : 'No way';
    }

}
