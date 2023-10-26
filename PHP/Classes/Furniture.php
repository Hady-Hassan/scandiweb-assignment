<?php

require_once 'Product.php';
require_once '..\Config\DataBase Connection.php';


class Furniture extends Product
{
    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price, $height, $width, $length)
    {
        parent::__construct($sku,
                            $name,
                            $price);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
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

    public function getHeight()
    {
        return $this->height;
    }

    public function getWidth()
    {
        return $this->width;
    }
    public function getLength()
    {
        return $this->length;
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

    public function setHeight($height)
    {
        if (is_numeric($height)) {
            $this->height = $height;
        } else {
            throw new Exception("Height must be numeric");
        }
    }

    public function setWidth($width)
    {
        if (is_numeric($width)) {
            $this->width = $width;
        } else {
            throw new Exception("Width must be numeric");
        }
    }

    public function setLength($length)
    {
        if (is_numeric($length)) {
            $this->length = $length;
        } else {
            throw new Exception("Length must be numeric");
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
        $query = "INSERT INTO furniture (product_sku, height, width, length) 
                  VALUES ('$this->sku',
                          '$this->height',
                          '$this->width', 
                          '$this->length')";
        $connection->query($query);
        $connection->disconnect();
        return "Furniture inserted";
    }


    public static function getAll()
    {
        $connection = new Database("localhost", "root", "", "scandiweb");
        $connection->connect();
        $result = $connection->query("SELECT * FROM product INNER JOIN furniture ON product.sku = furniture.product_sku");
        $connection->disconnect();
        $result = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $list = array();
        foreach ($result as $res) {
            $special = "Dimensions: " . $res["height"] . "x" . $res["width"] . "x" . $res["length"];
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