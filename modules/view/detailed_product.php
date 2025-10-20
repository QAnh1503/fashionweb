<?php
// require "../inc/header.php";
session_start();
ob_start();
require "../../db/connect.php";
require "../../db/database.php";
?>
<?php
$act = $_GET['slug'];
$list_product_details = array();


$id = $_GET['id'];
$list_product_details = db_fetch_array("SELECT * FROM product");


$product_details = array();
foreach ($list_product_details as $product) {
    if ($product['product_id'] == $id) {
        $product_details = $product;
        break;
    }
}

$img_path = "../../public/img/";
if ($product_details['subcategory'] == "Bag") {
    $img_path .= "bags/";
} else if ($product_details['subcategory'] == "Shoes") {
    $img_path .= "shoes/";
} else if ($product_details['subcategory'] == "Hat") {
    $img_path .= "hat/";
} else if ($product_details['subcategory'] == "Belt") {
    $img_path .= "belt/";
} else if ($product_details['subcategory'] == "Shirt") {
    $img_path .= "shirt/";
}
$img_path .= $product_details['product_image_1'];





$list_array = db_fetch_array("SELECT *FROM product");
$num_rows = db_num_rows("SELECT * FROM product");

$ids = array();
$list_items_cart = db_fetch_array("SELECT * FROM cart_items");
$user_id_active = 0;
$cart_id_active = 0;
$status_cart="";
$tbl_users = db_fetch_array("SELECT * FROM tbl_users");
$tbl_carts = db_fetch_array("SELECT * FROM carts");
foreach ($tbl_users as $item) {
    if ($item['email'] == $_SESSION['email_login']) {
        $user_id_active = $item['user_id'];
    }
}
// echo "User Id Active: " . $user_id_active;
// if ($cart_id_active == 0) { // user has no cart yet
//     $dataCarts = array(
//         'user_id' => $user_id_active,
//     );
//     db_insert("carts", $dataCarts);

//     // fetch the new cart_id
//     $cart_id_active = db_fetch_row("SELECT cart_id FROM carts WHERE user_id='{$user_id_active}'")['cart_id'];
// }
// Check if user already has a cart
$cart = db_fetch_row("SELECT cart_id FROM carts WHERE user_id = '{$user_id_active}' LIMIT 1");

if (!$cart) {
    // If no cart exists, create one
    $dataCarts = array(
        'user_id' => $user_id_active,
    );
    db_insert("carts", $dataCarts);

    // Get the new cart_id
    $cart_id_active = db_fetch_row("SELECT cart_id FROM carts WHERE user_id = '{$user_id_active}'")['cart_id'];
} else {
    // If cart exists, use it
    $cart_id_active = $cart['cart_id'];
}
// echo "Cart Id Active: " . $cart_id_active;

$list_items_cart = db_fetch_array("SELECT * FROM cart_items where cart_id={$cart_id_active}");
if (empty($list_items_cart))
{
    echo "List_items_cart is Empty !!!";
}

