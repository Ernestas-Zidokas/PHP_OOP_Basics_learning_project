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
            $cookie_array = json_decode($_COOKIE[$this->name], true);
            if ($cookie_array !== null) {
                return $cookie_array;
            }

            trigger_error("Nepavyko decodint cookie", E_WARNING);
        }

        return [];
    }

    /**
     * Turi į Cookie duotu pavadinimu
     * išsaugoti json_encode'intą $data array'jų
     * (Google setcookie)
     * 
     * Į cookie galima įrašyt tik string'ą.
     * Kadangi mes norim galimybę turėti į tą patį
     * Cookie storinti daugiau data'os, galim tiesiog
     * encode'inti ir decode'inti array'jų su json'u.
     * 
     * Mes į cookie įrašysim už'json_encodinę $data
     * ir atkursim atgal json_decode'inę tai ką radom Cookie
     * 
     * @param $data array
     * @param $expires_in int Už kiek laiko sekundemis cookie nebegalios
     */
    public function save($data, $expires_in = 3600): void {
        setcookie($this->name, json_encode($data), time() + $expires_in);
    }

}
