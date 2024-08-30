<?php

    require_once('../classes/Request.php');
    require_once('../classes/Validation.php');
    require_once('../classes/DataBase.php');
    require_once ('../classes/Session.php');

    $request = new Request;
    $product = $request->PostProduct();

    $errors = Validation::ValidateProduct($product);

    if (count($errors) == 0)
    {
        if (DataBase::AddProduct($product)) 
        {            
            $img_tmp = $_FILES['img']['tmp_name'];
            move_uploaded_file($img_tmp,'../images/' . $product->getImage());
            header('location:../index.php');
            exit();
        }
        else 
            $errors[] = "The product has not been added.";
    }
    $sess = new Session;
    $sess->set('errors',$errors);
    header('location:../index.php');