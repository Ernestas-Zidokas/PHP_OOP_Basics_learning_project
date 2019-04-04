<?php

namespace Core;

class Cookie extends Core\Abstracts\Cookie {

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function delete(): void {
        
    }

    public function exists(): bool {
        return isset($_COOKIE[$this->name]);
    }

    public function read(): array {
        if ($this->exists()) {
            $cookie = $_COOKIE[$this->name];
            if (json_decode($cookie)) {
                return json_decode($cookie, true);
            } else {
                error_reporting(E_WARNING);
                return [];
            }
        } else {
            return [];
        }
    }

    public function save($data, $expires_in = 3600): void {
        
    }

}
