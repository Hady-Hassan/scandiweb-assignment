<?php
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, POST, DELETE');

header("Access-Control-Allow-Headers: *");

require_once '..\Classes\Product.php';
require_once '..\Classes\Furniture.php';
require_once '..\Classes\Book.php';
require_once '..\Classes\DVD.php';

// Check if the request method is DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Your delete logic here
    $json = file_get_contents("php://input");
    $data = json_decode($json);
    foreach ($data as $sku) {
        //make delete method here
        Product::delete($sku);
    }
 
    echo "Delete endpoint called";
}

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Your display logic here
    // echo "Display endpoint called<br>";
    // echo "========================<br>";
    $furniture = Furniture::getAll();
    $books = Book::getAll();
    $dvds = DVD::getAll();

    $products = array_merge($furniture, $books, $dvds);
    array_multisort(array_column($products, 'sku'), SORT_ASC, $products);
    echo json_encode($products);

    // foreach ($products as $product) {
    //     echo $product['sku']. "<br>";
    //     echo $product['name']. "<br>";
    //     echo $product['price']. "<br>";
    //     echo $product['attr']. "<br>";
    //     echo "========================<br>";
    // }
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Your add logic here
    $json = file_get_contents("php://input");
    $data = json_decode($json);

    $type = $data->data->type;


    $functions = [
        "DVD" => function ($data) 
        {
            $sku = $data->data->sku;
            $name = $data->data->name;
            $price = $data->data->price;
            $size = $data->data->size;
            $dvd = new DVD($sku,
                           $name,
                           $price,
                           $size);
            echo $dvd->save();
        },
        "Book" => function ($data) 
        {
            $sku = $data->data->SKU;
            $name = $data->data->name;
            $price = $data->data->price;
            $weight = $data->data->weight;          
            $book = new Book($sku,
                             $name,
                             $price,
                             $weight);
            echo $book->save();
        },
        "Furniture" => function ($data) 
        {
            $sku = $data->data->SKU;
            $name = $data->data->name;
            $price = $data->data->price;
            $height = $data->data->height;
            $width = $data->data->width;
            $length = $data->data->length;
            $furniture = new Furniture($sku,
                                       $name,
                                       $price,
                                       $height,
                                       $width,
                                       $length);
            echo $furniture->save();
        }
    ];

    $functions[$type]($data);

    echo "Add endpoint called";
}
?>