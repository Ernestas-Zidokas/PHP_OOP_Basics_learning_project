<?php

namespace App;

Class User {

    private $data;
    
    const ORIENTATION_GAY = 'g';
    const ORIENTATION_STRAIGHT = 's';
    const ORIENTATION_BISEXUAL = 'b';
    const GENDER_MALE = 'm';
    const GENDER_FEMALE = 'f';

    public function __construct($data = null) {
        if (!$data) {
            $this->data = [
                'user_name' => null,
                'email' => null,
                'full_name' => null,
                'age' => null,
                'gender' => null,
                'orientation' => null,
                'photo' => null,
            ];
        } else {
            $this->setData($data);
        }
    }

    public function setName(string $name) {
        $this->data['user_name'] = $name;
    }

    public function setEmail(string $email) {
        $this->data['email'] = $email;
    }

    public function setFullName(string $full_name) {
        $this->data['full_name'] = $full_name;
    }

    public function setAge(int $age) {
        $this->data['age'] = $age;
    }

    public function setGender(string $gender) {
        if(in_array($gender, [$this::MALE, $this::FEMALE])){
            $this->data['gender'] = $gender;
        }        
    }

    public function setOrientation(string $orientation) {
        if(in_array($orientation, [$this::GAY, $this::STRAIGHT, $this::BISEXUAL])){
            $this->data['orientation'] = $orientation;
        }
    }

    public function setPhoto(string $photo) {
        $this->data['photo'] = $photo;
    }

    public function getName() {
        return $this->data['name'];
    }

    public function getEmail() {
        return $this->data['email'];
    }

    public function getFullName() {
        return $this->data['full_name'];
    }

    public function getAge() {
        return $this->data['age'];
    }

    public function getGender() {
        return $this->data['gender'];
    }

    public function getOrientation() {
        return $this->data['orientation'];
    }

    public function getPhoto() {
        return $this->data['photo'];
    }

    public function setData(array $data) {
        $this->setName($data['name'] ?? '');
        $this->setAmount($data['email'] ?? '');
        $this->setAbarot($data['full_name'] ?? '');
        $this->setImage($data['age'] ?? null);
        $this->setAmount($data['gender'] ?? '');
        $this->setAmount($data['orientation'] ?? '');
        $this->setAmount($data['photo'] ?? '');
    }

    public function getData() {
        return $this->data;
    }

}
