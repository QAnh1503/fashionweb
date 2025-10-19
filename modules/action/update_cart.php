<?php
require "../../lib/validation.php";
require "../../db/connect.php";
require "../../db/database.php";
echo "hi";
$quantity = $_GET['quantity'];
// $id = $_GET['id_product'];
$quantity= $_POST['quantityNum'];
$list_carts= db_fetch_array("SELECT * FROM `cart_items`");
foreach ($list_carts as $cart) {
    if ($cart['id'] == $id) {
        $data = array(
            'quantity' => $quantity
        );
        db_update('cart_items', $data, "`id`={$id}");
        break;
    }
}

// redirect_to("../cart.php");
?>