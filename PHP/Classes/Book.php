<?php

require_once 'Product.php';
require_once '..\Config\DataBase Connection.php';


class Book extends Product
{
    private $weight;

    public function __construct($sku, $name, $price, $weight)
    {
        parent::__construct($sku,
                            $name,
                            $price);
        
        $this->weight = $weight;
    }

    //getter

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

    public function getWeight()
    {
        return $this->weight;
    }


    //setter

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

    public function setWeight($weight)
    {
        if (is_numeric($weight)) {
            $this->weight = $weight;
        } else {
            throw new Exception("Weight must be numeric");
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
        $query = "INSERT INTO book (product_sku, weight) 
                  VALUES ('$this->sku',
                          '$this->weight')";
        $connection->query($query);
        $connection->disconnect();
        return "Book inserted";
    }

    public static function getAll()
    {
        $connection = new Database("localhost", "root", "", "scandiweb");
        $connection->connect();
        $result = $connection->query("SELECT * FROM product INNER JOIN book ON product.sku = book.product_sku");
        $connection->disconnect();
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $list = array();
        foreach ($result as $res) {
            $special = "Weight: " . $res["weight"] . "KG";
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