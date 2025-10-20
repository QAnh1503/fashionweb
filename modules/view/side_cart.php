<?php

// $slug = "home";
// $id = "";
// if (!empty($_GET['slug']) && !empty($_GET['id'])) {
//     $slug = $_GET['slug'];
//     $id = $_GET['id'];
// }

// if (isset($_POST['removeBtnAll'])) {
//     // unset($_SESSION['cart']);
//     db_delete_table('cart_items');
// }



// // GET DATA FROM CART ITEMS


// // echo "SESSION: " . $_SESSION['email_login'];
// $user_id_active = 0;
// $cart_id_active = 0;
// $status_cart="";
// $tbl_users = db_fetch_array("SELECT * FROM `tbl_users`");
// $tbl_carts = db_fetch_array("SELECT * FROM `carts`");
// foreach ($tbl_users as $item) {
//     if ($item['email'] == $_SESSION['email_login']) {
//         $user_id_active = $item['account_id'];
//     }
// }
// // echo "User Id Active: " . $user_id_active;
// foreach ($tbl_carts as $item) {
//     if ($item['user_id'] == $user_id_active) {
//         $cart_id_active = $item['cart_id'];
//         $status_cart=$item['status'];
//     }
// }
// // echo "Cart Id Active: " . $cart_id_active;

// $list_carts= array();
// $num_row_carts=array();
// $quantity_carts= 0;
// if ($status_cart=="Active")
// {
//     $list_carts= db_fetch_array("SELECT * FROM `cart_items` where `cart_id`={$cart_id_active}");
//     $num_row_carts= db_num_rows("SELECT * FROM `cart_items` where `cart_id`={$cart_id_active}");
    
//     foreach ($list_carts as $cart)
//     {
//         $quantity_carts += $cart['quantity'];
//     }
// }

?>

<link rel="stylesheet" href="../../public/css/side_cart.css">


<!-- Backdrop -->
<div class="backdrop"></div>

