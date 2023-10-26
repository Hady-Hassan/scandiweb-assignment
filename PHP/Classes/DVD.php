<?php

require_once 'Product.php';
require_once '..\Config\DataBase Connection.php';


class DVD extends Product
{
    private $size;

    public function __construct($sku, $name, $price, $size)
    {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }

    //getters
    public function getSku()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getSize()
    {
        return $this->size;
    }

    //setters

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {

        if (is_numeric($price)) {
            $this->price = $price;
        } else {
            throw new Exception("Price must be numeric");
        }
    }

    public function setSize($size)
    {
        if (is_numeric($size)) {
            $this->size = $size;
        } else {
            throw new Exception("Size must be numeric");
        }
    }

    public function save()
    {
        $connection = new Database("localhost", "root", "", "scandiweb");
        $connection->connect();
        $query = "INSERT INTO product (sku, name, price) 
                  VALUES ('$this->sku',
                          '$this->name',
                          '$this->price')";
        $connection->query($query);
        $query = "INSERT INTO dvd (product_sku, size) 
                  VALUES ('$this->sku',
                          '$this->size')";
        $connection->query($query);
        $connection->disconnect();
        return "DVD inserted";
    }

    public static function getAll()
    {
        $connection = new Database("localhost", "root", "", "scandiweb");
        $connection->connect();
        $result = $connection->query("SELECT * FROM product INNER JOIN dvd ON product.sku = dvd.product_sku");
        $connection->disconnect();
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $list = array();
        foreach ($result as $res) {
            $special = "Size: " . $res["size"] . " MB";
            $obj = [
                "sku" => $res["SKU"],
                "name" => $res["name"],
                "price" => $res["price"],
                "attr"=> $special
            ];
            array_push($list,$obj );
        }
        return $list;
    }
}
?>