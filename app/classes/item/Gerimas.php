<?php

namespace App\Item;

/**
 * Class for creating drinks with specific data.
 */
Class Gerimas {

    /**
     *
     * @var type Data[] Array of data.
     */
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

    /**
     * Sets the name value.
     * @param string $name
     */
    public function setName(string $name) {
        $this->data['name'] = $name;
    }

    /**
     * Sets the amount value.
     * @param int $amount
     */
    public function setAmount(int $amount) {
        $this->data['amount_ml'] = $amount;
    }

    /**
     * Sets the abarot value.
     * @param float $abarot
     */
    public function setAbarot(float $abarot) {
        $this->data['abarot'] = $abarot;
    }

    /**
     * Gets the name of given object.
     * @return type string
     */
    public function getName() {
        return $this->data['name'];
    }

    /**
     * Gets the amount of given object.
     * @return type float
     */
    public function getAmount() {
        return $this->data['amount_ml'];
    }

    /**
     * Gets the abarot of given object.
     * @return type int
     */
    public function getAbarot() {
        return $this->data['abarot'];
    }

    /**
     * Sets the given data array by the indexes into the object.
     * @param array $data
     */
    public function setData(array $data) {
        $this->setName($data['name'] ?? '');
        $this->setAmount($data['amount_ml'] ?? 0);
        $this->setAbarot($data['abarot'] ?? 0);
    }

    /**
     * Gets the all objects data.
     * @return type array
     */
    public function getData() {
        return $this->data;
    }

}