<!-- Side Cart -->
<div id="sidecart" class="sidecart">
    <div class="cart_content">
        <!-- Cart Header-->
        <div class="cart_header">
            <img src="../../public/img/shop-cart.png" alt="">
            <div class="header_title">
                <h2>YOUR SHOPPING BAG</h2>
                <?php
                // $items_num = 0;
                // if (!empty($_SESSION['cart'])) {
                //     foreach ($_SESSION['cart'] as $key) {
                //         $items_num++;
                //     }
                // }
                ?>
                <span id="items_num"><?php echo $quantity_carts ?></span>
            </div>
            <span id="close_btn" class="close_btn">&times;</span>
        </div>

        <!-- Cart Items -->
        <?php
        $output = "";
        $output .= "<div class='cart_items'>";

        // if (!empty($_SESSION['cart'])) {
        //     foreach ($_SESSION['cart'] as $key => $value) {
        //         $img_pathItem = "../public/img/";
        //         if ($value['subcategory'] == "Bag") {
        //             $img_pathItem .= "bags/";
        //         } else if ($value['subcategory'] == "Shoes") {
        //             $img_pathItem .= "shoes/";
        //         } else if ($value['subcategory'] == "Hat") {
        //             $img_pathItem .= "hat/";
        //         } else if ($value['subcategory'] == "Belt") {
        //             $img_pathItem .= "belt/";
        //         } else if ($value['subcategory'] == "Shirt") {
        //             $img_pathItem .= "shirt/";
        //         }
        //         $img_pathItem .= $value['`product-image-1`'];

        //         $output .= "
        //         <div class='cart_item'>
        //             <div class='remove_item'>
        //                 <form action='' method='POST'>
        //                     <!-- <input type='submit' name=''> -->
        //                     <button class='removeBtn' name='removeBtn'><a href='action/remove.php?slug=" . $slug . "&id=" . $id . "&id_product=" . $value['id'] . "'>x</button>
        //                 </form>
        //                 </a>
        //             </div>
        //             <div class='item_img'>
        //                 <img src='" . $img_pathItem . "' alt='" . $value['name'] . "'>
        //             </div>
        //             <div class='item_details'>
        //                 <p style='font-size:12px; line-height:19px; margin-bottom:10px; font-weight:600; text-transform: uppercase;'>" . $value['name'] . "</p>
        //                 <p style='color:#000; font-size:17px'>$" . number_format($value['price']) . "</p>
        //                 <p style='margin-top: 6px;'>Style: " . $value['id'] . "</p>  
        //                 <!-- <div class='qty'>
        //                     <span>-</span>
        //                     <strong>1</strong>
        //                     <span>+</span>
        //                 </div> -->
        //                 <p>Quantity: " . $value['quantity'] . "</p>
                        
        //             </div>
        //         </div>
        //         ";
        //     }
        //     $output .= " 
        //         <div>
        //             <form action='' method='POST'>
        //                 <input class='removeBtnAll' type='submit' name='removeBtnAll' value='Clear All'> 
        //             </form>
        //         </div>
        //     </div>";

        //     if (!empty($_SESSION['cart'])) {
        //         echo $output;
        //     } else {
        //         $output = "<div class='cart_items'>
        //                     <p class='empty_cart'>Your shopping bag is empty !</p>
        //                     </div>
        //                     ";
        //         echo $output;
        //     }
        // }
        if (!empty($list_carts)) {
            
            foreach ($list_carts as $value) {
                $img_pathItem = "../public/img/";
                if ($value['subcategory'] == "Bag") {
                    $img_pathItem .= "bags/";
                } else if ($value['subcategory'] == "Shoes") {
                    $img_pathItem .= "shoes/";
                } else if ($value['subcategory'] == "Hat") {
                    $img_pathItem .= "hat/";
                } else if ($value['subcategory'] == "Belt") {
                    $img_pathItem .= "belt/";
                } else if ($value['subcategory'] == "Shirt") {
                    $img_pathItem .= "shirt/";
                }
                $img_pathItem .= $value['product_image_1'];

                $output .= "
                <div class='cart_item'>
                    <div class='remove_item'>
                        <form action='' method='POST'>
                            <!-- <input type='submit' name=''> -->
                            <button class='removeBtn' name='removeBtn'><a href='action/remove_cart.php?slug=" . $slug . "&id=" . $id . "&id_product=" . $value['id'] . "'>x</button>
                        </form>
                        </a>
                    </div>
                    <div class='item_img'>
                        <img src='" . $img_pathItem . "' alt='" . $value['name'] . "'>
                    </div>
                    <div class='item_details'>
                        <p style='font-size:12px; line-height:19px; margin-bottom:10px; font-weight:600; text-transform: uppercase;'>" . $value['name'] . "</p>
                        <p style='color:#000; font-size:17px'>$" . number_format($value['price']) . "</p>
                        <p style='margin-top: 6px;'>Style: " . $value['id'] . "</p>  
                        <!-- <div class='qty'>
                            <span>-</span>
                            <strong>1</strong>
                            <span>+</span>
                        </div> -->
                        <p>Quantity: " . $value['quantity'] . "</p>
                        
                    </div>
                </div>
                ";
            }
            $output .= " 
                <div>
                    <form action='' method='POST'>
                        <input class='removeBtnAll' type='submit' name='removeBtnAll' value='Clear All'> 
                    </form>
                </div>
            </div>";

            if (!empty($list_carts)) {
                echo $output;
            } else {
                $output = "<div class='cart_items'>
                            <p class='empty_cart'>Your shopping bag is empty !</p>
                            </div>
                            ";
                echo $output;
            }
        }

        else {
            $output .= "<p class='empty_cart'>Your shopping bag is empty !</p>
            </div>
            ";
            echo $output;
        }
        ?>
       
        <!-- Cart Actions -->
        <div class="cart_actions">
            <div class="subtotal">
                <p style="color: #000;">SUBTOTAL</p>
                <p style="color: #000;">$<span id="subtotal_price">
                        <?php
                        $subtotal = 0;
                        // if (!empty($_SESSION['cart'])) {
                        //     foreach ($_SESSION['cart'] as $key => $value) {
                        //         $subtotal += $value['price'] * $value['quantity'];
                        //     }
                        // }
                        if (!empty($list_carts)) {
                            foreach ($list_carts as $value) {
                                $subtotal += ($value['price'] * $value['quantity']);
                            }
                        }
                        echo number_format($subtotal);
                        ?>
                    </span>
                </p>
            </div>

            <button class="view_cart"><a href="cart.php">View Cart</a></button>
            <button style="align-items: center;" class="checkout"><a href="checkout.php">Checkout</a></button>
        </div>
    </div>
</div>

<!-- <script src="../public/js/side_cart.js"></script> -->