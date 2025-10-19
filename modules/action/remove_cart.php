<?php
session_start();
require "../../db/connect.php";
require "../../db/database.php";
require "../../lib/validation.php";

$slug= $_GET['slug'];
$id= $_GET['id'];


$id_product= $_GET['id_product'];
var_dump($_SESSION['cart']);
foreach ($_SESSION['cart'] as $key => $value)
{
    if ($value['id']== $id_product)
    {
        unset($_SESSION['cart'][$key]);
    }
}
db_delete('cart_items', "`id`=$id_product");
// echo $slug;
// echo "<br>".$id;
// echo "<br>".$id_product;

if ($slug == 'cart')
{
    redirect_to("../cart.php");
}
else if ($slug == 'home')
{
    redirect_to("../home.php");
}
else 
{
    redirect_to("../detailed_product.php?slug={$slug}&id={$id}");
}
?>