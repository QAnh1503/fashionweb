<?php
session_start();
ob_start();
// require "../db/connect.php";
require_once __DIR__ . '/../db/connect.php';
//require "../db/database.php";

// $list_array = db_fetch_array("SELECT * FROM `product`");
// $num_rows = db_num_rows("SELECT * FROM `product`");


$category = '';
if (isset($_GET['category'])) {
    $category = $_GET['category'];
}

$subcategory = '';
if (isset($_GET['subcategory'])) {
    $subcategory = $_GET['subcategory'];
}


$list_subcategory_items = array();
$num_rows_subcategory_items = 0;

if (!empty($category) && !empty($subcategory)) {
    $list_subcategory_items = db_fetch_array("SELECT * FROM `product` WHERE `category`='{$category}' AND `subcategory`='{$subcategory}'");
    $num_rows_subcategory_items = db_num_rows("SELECT * FROM `product` WHERE `category`='{$category}' AND `subcategory`='{$subcategory}'");
}
if ($category == "GIFT") {
    $list_subcategory_items = db_fetch_array("SELECT * FROM `product` WHERE `subcategory`='{$subcategory}'");
    $num_rows_subcategory_items = db_num_rows("SELECT * FROM `product` WHERE `subcategory`='{$subcategory}'");
}
if (!empty($category) && empty($subcategory)) {
    $list_subcategory_items = db_fetch_array("SELECT * FROM `product` WHERE `category`='{$category}'");
    $num_rows_subcategory_items = db_num_rows("SELECT * FROM `product` WHERE `category`='{$category}'");
}

$variant = "";
$list_variants = array();
if (isset($_GET['variant'])) {
    $variant = $_GET['variant'];
    if ($category == "GIFT") {
        $list_subcategory_items = db_fetch_array("SELECT * FROM `product` WHERE `variant`='{$variant}'");
        $num_rows_subcategory_items = db_num_rows("SELECT * FROM `product` WHERE `variant`='{$variant}'");
    } else {
        $list_subcategory_items = db_fetch_array("SELECT * FROM `product` WHERE `category`='{$category}' AND `variant`='{$variant}'");
        $num_rows_subcategory_items = db_num_rows("SELECT * FROM `product` WHERE `category`='{$category}' AND `variant`='{$variant}'");
    }
}


if (isset($_POST['price_filter_increase'])) {
    usort($list_subcategory_items, function ($a, $b) {
        return $a['price'] - $b['price']; // Sắp xếp tăng dần dựa trên 'price'
    });
} elseif (isset($_POST['price_filter_decrease'])) {
    usort($list_subcategory_items, function ($a, $b) {
        return $b['price'] - $a['price'];
    });
}


// require '/unitop-php/fashionweb/modules/view/contact_us.php';
// require '../modules/view/side_cart.php';

require_once __DIR__ . '/../modules/view/contact_us.php';
require_once __DIR__ . '/../modules/view/side_cart.php';



$user_id_active = 0;
$username_active = "";
$img_user_active = "";
$account_type_active = "";
$cart_id_active = 0;
// $tbl_users = db_fetch_array("SELECT * FROM `tbl_users`");
// $tbl_carts = db_fetch_array("SELECT * FROM `carts`");
// foreach ($tbl_users as $item) {
//     if ($item['email'] == $_SESSION['email_login']) {
//         $user_id_active = $item['account_id'];
//         $username_active = $item['username'];
//         $img_user_active .= $item['account_image'];
//         $account_type_active = $item['account_types'];
//     }
// }

// echo "User Id Active: " . $user_id_active;

// foreach ($tbl_carts as $item) {
//     if ($item['user_id'] == $user_id_active) {
//         $cart_id_active = $item['cart_id'];
//     }
// }
// // echo "Cart Id Active: " . $cart_id_active;
// $list_carts = db_fetch_array("SELECT * FROM `cart_items` where `cart_id`={$cart_id_active}");
// $num_row_carts = db_num_rows("SELECT * FROM `cart_items` where `cart_id`={$cart_id_active}");