if (isset($_POST['add_to'])) {
    // $ids = array_column($list_items_cart, 'id');
    foreach ($list_items_cart as $cart) {
        $ids[] = $cart['cart_item_id']; // dùng đúng cột
    }
    if (!empty($list_items_cart) && $status_cart!="Checkout")
    {
        $dateUpdate= date('Y-m-d');
        $dataDate= array(
            'update_at' => $dateUpdate
        );
        if (!in_array($_GET['id'], $ids)) {
            // $data = array(
            //     'id' => $product_details['id'],
            //     'cart_id' => $cart_id_active,
            //     'name' => $product_details['name'],
            //     'category' => $product_details['category'],
            //     'subcategory' => $product_details['subcategory'],
            //     'variant' => $product_details['variant'],
            //     'price' => $product_details['price'],
            //     // 'color' => $product_details['color'],
            //     'description' => $product_details['description'],
            //     'product_image_1' => $product_details['product_image_1'],
            //     'product_image_2' => $product_details['product_image_2'],
            //     'quantity' => 1
            // );
            $data = array(
                'cart_id' => $cart_id_active,
                'product_id' => $product_details['product_id'],
                'quantity' => 1
            );

            $id_insert = db_insert("cart_items", $data);
            // db_update('carts', $dataDate, "cart_id={$cart_id_active}");
        }
        else {
            foreach ($list_items_cart as $cart)
            {
                if ($id == $cart['product_id'])
                {
                    $cart_qty= $cart['quantity']+1;
                    $data= array (
                        'quantity'=> $cart_qty
                    );
                    // $dateUpdate= date('Y-m-d', strtotime($raw_date));
                    // $dataDate= array(
                    //     'update_at' => $dateUpdate
                    // );
                    // db_update('cart_items', $data, "product_id={$id} AND cart_id={$cart_id_active}");
                    // db_update('carts', $dataDate, "cart_id={$cart_id_active}");
                    break;
                }
            }
        }
    }
    else
    {
        $dataCarts= array(
            'user_id' => $user_id_active,
        );
        db_insert("carts", $dataCarts);
        $cart_id=0;
        $carts= db_fetch_array("SELECT * FROM carts where user_id= '{$user_id_active}'");
        foreach ($carts as $item)
        {
            if ($item['user_id']== $user_id_active)
            {
                $cart_id= $item['cart_id'];
            }
        }
        echo  " $cart_id : ".$cart_id;

        // $data = array(
        //     'id' => $product_details['product_id'],
        //     'cart_id' => $cart_id,
        //     'name' => $product_details['name'],
        //     'category' => $product_details['category'],
        //     'subcategory' => $product_details['subcategory'],
        //     'variant' => $product_details['variant'],
        //     'price' => $product_details['price'],
        //     // 'color' => $product_details['color'],
        //     'description' => $product_details['description'],
        //     'product_image_1' => $product_details['product_image_1'],
        //     'product_image_2' => $product_details['product_image_2'],
        //     'quantity' => 1
        // );
        $data = array(
            'cart_id' => $cart_id,
            'product_id' => $product_details['product_id'],
            'quantity' => 1
        );
        $id_insert = db_insert("cart_items", $data);        
    }
    // if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    //     $session_cart_id = array_column($_SESSION['cart'], "id");
    //     if (!in_array($_GET['id'], $session_cart_id)) {
    //         $session_cart = array(
    //             'id' => $product_details['id'],
    //             'name' => $product_details['name'],
    //             'price' => $product_details['price'],
    //             'category' => $product_details['category'],
    //             'subcategory' => $product_details['subcategory'],
    //             'color' => $product_details['color'],
    //             'status' => "AVAILABLE",
    //             'description' => $product_details['description'],
    //             '`product_image_1`' => $product_details['product_image_1'],
    //             'quantity' => 1
    //         );
    //         $_SESSION['cart'][] = $session_cart;
    //     } else {
    //         foreach ($_SESSION['cart'] as &$value) 
    //         {
    //             if ($value['id'] == $_GET['id']) {
    //                 $value['quantity'] += 1;
    //                 break;
    //             }
    //         }
    //         unset($value);
    //     }
    // } else {
    //     $session_cart = array(
    //         'id' => $product_details['id'],
    //         'name' => $product_details['name'],
    //         'price' => $product_details['price'],
    //         'category' => $product_details['category'],
    //         'subcategory' => $product_details['subcategory'],
    //         'color' => $product_details['color'],
    //         'status' => "AVAILABLE",
    //         'description' => $product_details['description'],
    //         '`product_image_1`' => $product_details['product_image_1'],
    //         'quantity' => 1
    //     );
    //     $_SESSION['cart'][] = $session_cart;
    // }
}
// require 'header.php';
require 'side_cart.php';
// foreach ($list_carts as $cart)
// {
//     $quantity_carts += $cart['quantity'];
// }
$quantity_carts = 0;
if (!empty($list_carts) && is_array($list_carts)) {
    foreach ($list_carts as $cart) {
        $quantity_carts += $cart['quantity'];
    }
}
require "../../inc/header.php";
?>


