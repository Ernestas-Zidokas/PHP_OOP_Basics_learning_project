<?php

namespace Core\Abstracts;

abstract class Cookie {

    protected $name;

    abstract public function __construct
    (string $name): void;

    abstract public function read(): array;

    abstract public function save
        (array $data, int $expires_in): void;

    abstract public function delete(): void;
}
