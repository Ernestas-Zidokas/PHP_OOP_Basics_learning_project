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
        $cookie = [];
        if ($this->exists()) {
            $cookie = json_decode($_COOKIE[$this->name], true);            
            if ($cookie) {
                return $cookie;
            } else {
                trigger_error("Nepavyko decodint cookie", E_WARNING);
                return $cookie;
            }
        }
        
        return $cookie;
    }

    public function save($data, $expires_in = 3600): void {
        
    }

}