// $carts = db_fetch_array("SELECT * FROM `carts` where `cart_id`={$cart_id_active}");
// $stateCart="Active";
// foreach ($carts as $cart)
// {
//     if ($cart['status']=="Checkout")
//     {
//         $stateCart="Checkout";
//     }
// }
// $quantity_carts = 0;
// if ($stateCart!="Checkout")
// {
//     foreach ($list_carts as $cart) {
//         $quantity_carts += $cart['quantity'];
//     }
// }


// echo "List cart: ";
// print_r($list_carts);

// echo "quantity cart: " . $quantity_carts;
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Abel&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Abel&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Abel&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Space+Grotesk:wght@300..700&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Abel&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Space+Grotesk:wght@300..700&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Abel&family=Play:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Space+Grotesk:wght@300..700&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Abel&family=Play:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Shadows+Into+Light&family=Space+Grotesk:wght@300..700&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Abel&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Play:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Shadows+Into+Light&family=Space+Grotesk:wght@300..700&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/unitop-php/fashionweb/public/css/reset.css" type="text/css">
    <link rel="stylesheet" href="/unitop-php/fashionweb/public/css/inc/header_home.css" type="text/css">
    <link rel="stylesheet" href="/unitop-php/fashionweb/public/css/users.css" type="text/css">
    <script defer src="/unitop-php/fashionweb/public/js/script.js"></script>
    <!-- <script defer src="../public/js/header.js"></script> -->


    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Linking arrow to right -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0&icon_names=chevron_forward" />

    <script src="https://kit.fontawesome.com/16d8c86832.js" crossorigin="anonymous"></script>

    <style>
        #header {
            /* background: #029ef3; */
            background-color: #000;
            display: flex;
            justify-content: space-between;
            /* Đặt hai ul ở hai bên (chỉ áp dụng cho các phần tử con của thẻ này) */
        }

        #main_menu_bar li:first-child a {
            font-family: 'Georgia', serif;
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }

        ul#main_menu_bar li a {
            display: block;
            padding: 8px 15px;
            color: #fff;
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            font-style: normal;
            font-size: 14px;
        }

        #search_input {
            padding: 5px 10px;
            background-color: #000;
            border: 0.5px solid #fff;
            border-right: none;
            border-radius: 4px 0 0 4px;
            outline: none;
            width: 100%;
            height: 100%;
        }

        #search_button {
            background-color: #000;
            color: #fff;
            border: 0.5px solid #fff;
            width: 30px;
            height: 100%;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }


        .menu_women a:hover,
        .menu_men a:hover,
        .menu_gift a:hover {
            border-bottom: 1px solid #fff;
            transform: scale(1.02);
        }

        #open_card_contact a:hover {
            border-bottom: 1px solid #fff;
        }

        .menu_item:hover a {
            border-bottom: 1px solid #fff;
        }

        .left_column ul li a {
            padding: 0 !important;
            font-family: "Montserrat", sans-serif !important;
            font-size: 13px !important;
            font-weight: 400 !important;
            width: fit-content !important;
            color: #000 !important;
        }


        /* CART */
        .header_title h2 {
            color: #000;
        }

        .header_title span {
            position: absolute;
            top: -10px;
            right: -23px;
            width: 20px;
            height: 19px;
            padding: 10px;
            border-radius: 50%;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #000;
        }
    </style>
    <style>
        
        .side_menu {
            position: relative;
        }

        .hover_content_user {
            top: calc(100% + 10px);
            /* Khoảng cách giữa menu và hover_content */
            position: absolute;
            top: 100%;
            right: 0;
            display: none;
            flex-direction: column;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 25%;
            z-index: 10;
            gap: 10px;
            max-height: 350px;
        }

        .side_menu_user {
            align-content: center;
            height: 100%;
        }
        .side_menu_user:active .hover_content_user,
        .side_menu_user:focus .hover_content_user,
        .side_menu_user:hover .hover_content_user {
            display: flex;
        }

        /* .fa-user:hover {
            transform: scale(1.5);
        } */
        /* .side_menu_user:hover {
            transform: scale(1.5);
        } */

        .user_active_infor {
            flex-direction: column;
            position: relative;
            align-content: center;
        }

        .user_active_infor img {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            margin-bottom: 20px;
            margin-top: 30px;
        }

        .user_active_infor p {
            width: 100%;
            position: absolute;
            margin-top: 5px;
            top: 0;
            left: 120px;
            color: #000;
            font-family: "Montserrat", sans-serif;
            font-size: 13px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .user_active_infor h4 {
            color: #000;
            font-family: "Montserrat", sans-serif;
            font-weight: 400;
            font-size: 18px;
        }

        
        .other_options {
            height: 84px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .other_options a {
            color: #fff;
            font-family: "Montserrat", sans-serif;
            display: block;
            width: 100%;
            height: 40px;
            align-content: center;
            background: #000;
            border-radius: 3px;
            transition: transform 0.3s ease;
        }

        .other_options a:hover {
            transform: scale(0.95) ;
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <!-- ============================================ HEADER ============================================-->
    <div id="wrapper">
        <!-- ============================================ HEADER ============================================-->
        <div id="header">
            <ul id="main_menu_bar">
                <li><a href="home.php">Style Seeker</a></li>
                <!-- <li><a href="?">Style Seeker</a></li> -->
                <li class="menu_gift"><a href="#">Gifts</a>
                    <div class="hover_content">
                        <div
                            style="width: 300px;text-align: left;display: flex; flex-direction: column;justify-content: space-between;">
                            <img style="width: 100%;height: 100%;" src="/unitop-php/fashionweb/public/img/menu_bar/GIFT.jpg"
                                alt="beauty.jpg">
                        </div>
                        <div style="width: 500px;">
                            <img style="width: 100%;height: 150px;margin-bottom: 10px;"
                                src="/unitop-php/fashionweb/public/img/menu_bar/81b88cd18000cb4793a07aaa3b5d5388.jpg" alt="beauty.jpg">

                            <div class="left_column" style="width: 100%;height: 150px;">
                                <h4>GIFT FOR LOVER</h4>
                                <div style="display:flex">
                                    <ul style="flex: 1;">
                                        <li style="display: block;">Bags
                                            <!-- <a
                                                href="product.php?category=GIFT&subcategory=bag">Bags
                                            </a> -->
                                        </li>
                                        <li style="display: block;">Shoes
                                            <!-- <a
                                                href="product.php?category=GIFT&subcategory=shoes">Shoes
                                            </a> -->
                                        </li>
                                        <li style="display: block;">Hat
                                            <!-- <a
                                                href="product.php?category=GIFT&subcategory=hat">Hat
                                            </a> -->
                                        </li>

                                    </ul>
                                    <!-- <ul style="flex: 1;">
                                        <li style="display: block;"><a
                                                href="product.php?category=GIFT&subcategory=shirt">Shirt</a>
                                        </li>
                                        <li style="display: block;"><a
                                                href="product.php?category=GIFT&subcategory=belt">Belt</a>
                                        </li>
                                        <li style="display: block;"><a
                                                href="product.php?category=GIFT&subcategory=trousers">Trousers</a></li>
                                    </ul>
                                    <ul style="flex: 1;">
                                        <li style="display: block;"><a
                                                href="product.php?category=GIFT&subcategory=watch">Watch</a>
                                        </li>
                                    </ul> -->
                                </div>
                            </div>
                        </div>
                        <div class="right_column">
                            <h4>REFINED</h4>
                            <p>From accessories like belts and watches to clothing like shirts and trousers, they cater
                                to diverse needs and occasions. Perfect for enhancing everyday looks or elevating a
                                polished appearance.</p>
                        </div>
                        <div
                            style="width: 180px;text-align: left;display: flex; flex-direction: column;justify-content: space-between;">
                            <img style="width: 100%;height: 150px;"
                                src="/unitop-php/fashionweb/public/img/menu_bar/87ef78d6eb07868c59d5357839f5f914.jpg" alt="beauty.jpg">
                            <img style="width: 100%;height: 150px;"
                                src="/unitop-php/fashionweb/public/img/menu_bar/7ea12b4bb0c32d65cf71423ad22a748a.jpg" alt="beauty.jpg">
                        </div>
                    </div>
                </li>
                <!-- <li class="menu_women"><a href="#">Woman</a>
                    <div class="hover_content" style="justify-content: space-between;">
                        <div style="width: 500px;text-align: left;">
                            <div style="width:100%; display:flex; justify-content: space-between;">
                                <img style="width: 150px;margin-bottom: 7px;" src="/fashionweb/public/img/menu_bar/women.jpg"
                                    alt="beauty.jpg">
                                <img style="width: 150px;margin-bottom: 7px;" src="../public/img/menu_bar/bag.jpg"
                                    alt="beauty.jpg">
                                <img style="width: 150px;margin-bottom: 7px;"
                                    src="../public/img/menu_bar/pexels-photo-6944178.jpg" alt="beauty.jpg">
                            </div>
                            <div style="width:100%; display:flex; justify-content: space-between;">
                                <img style="width: 150px;margin-bottom: 7px;"
                                    src="../public/img/menu_bar/pexels-photo-932401.jpg" alt="beauty.jpg">
                                <img style="width: 150px;margin-bottom: 7px;" src="../public/img/menu_bar/hat1.jpeg"
                                    alt="beauty.jpg">
                                <img style="width: 150px;margin-bottom: 7px;" src="../public/img/menu_bar/shoes.jpg"
                                    alt="beauty.jpg">
                            </div>
                        </div>

                        <div class="left_column">
                            <h4>BEAUTY</h4>
                            <ul>
                                <li style="display: block;"><a
                                        href="product.php?category=WOMEN&subcategory=bag">Bags</a></li>
                                <li style="display: block;"><a
                                        href="product.php?category=WOMEN&subcategory=shoes">Shoes</a></li>
                                <li style="display: block;"><a href="product.php?category=WOMEN&subcategory=hat">Hat</a>
                                </li>
                                <li style="display: block;"><a
                                        href="product.php?category=WOMEN&subcategory=shirt">Shirt</a></li>
                                <li style="display: block;"><a
                                        href="product.php?category=WOMEN&subcategory=belt">Belt</a></li>
                                <li style="display: block;"><a
                                        href="?category=WOMEN&subcategory=fragrances">Fragrances</a></li>
                            </ul>
                        </div>
                        <img style="width: 330px;display: block;" src="../public/img/menu_bar/women2.jpeg"
                            alt="women1.jpeg">
                        <div class="right_column">
                            <h4>ELEGANCE</h4>
                            <p>The Women section offers elegant Bags, premium Beauty and Fragrances. Each item blends
                                sophistication with practicality, celebrating timeless femininity.</p>
                        </div>
                    </div>
                </li>
                <li class="menu_men"><a href="#">Men</a>
                    <div class="hover_content">
                        <div
                            style="width: 250px;text-align: left;display: flex; flex-direction: column;justify-content: space-between;">
                            <img style="width: 100%;height: 150px;"
                                src="../public/img/menu_bar/e9c1377b2b0bff2d360b249c163385f4.jpg" alt="beauty.jpg">
                            <img style="width: 100%;height: 150px;"
                                src="../public/img/menu_bar/91d2a91a5b7ca5f3b635de7eebc73ca8.jpg" alt="beauty.jpg">
                        </div>
                        <div class="left_column">
                            <h4>ESSENTIALS</h4>
                            <ul>
                                <li style="display: block;"><a href="product.php?category=MEN&subcategory=bag">Bags</a>
                                </li>
                                <li style="display: block;"><a
                                        href="product.php?category=MEN&subcategory=shoes">Shoes</a></li>
                                <li style="display: block;"><a href="product.php?category=MEN&subcategory=hat">Hat</a>
                                </li>
                                <li style="display: block;"><a
                                        href="product.php?category=MEN&subcategory=shirt">Shirt</a></li>
                                <li style="display: block;"><a href="product.php?category=MEN&subcategory=belt">Belt</a>
                                </li>
                                <li style="display: block;"><a
                                        href="product.php?category=MEN&subcategory=trousers">Trousers</a>
                                </li>
                                <li style="display: block;"><a
                                        href="product.php?category=MEN&subcategory=watch">Watch</a></li>
                            </ul>
                        </div>
                        <div
                            style="width: 170px;text-align: left;display: flex; flex-direction: column;justify-content: space-between;">
                            <img style="width: 100%;height: 150px;"
                                src="../public/img/menu_bar/48304b6ed710518bad6baaef95a62147.jpg" alt="beauty.jpg">
                            <img style="width: 100%;height: 150px;"
                                src="../public/img/menu_bar/961df29d38bda27dfe0a902c753244c8.jpg" alt="beauty.jpg">
                        </div>
                        <img style="width: 330px;display: block;"
                            src="../public/img/menu_bar/9eca41667d10faedb11f962f8c4234b9.jpg" alt="women1.jpeg">
                        <div class="right_column">
                            <h4>REFINED</h4>
                            <p>From accessories like belts and watches to clothing like shirts and trousers, they cater
                                to diverse needs and occasions. Perfect for enhancing everyday looks or elevating a
                                polished appearance.</p>
                        </div>
                    </div>
                </li> -->
                <li class="menu_item"><a href="">Other</a>
                    <div class="hover_content">
                        <img style="width: 300px;" src="/unitop-php/fashionweb/public/img/menu_bar/beauty.jpg" alt="beauty.jpg">
                        <div class="left_column">
                            <h4>BEAUTY</h4>
                            <ul>
                                <li style="display: block;">Lipsticks</li>
                                <li style="display: block;">Lip Balms</li>
                                <li style="display: block;">Face</li>
                                <li style="display: block;">Skincare</li>
                                <li style="display: block;">Eyes</li>
                                <li style="display: block;">Brushes and Accessories</li>
                            </ul>
                        </div>
                        <img style="width: 330px;display: block;"
                            src="/unitop-php/fashionweb/public/img/menu_bar/z6060201879885_53510a860588dc9c3c9497faa904c390.jpg"
                            alt="beauty.jpg">
                        <div>
                            <img style="width: 150px;display: block;margin-bottom: 11px;"
                                src="/unitop-php/fashionweb/public/img/menu_bar/pexels-photo-1190829.webp" alt="beauty.jpg">
                            <img style="width: 150px;display: block; height:200px"
                                src="/unitop-php/fashionweb/public/img/menu_bar/pexels-photo-965990.webp" alt="beauty.jpg">
                        </div>
                        <div class="right_column">
                            <h4>FRAGRANCES</h4>
                            <ul>
                                <li style="display: block;">View Purchase History
                                    <!-- <a style=' padding: 0 !important;font-family: "Montserrat", sans-serif !important;font-size: 13px !important;font-weight: 400 !important;width: fit-content !important; color: #000;' href="../modules/purchase_history.php">View Purchase History

                                    </a> -->
                                </li>
                                <!-- <li style="display: block;"><a style=' padding: 0 !important;font-family: "Montserrat", sans-serif !important;font-size: 13px !important;font-weight: 400 !important;width: fit-content !important; color: #000;' href="../modules/discover.php">Discover More</a></li> -->

                                <!-- <li style="display: block;">Exclusive Collections</li> -->
                                <li style="display: block;">Women's Fragrances</li>
                                <li style="display: block;">Men's Fragrances</li>
                            </ul>
                        </div>
                    </div>
                </li>
                <!-- <li><a href="../modules/blog.php">Blog</a></li> -->


                <li id="open_card_contact"><a href="#">Contact</a></li>
                <script>
                    // ================================= CONTACT US =================================
                    const openCardContact = document.getElementById('open_card_contact')
                    const cardContact = document.getElementById('sidecard_contact')
                    const closeBtnCardContact = document.getElementById('close_btn_contact')
                    const backdropContact = document.querySelector('.backdropContact')

                    openCardContact.addEventListener('click', openCard)
                    closeBtnCardContact.addEventListener('click', closeCard)
                    backdropContact.addEventListener('click', closeCard)

                    //Open Card
                    function openCard() {
                        cardContact.classList.add('open')
                        backdropContact.style.display = 'block'

                        setTimeout(() => {
                            backdropContact.classList.add('show')
                        }, 0)
                    }

                    //Close Cart
                    function closeCard() {
                        cardContact.classList.remove('open')
                        backdropContact.classList.remove('show')

                        setTimeout(() => {
                            backdropContact.style.display = 'none'
                        }, 500);
                    }
                </script>

            </ul>
            <?php
                if (isset($_POST['search_button']))
                {
                    header("Location: ../modules/product.php?category=GIFT&subcategory=bag");
                }
            ?>
            <form action="" method="POST" style="display: flex;
    align-self: center;
    justify-self: center;
    align-items: center;
    min-width: 370px;
    height: 40px;
    margin-left: 100px;">
            <div id="search_bar">
                 
                <input type="text" name="search_input" placeholder="Search..." id="search_input" style="color:#fff">
                <button id="search_button" name="search_button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            </form>

            <ul id="side_menu_bar"
                style="width: 80px; display: flex; justify-content: space-between; align-items: center;">
                <li>
                    <!-- Open Btn -->
                    <button style="position: relative;" id="open_cart_btn">
                        <img src="/unitop-php/fashionweb/public/img/shop-cart-white.png" alt="shop-cart"
                            style="width:19px; height:19px ;color: #000;">
                        <span
                            style="position: absolute;top: -5px;font-size: 12px;color:#fff"><?php echo $quantity_carts ?></span>
                    </button>
                    <script>
                        // ================================= SHOPPING CART =================================
                        const openBtn = document.getElementById('open_cart_btn')
                        const cart = document.getElementById('sidecart')
                        const closeBtnCart = document.getElementById('close_btn')
                        const backdrop = document.querySelector('.backdrop')
                        // const itemEl = document.querySelector('.items')

                        openBtn.addEventListener('click', openCart)
                        closeBtnCart.addEventListener('click', closeCart)
                        backdrop.addEventListener('click', closeCart)

                        //Open Cart
                        function openCart() {
                            cart.classList.add('open')
                            backdrop.style.display = 'block'

                            setTimeout(() => {
                                backdrop.classList.add('show')
                            }, 0)
                        }

                        //Close Cart
                        function closeCart() {
                            cart.classList.remove('open')
                            backdrop.classList.remove('show')

                            setTimeout(() => {
                                backdrop.style.display = 'none'
                            }, 500);
                        }
                    </script>
                </li>
                
                <li class="side_menu_user">
                    <i style="width:19px; vertical-align:middle; margin:1px 5px 0 0; color: #fff;"
                        class="fa-regular fa-user"></i>

                    <div class="hover_content_user">
                        <div class="user_active_infor">
                            <?php $user_img_none="/unitop-php/fashionweb/public/img/account/user.png" ?>
                            <img src="<?php if (!empty($img_user_active)) echo "../public/img/account/".$img_user_active;
                                            else echo $user_img_none ?>" alt="img_user_active">
                            <p><?php echo $account_type_active ?></p>
                            <h4><?php echo $username_active ?></h4>
                        </div>
                        <hr style="border: none;background: #00000030;height: 0.5px;width: 100%;">
                        <div class="other_options">
                            <?php
                            if ($account_type_active != "User") {
                                ?>
                                <a href="<?php
                                if ($account_type_active == "Admin") {
                                    echo "../modules/admin_panel_admin/admin.php";
                                } else {
                                    echo "../modules/admin_panel_staff/products_management.php";
                                }
                                ?>" style='color: #fff; font-family: "Montserrat", sans-serif;'><?php //echo $account_type_active . " "; ?>Administration</a>
                                <?php
                            }
                            ?>
                            <a href="../modules/logout.php" style='color: #fff; font-family: "Montserrat", sans-serif;'>Log Out</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!-- end header -->

        <!-- <script defer src="../public/js/header.js"></script> -->
