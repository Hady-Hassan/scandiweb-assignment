<?php
require_once '..\Classes\Furniture.php';
require_once '..\Classes\Book.php';
require_once '..\Classes\DVD.php';


$sku = "1234123772";
$name = "loolfur2";
$price = 500;
$type = "Furniture";
$height = 620;
$width = 620;
$length = 620;
$weight = 70;
$size = 20;

$functions = [
        "DVD" => function ($sku, $name, $price, $height, $width, $length, $weight, $size) 
        {
            $dvd = new DVD($sku, $name, $price, $size);
            echo $dvd->save();
        },
        "Book" => function ($sku, $name, $price, $height, $width, $length, $weight, $size) 
        {
           
            $book = new Book($sku, $name, $price, $weight);
            echo $book->save();
        },
        "Furniture" => function ($sku, $name, $price, $height, $width, $length, $weight, $size) 
        {
            $furniture = new Furniture($sku, $name, $price, $height, $width, $length);
            echo $furniture->save();
        }
    ];

   // $functions[$type]($sku, $name, $price, $height, $width, $length, $weight, $size);

    echo "Add endpoint called";
    ?>