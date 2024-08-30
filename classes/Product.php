<?php

class Product {
    private $id;
    private $name;
    private $price;
    private $desc;
    private $img;

    public function __construct($id, $name, $price, $desc, $img) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->desc = $desc;
        $this->img = $img;
    }
    //setter
    public function setId($id) {
        $this->id = $id;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setPrice($price) {
        $this->price = $price;
    }
    public function setDescription($desc) {
        $this->desc = $desc;
    }
    public function setImage($img) {
        $this->img = $img;
    }
    //getter
    public function getId() {
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getDescription(){
        return $this->desc;
    }
    public function getImage(){
        return $this->img;
    }
}