<!-- Link Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Link Ionicons CDN -->
<script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- Link Font Awesome -->
<script src="https://kit.fontawesome.com/16d8c86832.js" crossorigin="anonymous"></script>
<!-- Linking SwiperJS CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<link rel="stylesheet" href="../../public/css/detailed_product.css" type="text/css">

<!-- ============================================ MAIN ============================================-->
<div class="product_infor">

    <!-- ================ above_part ================ -->
    <div id="above_part">
        <div id="img_collage">

            <img src="../../public/img/<?php
            if ($product_details['subcategory'] == "Bag") {
                echo "bags/";
            } else if ($product_details['subcategory'] == "Shoes") {
                echo "shoes/";
            } else if ($product_details['subcategory'] == "Hat") {
                echo "hat/";
            } else if ($product_details['subcategory'] == "Belt") {
                echo "belt/";
            } else if ($product_details['subcategory'] == "Shirt") {
                echo "shirt/";
            }
            echo $product_details['product_image_1'];
            ?>" alt="<?php echo $product_details['product_image_1'] ?>">

            <img src="../../public/img/<?php
            if ($product_details['subcategory'] == "Bag") {
                echo "bags/";
            } else if ($product_details['subcategory'] == "Shoes") {
                echo "shoes/";
            } else if ($product_details['subcategory'] == "Hat") {
                echo "hat/";
            } else if ($product_details['subcategory'] == "Belt") {
                echo "belt/";
            } else if ($product_details['subcategory'] == "Shirt") {
                echo "shirt/";
            }
            echo $product_details['product_image_2'];
            ?>" alt="<?php echo $product_details['product_image_2'] ?>">
        </div>
    </div>
    <!-- ================ img_content of above_part ================ -->
    <div class="img_content">
        <h3><?php echo $product_details['name'] ?></h3>
        <strong><span style="display:block; margin-bottom: 13px; color: #000; font-size:18px">
                <?php echo number_format($product_details['price'], 0, '.', ',')." VND" ?></span>
        </strong>
        <!-- <select class="color" name="color" id="color">
            <option value="black" selectd="selected">black leather</option>
            <option value="white">white leather</option>
            <option value="red">red leather</option>
            <option value="beige">beige leather</option>
            <option value="pink">pink leather</option>
        </select> -->
        <p style="margin-bottom:5px"><i style="font-size:11px" class="fa-solid fa-circle"></i> Black Leather</p>

        <span id="personalize">Personalize with initials</span>
        <p id="status">AVAILABLE</p>
        <p>Enjoy complimentary delivery or Collect In Store.</p>
        <form action="" method="POST">
            <input class="add_to" type="submit" name="add_to" value="ADD TO SHOPPING BAG" id="add_to_cart_btn">
        </form>
        <!-- <span class="shop_this">SHOP THIS</span> -->
    </div>

    <!-- ================ below_part ================ -->
    <style>
        /* Modal styling */
        .modal {
            display: none;
            /* Ẩn đi khi chưa kích hoạt */
            position: fixed;
            z-index: 3;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        .modal-contain {
            position: relative;
            background-color: white;
            padding: 50px 10px 30px 10px;
            /* border-radius: 8px; */
            /* width: 85%; */
            max-width: 800px;
            height: auto;
        }

        .close {
            position: absolute;
            width: 23px;
            height: 23px;
            top: 17px;
            right: 20px;
            cursor: pointer;
        }

        .modal-content {
            width: 100%;
            text-align: center;
            justify-items: center;
        }

        .modal-content img {
            margin-top: 20px;
            width: 48px;
            height: 50px;
        }

        .modal-content h3 {
            font-size: 16px;
            margin: 25px 0 60px 0;
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 600;
            font-style: normal;
        }

        .modal-content p {
            color: #000;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
            font-size: 14px;
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            margin-bottom: 20px;
        }

        .modal-content a {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            text-decoration: underline;
            color: #000;
        }
    </style>
    <div class="modal">
        <div class="modal-contain">
            <img src="../public/img/close.png" alt="X" class="close">
            <!-- <i class="close fas fa-times"></i> -->
            <div class="modal-content">
                <!-- <span class="close">X</span> -->
                <img src="../public/img/worldwide.png" alt="worldwide.png">
                <h3>OUR COMMITMENT</h3>
                <p>Gucci upholds the highest international standards of social and environmental responsibility
                    across all its operations. From selecting and tracing raw materials to designing and
                    crafting
                    our products, we prioritize a "circular" approach that maintains our longstanding commitment
                    to
                    unparalleled quality and durability.</p>
                <p>Through ongoing innovation and optimization of our production processes, we strive to
                    minimize
                    the environmental footprint of our business and the entire supply chain. Our approach
                    involves
                    transforming our sourcing strategy by investing in regenerative agriculture projects for the
                    production of the raw materials used in our collections. To compensate for any remaining
                    emissions from our direct operations and the entire supply chain, we collaborate with
                    different
                    partners, investing in projects focused on conserving nature and restoring biodiversity.</p>
                <p>For more information, please visit</p>
                <a href="#">@stylesheeker.com</a>
            </div>
        </div>
    </div>

    <div id="below_part" style="padding: 40px;margin-bottom: 150px;background: #fff;">
        <h2>PRODUCT DETAILS</h2>
        <div id="detailed_more">
            <div>
                <h3>ID: <?php echo $product_details['product_id'] ?></h3>
                <div class="detailed_content">
                    <p style="color:#000"><?php echo $product_details['description'] ?></p>
                    <div class="accordion">
                        <div class="accordion-item" style="max-width: 1200px;">
                            <button class="accordion-header">
                                MATERIALS AND CARE
                                <span class="accordion-icon">+</span>
                            </button>
                            <div class="accordion-content">
                                <ul>Style Seeker products are made with carefully selected materials. Please
                                    handle with care for longer product life.
                                    <li>Protect from direct light, heat and rain. Should it become wet, dry it
                                        immediately with a soft cloth</li>
                                    <li>Fill the bag with tissue paper to help maintain its shape and absorb
                                        humidity, and store in the provided flannel bag</li>
                                    <li>Do not carry heavy products that may affect the shape of the bag</li>
                                    <li>Clean with a soft, dry cloth</li>
                                </ul>
                            </div>
                        </div>

                        <div class="accordion-item" style="max-width: 1200px;">
                            <button class="accordion-header">
                                SHIPPING & RETURNS INFO
                                <span class="accordion-icon">+</span>
                            </button>
                            <div class="accordion-content" style="margin-bottom: 10px;">
                                <div class="first-part">
                                    <h4>Shipping</h4>
                                    <p style="font-size: 13px;color:#000">Holiday shipping: if you place your order by
                                        December 23rd at 1PM EST you
                                        will receive your item by December 24th with both ship to home and
                                        Collect In-Store.</p>
                                    <p style="font-size: 13px;color:#000">A signature will be required upon delivery.
                                    </p>
                                    <p style="font-size: 13px;color:#000">Pre-order, Made to Order items will ship on
                                        the
                                        estimated date noted on
                                        the product description page. These items will ship through Premium
                                        Express once they become available.</p>
                                </div>
                                <div class="second-part">
                                    <h4>Returns</h4>
                                    <p style="font-size: 13px;color:#000">Extended returns for the holiday season.
                                        Orders
                                        placed from November 1 to
                                        January 1 will include extended complimentary returns until January 31.
                                    </p>
                                    <p style="font-size: 13px;color:#000">Returns may be made by mail or in store. You
                                        may
                                        return items by
                                        selecting"Return this Item" from your MY StyleSeeker account under order
                                        details, through your delivery confirmation email or by contacting a
                                        Client Advisor. Once the request has been approved, your prepaid
                                        shipping label will be emailed to you or will be available for download
                                        in your MY STYLESEEKER account.</p>
                                    <p style="font-size: 13px;color:#000">For Collect-In-Store order, we offer a 30 day
                                        return/exchange window
                                        in-store or by contacting Client Services. The return window starts on
                                        the day when your item was made available for collection.</p>
                                    <p style="font-size: 13px;color:#000">Items must remain in their original condition
                                        with all labels attached
                                        and intact. Please note, Made to Order and personalized items are not
                                        returnable.</p>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" style="max-width: 1200px;">
                            <button class="accordion-header">
                                PAYMENT OPTIONS
                                <span class="accordion-icon">+</span>
                            </button>
                            <div class="accordion-content">
                                <p style="font-size: 13px;color:#000">STYLESEEKER accepts the following forms of payment
                                    for online purchases:</p>
                                <div class="payments">
                                    <table>
                                        <tr>
                                            <td><img src="../public/img/payment/visa.png" alt="Visa">Visa</td>
                                            <td><img src="../public/img/payment/Amazon Pay.jpg" alt="Amazon Pay">Amazon
                                                Pay</td>
                                        </tr>
                                        <tr>
                                            <td><img src="../public/img/payment/TPBank.png" alt="TP Bank">TP
                                                Bank</td>
                                            <td><img src="../public/img/payment/MB.jpg" alt="MB Bank">MB Bank
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><img src="../public/img/payment/Apple Pay.jpg" alt="Apple Pay">Apple Pay
                                            </td>
                                            <td><img src="../public/img/payment/JCB.jpg" alt="JCB">JCB</td>
                                        </tr>
                                        <tr>
                                            <td><img src="../public/img/payment/MasterCard.jpg"
                                                    alt="MasterCard">MasterCard</td>
                                            <td><img src="../public/img/payment/Vietcombank.jpg"
                                                    alt="Vietcombank">Vietcombank</td>
                                        </tr>
                                        <tr>
                                            <td><img src="../public/img/payment/Agribank.jpg" alt="Agribank">Agribank
                                            </td>
                                            <td><img src="../public/img/payment/american-expresswebp.jpg"
                                                    alt="American Express">American Express</td>
                                        </tr>
                                    </table>
                                </div>
                                <p style="font-size: 13px;color:#000">New: Shop on Gucci.com with monthly payments.</p>
                                <p style="font-size: 13px;color:#000">PayPal may not be used to purchase Made to Order
                                    Décor or DIY items.</p>
                                <p style="font-size: 13px;color:#000">The full transaction value will be charged to your
                                    credit card after we have
                                    verified your card details, received credit authorisation, confirmed
                                    availability and prepared your order for shipping. For Made To Order, DIY,
                                    personalised and selected Décor products, payment will be taken at the time
                                    the order is placed.</p>
                                <p style="font-size: 13px;color:#000">For more information about payment, visit our FAQs
                                    Section.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="imgProd" style="max-width: 270px;margin-left: 40px;">
                <img style="width: 100%;height:100%" src="../../public/img/<?php
                if ($product_details['subcategory'] == "Bag") {
                    echo "bags/";
                } else if ($product_details['subcategory'] == "Shoes") {
                    echo "shoes/";
                } else if ($product_details['subcategory'] == "Hat") {
                    echo "hat/";
                } else if ($product_details['subcategory'] == "Belt") {
                    echo "belt/";
                } else if ($product_details['subcategory'] == "Shirt") {
                    echo "shirt/";
                }
                echo $product_details['product_image_1'];
                ?>" alt="<?php echo $product_details['product_image_1'] ?>">

                <div class="commitment">
                    <img src="../../public/img/worldwide.png" alt="worldwide.png">
                    <span class="commitment" id="personalize">Our Commitment</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ================ like_more ================ -->
    <div id="like_more" style="background-color:#fff">
        <h2>You May Also Like</h2>

        <!-- ///// dont have db -->
        <!-- <div class="product_more">
                    <img style=" width: 400px; min-height: 500px;" src="../public/img/women's bag prada.avif" alt="image">
                    <div class="img_contents">
                        <h3>Gucci Jackie 1961 small shoulder bag</h3>
                        <span style="display:block; margin-bottom: 12px; color: #000; font-size:18px">$ 3.800</span>
                        <span class="shop_this">SHOP THIS</span>
                    </div>
                    <div class="add_to_favourites" onclick="toggleFavourite(this)">
                        <i class="fas fa-heart"></i>
                    </div>
                </div> -->

        <!-- Các nút Chevron -->
        <!-- <div class="chevron-back" onclick="slideProducts(-1)">
                    <ion-icon name="chevron-back-outline"></ion-icon>
                </div>
                <div class="chevron-forward" onclick="slideProducts(1)">
                    <ion-icon name="chevron-forward-outline"></ion-icon>
                </div> -->
        <!-- //// -->


        <div class="container swiper">
            <div class="card-wrapper">
                <div class="card-list swiper-wrapper" style="height: auto;">
                    <?php
                    //$index = $num_rows;
                    ?>
                    <?php
                    // for ($i = 1; $i <= $num_rows; $i++) {
                    //     if ($i == $id) {
                    //         $i++;
                    //     }
                    //     if ($i > $num_rows) {
                    //         break;
                    //     }
                    foreach ($list_array as $item) {
                        ?>
                        <div class="card-item swiper-slide">

                            <?php
                            $img_pathItem = "../../public/img/";
                            if ($item['subcategory'] == "Bag") {
                                $img_pathItem .= "bags/";
                            } else if ($item['subcategory'] == "Shoes") {
                                $img_pathItem .= "shoes/";
                            } else if ($item['subcategory'] == "Hat") {
                                $img_pathItem .= "hat/";
                            } else if ($item['subcategory'] == "Belt") {
                                $img_pathItem .= "belt/";
                            } else if ($item['subcategory'] == "Shirt") {
                                $img_pathItem .= "shirt/";
                            }
                            $img_pathItemAdd = $img_pathItem;
                            $img_pathItem .= $item['product_image_1'];
                            $img_pathItemAdd .= $item['product_image_2'];
                            ?>
                            <img src="<?php echo $img_pathItem ?>" alt="<?php echo $item['product_image_1'] ?>"
                                onmouseover="changeImage(this, '<?php echo $img_pathItemAdd ?>')"
                                onmouseout="resetImage(this, '<?php echo $img_pathItem ?>')">
                            <div class="img_contents">
                                <h3><?php echo $item['name'] ?></h3>
                                <span style="display:block; margin-bottom: 12px; color: #000; font-size:18px">
                                    <?php echo number_format($item['price'], 0, '.', ',')." VND" ?></span>
                                <a href="detailed_product.php?slug=<?php echo str_replace(' ', '-', $item['name']) ?>&id=<?php echo $item['product_id'] ?>"
                                    class="shop_this">SHOP THIS</a>
                            </div>

                            <div class="add_to_favourites" onclick="toggleFavourite(this)">
                                <i class="fas fa-heart"></i>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>

                <div class="swiper-pagination"></div>
                <div class="swiper-slide-button swiper-button-prev"></div>
                <div class="swiper-slide-button swiper-button-next"></div>

            </div>
        </div>

    </div>




    <!-- ============================================ FOOTER ============================================-->
    <style>
        .plus {
            position: relative;
        }

        .plus::before {
            position: absolute;
            content: "+";
            transition: all 0.5s ease;
            margin-left: -15px;
        }

        .plus:hover {
            transform: scale(1.02);
        }

        .plus:hover::before {
            animation: rotatePlus 1.5s ease forwards;
        }

        #terms_footer {
            display: flex;
            width: 100%;
            margin: 20px;
        }

        .column {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
            font-size: 14px;
            line-height: 40px;

            display: flex;
            flex-direction: column;
            /* Đặt hướng cột */
            text-align: left;
        }

        .column:nth-child(1) {
            width: 700px;
        }

        .column:nth-child(2) {
            width: 700px;
        }

        .column:nth-child(3) {
            width: 100%;
        }

        .row {
            font-size: 12px;
            cursor: pointer;
            color: #fff;
        }

        .main_row {
            font-weight: 600;
            color: dimgrey;
        }

        .under_span {
            position: relative;
        }

        .under_span::after {
            position: absolute;
            content: "";
            left: 0;
            bottom: 0;
            width: 100%;
            height: 0.9px;
            transition: transform 0.3s ease, opacity 0.3s ease;
            background-color: #fff;
            /* Màu gạch chân giống màu chữ */
            /* transform: translateY(5px);  */
            opacity: 1;
        }

        .under_span:hover::after {
            animation: disappear 0.5s ease;
        }

        @keyframes disappear {

            /* 0% { transform: translateX(0); opacity: 1; } 
                    50% { transform: translateX(10px); opacity: 0; }
                    100% { transform: translateX(10px); opacity: 0; }  */
            0% {
                transform: translateX(-10px);
                opacity: 0;
            }

            /* Bắt đầu ở bên trái và biến mất */
            50% {
                transform: translateX(10px);
                opacity: 0;
            }

            100% {
                transform: translateX(0);
                opacity: 1;
            }

            /* Về vị trí ban đầu và hiện lên */
        }

        @keyframes rotatePlus {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
    <div id="footer">
        <div id="content_footer">
            <p style="font-size: 15px; font-weight: bold;">SIGN UP FOR STYLESEEKER UPDATES</p>
            <p style="font-size: 28px; line-height: 45px;">Embrace the holiday spirit by exploring unique gifts
                and
                uncovering the latest news from the House.</p>
            <p class="plus" style="font-size: 12px;">Subscribe</p>
        </div>
        <div id="terms_footer">
            <div class="column">
                <div class="main_row">MAY WE HELP YOU?</div>
                <div class="row"><span class="under_span">Contact Us</span></div>
                <div class="row"><span class="under_span">My Order</span></div>
                <div class="row"><span class="under_span">Frequently Asked Question</span></div>
                <div class="row"><span class="under_span">Email Unsubscribe</span></div>
            </div>
            <div class="column">
                <div class="main_row">LEGAL TERMS AND CONDITIONS</div>
                <div class="row"><span class="under_span">Legal Notice</span></div>
                <div class="row"><span class="under_span">Privacy Policy</span></div>
                <div class="row"><span class="under_span">Cookie Policy</span></div>
                <div class="row"><span class="under_span">Cookie setting</span></div>
                <div class="row"><span class="under_span">Sitemap</span></div>
            </div>
            <div class="column">
                <style>
                    /* Modal styling */
                    .modal_footer {
                        display: none;
                        /* Ẩn đi khi chưa kích hoạt */
                        position: fixed;
                        z-index: 3;
                        left: 0;
                        top: 0;
                        width: 100%;
                        height: 100%;
                        background-color: rgba(0, 0, 0, 0.7);
                        justify-content: center;
                        align-items: center;
                    }

                    .modal_contain_footer {
                        position: relative;
                        background-color: #fff;
                        padding: 50px 20px 5px 20px;
                        /* border-radius: 8px; */
                        /* width: 85%; */
                        max-width: 800px;
                        height: auto;
                    }

                    .close_footer {
                        position: absolute;
                        width: 23px;
                        height: 23px;
                        top: 17px;
                        right: 20px;
                        cursor: pointer;
                    }

                    .modal_content_footer {
                        width: 100%;
                        /* text-align: center;
                            justify-items: center; */
                    }

                    .modal_content_footer h1 {
                        font-family: "Montserrat", sans-serif;
                        font-optical-sizing: auto;
                        font-weight: 650;
                        font-style: normal;
                        font-size: 13px;
                        color: #000;
                    }

                    .modal_content_footer a {
                        font-family: "Montserrat", sans-serif;
                        font-optical-sizing: auto;
                        font-weight: 500;
                        text-decoration: underline;
                        color: #000;
                        font-size: 11px;
                        display: block;
                        width: max-content;
                        /* Đảm bảo thẻ a có kích thước vừa với nội dung */
                        margin: 10px auto 0;
                    }
                </style>
                <div class="modal_footer">
                    <div class="modal_contain_footer">
                        <img src="../public/img/close.png" alt="X" class="close_footer">
                        <div class="modal_content_footer">
                            <h1>STORE LOCATOR</h1>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.7339261719544!2d108.25065207365358!3d15.975265441949487!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2sVietnam%20-%20Korea%20University%20of%20Information%20and%20Communication%20Technology!5e0!3m2!1sen!2s!4v1731247311289!5m2!1sen!2s"
                                width="600" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                            <a href="#">@stylesheeker.com</a>
                        </div>
                    </div>
                </div>
                <div class="main_row">STORE LOCATOR
                    <style>
                        .locator {
                            width: 92%;
                            cursor: pointer;
                            margin-bottom: 30px;
                        }

                        .detailed_locator {
                            width: 100%;
                            height: 30px;
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                        }

                        .locate {
                            font-family: "Montserrat", sans-serif;
                            font-optical-sizing: auto;
                            font-weight: 400;
                            font-style: normal;
                        }

                        .detailed_locator .material-symbols-outlined {
                            color: #fff;
                            font-size: 18px;
                        }

                        .locator hr {
                            width: 100%;
                            border: none;
                            height: 0.1px;
                            background-color: #999;
                            opacity: 0.7;
                            background-color: #fff;
                            margin: 0;
                        }

                        .locator p {
                            width: 100%;
                            text-align: justify;
                            font-weight: 400;
                            font-size: 11.5px;
                            font-family: "Poppins", sans-serif;
                            line-height: 13px;
                            color: #fff;
                        }

                        .detailed_locator .fa-regular {
                            color: #fff;
                            margin-right: 3px;
                            font-size: 15px;
                        }
                    </style>
                    <div class="locator">
                        <div class="detailed_locator">
                            <span class="locate">470 Tran Dai Nghia Street, Hoa Hai, Ngu Hanh Son, Da
                                Nang</span>
                            <span class="material-symbols-outlined">
                                chevron_forward
                            </span>
                        </div>
                        <hr>
                    </div>
                </div>

                <div class="main_row">SIGN UP FOR STYLESEEKER UPDATES
                    <div style="cursor:unset" class="locator">
                        <p>You will consent to receiving our newsletter with access
                            to our latest collections, events and initiatives. More details on this are provided
                            in
                            our
                            Privacy Policy.</p>
                        <div class="detailed_locator">
                            <span class="locate">nguyenhuuquynhanh2@gmail.com</span>
                            <!-- <span class="material-symbols-outlined">
                                    mail
                                </span> -->
                            <!-- <i class="fa-regular fa-envelope"></i> -->
                            <i class="fa-regular fa-paper-plane"></i>
                            <!-- <span class="material-symbols-outlined">
                                    chevron_forward
                                </span> -->
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="main_row">COUNTRY/REGION
                    <div style="cursor:unset" class="locator">
                        <div class="detailed_locator">
                            <span class="locate">VIET NAM</span>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <p>© 2016 - 2022 Guccio Gucci S.p.A. - All rights reserved. SIAE LICENCE # 2294/I/1936 and 5647/I/1936
        </p>
    </div>
</div>

<!-- Linking SwiperJS script -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- Linking custom script -->
<script src="../public/js/detailed_product.js"></script>
<!-- <script>
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
        </script> -->
</div>
</body>
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

</html>