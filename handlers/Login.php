<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

require_once ('../classes/Request.php');
require_once ('../classes/Validation.php');
require_once ('../classes/DataBase.php');
require_once ('../classes/Session.php');

$request = new Request;
$user = $request->PostUser();

$errors = Validation::ValidateUser($user, false);

if (count($errors) == 0)
{
    $res = DataBase::GetOneUser($user->getEmail());
    if ($res != null){
        if (password_verify($user->getPassword(), $res->getPassword())){
            $_SESSION['login']='Success';
            header("location:../index.php");
            exit();
        } 
    }
    $errors[] = "The email and password are incorrect !!";
}
$sess = new Session;
$sess->set('errors',$errors);
header('location:../login.php');