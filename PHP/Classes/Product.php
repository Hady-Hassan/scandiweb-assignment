<?php

require_once '..\Config\DataBase Connection.php';

abstract class Product
{
    
    protected $sku;
    protected $name;
    protected $price;

    
    public function __construct($sku, $name, $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    //getters
    abstract public function getSku();
    abstract public function getName();
    abstract public function getPrice();

    //setters
    abstract public function setSku($sku);
    abstract public function setName($name);
    abstract public function setPrice($price);

    abstract public function save();

    abstract public static function getAll();



    public static function delete($id)
    {
        $connection = new Database("localhost", 
                                   "root",
                                   "",
                                   "scandiweb");
        $connection->connect();
        $connection->query("DELETE FROM product WHERE SKU = '$id'");
        $connection->disconnect();   

        return "deleted successfully";
    }



}
?>