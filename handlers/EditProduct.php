<?php

require_once ('../classes/DataBase.php');
require_once ('../classes/Request.php');
require_once ('../classes/Validation.php');
require_once ('../classes/Session.php');

$request = new Request;
$product = $request->PostProduct();

$Swap = false;

$old_image = $request->PostData('old_image');

if (Validation::ValidateEmptyOrNull($product->getImage())) {
    $product->setImage($old_image);
    $Swap = false;
}
else 
{
    $Swap = $product->getImage() === $old_image? false:true;
}
$errors = Validation::ValidateProduct($product, !$Swap);

if (count($errors) == 0)
{
    if (DataBase::UpdateProduct($product))
    {
        if ($Swap){
            $img_tmp = $_FILES['img']['tmp_name'];
            $path = '../images/' . $old_image;
            $NewPath = '../images/'  . $product->getImage();
            if (file_exists($path))
                unlink($path);
            move_uploaded_file($img_tmp, $NewPath);
        }
        header('location:../index.php');
        exit();
    }else 
    $errors[] = "The product has not been updated.";
}
$sess = new Session;
$sess->set('errors',$errors);
header('location:../index.php');