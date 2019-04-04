<?php

namespace Core;

class Cookie extends Core\abstracts\Cookie {

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function delete(): void {
        
    }

    public function exists(): bool {
        
    }

    public function read(): array {
        
    }

    public function save($data, $expires_in = 3600): void {
        
    }

}
