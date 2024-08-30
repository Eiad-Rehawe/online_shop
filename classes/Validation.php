<?php

class Validation {
    static public function ValidateId($id) 
    {
        if (filter_var($id,FILTER_SANITIZE_NUMBER_INT))
            return $id >= 0? true:false;
        return false; 
    }
    static public function ValidateEmptyOrNull($t)
    {
        if (empty($t) || $t == null)
            return true;
        return false;
    }
    static public function ValidateProduct($product, $withOldImage = false) {
        $errors = [];

    
        if (Validation::ValidateEmptyOrNull($product->getName()))
            $errors[] = "The name of product is required.";
        if (Validation::ValidateEmptyOrNull($product->getPrice()))
            $errors[] = "The price of product is required.";
        if (Validation::ValidateEmptyOrNull($product->getDescription()))
            $errors[] = "The Description of product is required.";
        if (Validation::ValidateEmptyOrNull($product->getImage()))
            $errors[] = "The Image of product is required.";
        else 
        {
            if (!$withOldImage){
                $image = $_FILES['img'];

                $img_size = $image['size'];
            
                if ($img_size == 0)
                    $errors[] = 'The image is broken';
            }
            $img_ext = pathinfo($product->getImage(), PATHINFO_EXTENSION);
            if (!in_array($img_ext,['png','jpg','jpeg'])) 
                $errors[] = 'The image is not [png, jpg, jpeg]';
        }
        return $errors;
    }
    static public function ValidateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL)? $email:null;
    }
    static public function ValidatePassword($pass){
        $pattern ="/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/";
        return preg_match($pattern, $pass);
    }
    static public function ValidateUser($user, $IsNew = true) {
        $errors = [];

        if ($IsNew){
            if (Validation::ValidateEmptyOrNull($user->getFirstname()))
                $errors[] = "The first name is required.";
            if (Validation::ValidateEmptyOrNull($user->getLastname()))
                $errors[] = "The last name is required.";
            if (Validation::ValidateEmptyOrNull($user->getBirthdate()))
                $errors[] = "The date is required.";
        }
        if (!Validation::ValidateEmail($user->getEmail()))
            $errors[] = "The Email is required.";
        if (!Validation::ValidatePassword($user->getPassword()))
            $errors[] = "The Password must contain at least 8 characters, including uppercase and lowercase letter and numbers.";

        return $errors;
    }
}