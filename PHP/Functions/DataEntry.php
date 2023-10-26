<?php
require_once '..\Classes\Furniture.php';
require_once '..\Classes\Book.php';
require_once '..\Classes\DVD.php';

//furniture
$sku1 = ["TR120024","TR120025","TR120026"];
$name1 = ["table2","table3","table4"];
$price = 100;
$height = 100;
$width = 100;
$length = 100;


//books
$sku2 = ["GGWP0001","GGWP0002","GGWP0003"];
$name2 = ["Ice and Fire", "The Witcher", "The Lord of the Rings"];
$price = 100;
$weight = 100;


//DVDs
$sku3 = ["AV0001","AV0002","AV0003"];
$name3 = ["Dark Souls", "Dark Souls 2", "Dark Souls 3"];
$price = 100;
$size = 100;

foreach ($sku3 as $key => $value) {
    $dvd = new DVD($sku3[$key], $name3[$key], $price, $size);
    echo $dvd->save();
}

foreach ($sku2 as $key => $value) {
    $book = new Book($sku2[$key], $name2[$key], $price, $weight);
    echo $book->save();
}

foreach ($sku1 as $key => $value) {
    $furniture = new Furniture($sku1[$key], $name1[$key], $price, $height, $width, $length);
    echo $furniture->save();
}


?>
