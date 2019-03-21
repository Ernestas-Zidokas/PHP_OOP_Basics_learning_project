<?php

namespace App\Item;

Class Gerimas {

    private $data;

    public function __construct($data = null) {
        if (!$data) {
            $this->data = [
                'name' => null,
                'amount_ml' => null,
                'abarot' => null
            ];
        } else {
            $this->setData($data);
        }
    }

    public function setName(string $name) {
        $this->data['name'] = $name;
    }

    public function setAmount(int $amount) {
        $this->data['amount_ml'] = $amount;
    }

    public function setAbarot(float $abarot) {
        $this->data['abarot'] = $abarot;
    }

    public function getName() {
        return $this->data['name'];
    }

    public function getAmount() {
        return $this->data['amount_ml'];
    }

    public function getAbarot() {
        return $this->data['abarot'];
    }

    public function setData(array $data) {
        $this->setName($data['name'] ?? null);
        $this->setAmount($data['amount_ml'] ?? null);
        $this->setAbarot($data['abarot'] ?? null);
    }

    public function getData() {
        return $this->data;
    }

}
