<?php
require_once ('Product.php');
class DataBase {
    static public $Host = 'localhost';
    static private $dbName = 'Online_Shop';
    static private $username = 'root';
    static private $password = '';

    static private function TestConnection()
    {
        try 
        {
            $connection = new PDO("mysql:host=" . self::$Host . ";dbname=" . self::$dbName, self::$username, self::$password);
            return $connection;
        }
        catch(PDOException $ex)
        {
            return null;
        }
    }
    static private function executeCommand($command) 
    {
        try 
        {
            $connection = self::TestConnection();

            if ($connection != null){
                $connection->exec($command);
                return true;
            }return false;
        }
        catch (Exception $ex)
        {
            return false;
        }
    }
    static private function Query($query)
    {
        try
        {
            $connection = self::TestConnection();

            if ($connection != null)
            {
                $statement = $connection->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();

                if (count($result))
                    return $result;
                return null;
            }
            return null;
        }
        catch (Exception $ex)
        {
            return null;
        }
    }
    static private function GetFirstRecord($sql)
    {
        $res = self::Query($sql);
        return $res? $res[0]:null;
    }


    static public function AddProduct($product)
    {
        $sql = "Insert into products (product_name, product_price, product_description, product_image) values ('" . $product->getName() . "', " . $product->getPrice() . ", '" . $product->getDescription() . "', '" . $product->getImage() . "')";
        return self::executeCommand($sql);
    }
    static public function DeleteProduct($id){
        $sql = "delete from products where product_id = $id";
        return self::executeCommand($sql);
    }
    static public function UpdateProduct($product){
        $sql = "update products set product_name = '" . $product->getName() . "', product_price = " . $product->getPrice() . ", product_description = '" . $product->getDescription() . "', product_image = '" . $product->getImage() . "' where product_id = " . $product->getId();
        return self::executeCommand($sql);
    }
    static public function GetAllProducts()
    {
        $products = array();
        $sql = "Select product_id, product_name, product_price, product_description, product_image from Products";
        $result = self::Query($sql);
        if ($result != null)
        {
            foreach ($result as $row){
                $product = new Product(
                $row['product_id'],
                $row['product_name'],
                $row['product_price'],
                $row['product_description'],
                $row['product_image']
                );
                $products[] = $product;
            }
            return $products;
        }return null;
    }
    static public function GetOneProduct($id)
    {
        $sql = "Select * from products where product_id = $id";
        $result =  self::GetFirstRecord($sql);
        if ($result != null){
            $product = new Product(
                $result['product_id'],
                $result['product_name'],
                $result['product_price'],
                $result['product_description'],
                $result['product_image']
            );
            return $product;
        }return null;
    }


    static public function AddUser($user){
        $sql = "Insert into Users(first_name, last_name, birth_date, email, password) values ('" . $user->getFirstname() . "', '" . $user->getLastname() . "', '" . $user->getBirthdate() . "', '" . $user->getEmail() . "', '" . password_hash($user->getPassword(), PASSWORD_DEFAULT) . "');";
        return self::executeCommand($sql);
    }
    static public function GetOneUser($email){
        $sql = "Select * from users where email = '$email'";
        $result =  self::GetFirstRecord($sql);
        if ($result != null){
            $user = new User(
                $result['id'],
                $result['first_name'],
                $result['last_name'],
                $result['birth_date'],
                $result['email'],
                $result['password']
            );
            return $user;
        }return null;
    }    
}