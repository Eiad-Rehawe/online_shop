<?php

require_once ('Product.php');   
require_once ('User.php');
class Request {
    public function GetData($key)
    {
        if (isset($_GET[$key]))
        {
            return empty($_GET[$key])? null: $_GET[$key];
        }
        return null;
    }

    public function PostData($key)
    {
        if (isset($_POST[$key]))
        {
            return empty($_POST[$key])? null: $_POST[$key];
        }
        return null;
    }
    public function getProduct(){

        $product = new Product('','','','','');

        $product->setName($this->GetData('name'));
        $product->setPrice($this->GetData('price'));
        $product->setDescription($this->GetData('description'));
        return $product;
    }
    public function PostProduct()
    {
        $product = new Product('','','','','');
        $product->setId($this->PostData('id'));
        $product->setName($this->PostData('name'));
        $product->setPrice($this->PostData('price'));
        $product->setDescription($this->PostData('desc'));
        $image_name = isset($_FILES['img'])? $_FILES['img']['name']:null;
        $product->setImage($image_name);
        
        return $product;
    }
    public function GetUser()
     {
        $user = new User('','','','','','');
        $user->setId($this->GetData('id'));
        $user->setFirstname($this->GetData('firstname'));
        $user->setLastname($this->GetData('lastname'));
        $user->setBirthdate($this->GetData('birthdate'));
        $user->setEmail($this->GetData('email'));
        $user->setPassword($this->GetData('password'));

        return $user;
    }
    public function PostUser()
    {
        $user = new User('','','','','','');
        $user->setId($this->PostData('id'));
        $user->setFirstname($this->PostData('firstname'));
        $user->setLastname($this->PostData('lastname'));
        $user->setBirthdate($this->PostData('birthdate'));
        $user->setEmail($this->PostData('email'));
        $user->setPassword($this->PostData('password'));

        return $user;
    }
}