<?php
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

require_once ('../classes/Request.php');
require_once ('../classes/Validation.php');
require_once ('../classes/DataBase.php');
require_once ('../classes/Session.php');

$request = new Request;
$user = $request->PostUser();

$errors = Validation::ValidateUser($user);

if (count($errors) == 0) 
{
    $result = DataBase::GetOneUser($user->getEmail());
    if ($result != null)
        $errors[] = "The email already exist.";
    else
    {
        if (!DataBase::AddUser($user))
            $errors[] = "The User has been not added.";
        else {
            $_SESSION['login'] = 'Success';
            header("location:../index.php");
            exit();
        } 
    }
}
$sess = new Session;
$sess->set('errors',$errors);
header('location:../login.php');