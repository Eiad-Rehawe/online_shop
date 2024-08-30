<?php 

require_once ('../classes/Request.php');
require_once ('../classes/Validation.php');
require_once ('../classes/DataBase.php');
$request = new Request;
$id = $request->GetData('id');
if ($id != null) {
    if (Validation::ValidateId($id)) {
        $p = DataBase::GetOneProduct($id);

        if(DataBase::DeleteProduct($id)){
            if (file_exists('../images/' . $p->getImage()))
                unlink('../images/' . $p->getImage());
            header("location:../index.php");
        }
    }
}