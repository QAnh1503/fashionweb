<?php
session_start();
ob_start();
require "../../db/connect.php";
require "../../db/database.php";
require "../../lib/validation.php";
// $list_array = db_fetch_array("SELECT * FROM `bags_women`");
// print_r($list_array);

// $num_rows = db_num_rows("SELECT * FROM `bags_women`");
// echo $num_rows;


// require 'action/quantity_counter.php';
require "../../inc/header.php";
require 'side_cart.php';
require 'bill.php';

if (isset($_POST['update'])) {
    // Lấy dữ liệu từ form
    $quantityNum = (int) $_POST['quantityNum'];
    $productId = (int) $_POST['productId'];

    // Cập nhật trong giỏ hàng
    foreach ($list_carts as $cart) {
        if ($cart['id'] == $productId) {
            $data = array(
                'quantity' => $quantityNum
            );
            db_update('cart_items', $data, "`id` = {$productId}");
            break;
        }
    }
    redirect_to("cart.php");
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // exit;
}

?>

<body>

    <link rel="stylesheet" href="../../public/css/cart.css" type="text/css">
    <style>
        #info-cart-wp table tbody tr td .thumb {
            overflow: visible;
        }

        #info-cart-wp {
            display: flex;
            justify-content: space-between;
        }

        .selections {
            display: flex;
            flex-direction: column;
            /* height: auto; */
            gap: 10px;
            /* Khoảng cách giữa các selection */
        }

        .selection_container {
            display: inline-block;
        }

        .selection {
            width: 68%;
            width: 700px;
            /* height: 100px; */
            display: flex;
            /* overflow: hidden; */
        }

        .selection_img img {
            height: 170px;
            width: 150px;
            object-fit: cover;
        }

        .selection_detail {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 15px 0 0 15px;
        }

        .selection_detail_1 {
            width: 100%;
        }

        .selection_detail_1 a {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-size: 15px;
            text-transform: uppercase;
            color: #000;
            line-height: 17px;
        }

        .selection_detail_1 p {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-size: 11px;
            color: #000;
            text-align: left;
            line-height: normal;
            margin: 0;
            margin-top: 5px;
        }

        .selection_detail_1 h4 {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 600;
            font-style: normal;
            font-size: 11px;
            color: #000;
        }

        .selection_detail_2 {
            position: relative;
            width: 100%;
            /* align-items: flex-end; */
            display: flex;
            flex-direction: column;
        }

        .qty {
            border: 1px solid #ccc;
            border-radius: 3px;
            width: 335px;
            width: 78px;
            height: 25px;
            margin-bottom: 10px;
            background: #fbfbfb;
            font-family: "Montserrat", sans-serif;
            color: #363434;
        }

        .selection_detail_2 p {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 350;
            font-style: normal;
            /* font-size: 20px; */
            color: #000;
            text-align: left;
            line-height: normal;
            margin: 0;
            margin-top: 2px;
            /* text-align: right; */
        }

        .modify {
            position: absolute;
            right: 0;
            bottom: 0;
            display: flex;
        }

        .under_span-remove {
            margin-right: 10px;
            font-family: "Montserrat", sans-serif;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;

            align-items: center;
            display: flex;
            user-select: none;
        }

        .under_span-remove a {
            color: #000;
        }

        .under_span-update {
            border: none;
            background-color: transparent;
            color: #000;
            font-family: "Montserrat", sans-serif;
            font-size: 11px;
            width: auto;
            font-weight: 600;
            cursor: pointer;
            padding: 0;
            padding-bottom: 2px;
        }

        .under_span-remove {
            position: relative;
        }

        .under_span-remove::after {
            position: absolute;
            content: "";
            left: 0;
            bottom: 0;
            width: 100%;
            height: 0.9px;
            transition: transform 0.3s ease, opacity 0.3s ease;
            background-color: #000;
            /* Màu gạch chân giống màu chữ */
            /* transform: translateY(5px);  */
            opacity: 1;
        }

        .under_span-remove:hover::after {
            animation: disappear 0.5s ease;
        }

        .under_span-update {
            position: relative;
        }

        .under_span-update::after {
            position: absolute;
            content: "";
            left: 0;
            bottom: 0;
            width: 100%;
            height: 0.9px;
            transition: transform 0.3s ease, opacity 0.3s ease;
            background-color: #000;
            /* Màu gạch chân giống màu chữ */
            /* transform: translateY(5px);  */
            opacity: 1;
        }

        .under_span-update:hover::after {
            animation: disappear 0.5s ease;
        }

        .order_summary {
            width: 20%;
            width: 350px;
        }

        .order_container {
            width: 100%;
            border: 1px solid #000;
        }

        .order_container h2 {
            font-family: "Montserrat", sans-serif;
            font-size: 12px;
            width: auto;
            font-weight: 650;
            color: #000;
        }

        .order_container h3 {
            font-family: "Montserrat", sans-serif;
            font-size: 10px;
            width: auto;
            font-weight: 650;
            color: #000;
            margin-bottom: 20px;
        }

        hr {
            margin: 5px 0 5px 0;
            border: none;
            border-radius: 5px;
            background-color: aca9a9;
            height: 1px;
        }

        .order_tbl {
            font-family: "Montserrat", sans-serif;
            font-size: 11px;
            width: auto;
            font-weight: 500;
            width: 100%;
        }

        .order_tbl tr {
            height: 35px;
            color: #000;
        }

        .col_1 {
            text-align: left;
            width: 90px;
        }

        .col_2 {
            text-align: right;
        }

        .shipping {
            display: flex;
        }

        .shipping p {
            color: #000;
            font-family: "Montserrat", sans-serif;
            font-size: 11px;
            font-weight: 500;
            margin: 0;
            padding: 0;
            width: 100%;
            line-height: 0;
            margin: auto 0;
            margin-right: 3px;
            color: aca9a9;
        }
        .shipping img {
            width: 20px;
            height: 20px;
        }
        .estimated_total {
            font-size: 20px;
            font-family: "Montserrat", sans-serif;
            font-weight: 400;
        }
        /* accordion */
        .accordion-item {
            /* border-bottom: 1px solid #ccc; */
            margin-bottom: 15px;
            margin-top: 15px;
        }
        .accordion-header {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;
            background: none;
            border: none;
            font-size: 11px;
            width: 100%;
            text-align: left;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            color: #000;
        }
        .accordion-icon {
            font-size: 18px;
            color: #000;
            transition: transform 0.5s;
        }
        .accordion-item p {
            width: 100%;
            font-family: "Montserrat", sans-serif;
            font-weight: 400;
            font-size: 10px;
            text-align: justify;
            color: #000;
        }
        .accordion-content {
            display: none;
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            color: #333;
            font-size: 13px;
            line-height: 20px;
            transition: all 1s ease;
        }
        .stock {
            position: relative;
            display: flex;
        }
        .stock p {
            width: auto;
        }
        .stock_img {
            width: 20px;
            height: 20px;
            position: absolute;
            top: 14px;
            margin-left: 45px;
        }
        /* Show content when active */
        .accordion-item.active .accordion-content {
            display: block;
            max-height: 500px;
            transition: all 1s ease;
            /* transition: max-height 0.5s ease; */
        }
        @media(prefers-reduced-motion: reduce) {
            .accordion-item.active {
                transition: none;
            }
        }
        /* Rotate the icon when active */
        .accordion-item.active .accordion-icon {
            transform: rotate(45deg);
        }
        .checkout {
            display: flex;
            flex-direction: column;
            text-align: center;
            margin-top: 30px;
        }

        .checkout button {
            border: none;
            background-color: #000;
            color: #fff;
            /* border-radius: 15px; */
            padding: 10px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            padding: 19px 0;
            font-family: "Montserrat", sans-serif;
            transition: transform 0.5s ease;
            width: 300px;
            margin: 7px auto;
        }

        .checkout button a {
            border: none;
            background-color: #000;
            color: #fff;
            /* border-radius: 15px; */
            padding: 10px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            padding: 19px 0;
            font-family: "Montserrat", sans-serif;
            transition: transform 0.5s ease;
            width: 300px;
            margin: 7px auto;
        }

        .checkout span {
            font-family: "Montserrat", sans-serif;
            font-size: 17px;
            color: aca9a9;
            margin: 7px 0;
        }

        .checkout button:nth-of-type(2) {
            background-color: #fff;
            color: #000;
            border: 1.4px solid #000;
        }

        .checkout button:nth-of-type(3) {
            background-color: #fff;
            color: #000;
            border: 1.4px solid #000;
        }

        .checkout button:hover {
            opacity: 0.8;
            transform: scale(0.93);
        }
    </style>
    <div id="main_body">
        <div id="upper_part">
            <img src="../../public/img/models-bags.webp" alt="high-fashion-black-model.jpg">
            <div id="content_upper_part">
                <h2>SHOPPING BAG</h2>
                <p>Crafted for everyday luxury, STYLESEEKER designer handbags blend sophistication and flair, with
                    Style Seeker
                    Blondie,
                    SS Emblem, and STYLESEEKER B.</p>
            </div>
        </div>

        <div id="main-content-wp" class="cart-page">
            <div class="section" id="breadcrumb-wp">
                <div class="wp-inner">
                    <div class="section-detail">
                        <h3 style='font-family: "Montserrat", sans-serif; color: #000; font-size: 20px; margin-bottom: 30px;'
                            class="title">YOUR SELECTIONS</h3>
                        <div style="display: flex; align-items: end; width: 100%;justify-content: flex-end;padding-bottom: 5px;">    
                            <i class="fa-solid fa-print" style="font-size: 13px;padding-right: 5px;"></i>
                            <h3 id="open_card_bill" class="open_card_bill" style=' text-align: end;text-align: right; align-content: end;font-size: 11px;font-weight: 400;cursor: pointer;'>Print Bill</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div id="wrapper" class="wp-inner clearfix">
                <div class="section" id="info-cart-wp">
                    <div class="selections">
                        <?php
                        foreach ($list_carts as $value) {
                            ?>
                            <div class="selection">
                                <div class="selection_img">
                                    <?php
                                    $img_pathItem = "../../public/img/";
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
                                    $img_pathItem .= $value['product-image-1'];
                                    ?>
                                    <img src="<?php echo $img_pathItem ?>" alt="<?php echo $value['name'] ?>">
                                </div>
                                <div class="selection_detail">
                                    <div class="selection_detail_1"
                                        style="display:flex; flex-direction:row; justify-content:space-between">
                                        <div>
                                            <a
                                                href="detailed_product.php?slug=<?php echo str_replace(' ', '-', $value['name']) ?>&id=<?php echo $value['product_id'] ?>">
                                                <?php echo $value['name']; ?>
                                            </a>
                                            <p style="margin-top:10px">Style:
                                                <?php echo htmlspecialchars($value['id']); ?>
                                            </p>
                                            <p>Variation: <?php echo htmlspecialchars($value['color']); ?></p>
                                        </div>
                                        <div>
                                            <p style="font-size: 18px;text-align: right; width: 100%;"><?php
                                            $priceItem = $value['price'] * $value['quantity'];
                                            echo number_format($priceItem, 0, '.', ',') ?> VND</p>
                                        </div>
                                    </div>
                                    <div class="selection_detail_2">
                                        <form action="" method="POST" style="width:100%;">

                                            <div>
                                                <!-- Input số lượng -->
                                                <input class="qty" type="number" value="<?php echo $value['quantity']; ?>"
                                                    name="quantityNum">

                                                <!-- Input ID sản phẩm -->
                                                <input type="hidden" name="productId" value="<?php echo $value['id']; ?>">

                                                <div class="counter_status_comment"
                                                    style="display:flex; flex-direction:column; justify-content:space-between;">

                                                    <div class="status_comment">
                                                        <h4>AVAILABLE</h4>
                                                        <p style="font-size: 13px;">Enjoy complimentary delivery or Collect
                                                            In Store.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Nút cập nhật -->
                                            <div class="modify">

                                                <span class="under_span-remove"><a
                                                        href="action/remove_cart.php?slug=cart&id_product=<?php echo $value['cart_id'] ?>">REMOVE</a></span>
                                                <button class="under_span-update" name="update">UPDATE</button>
                                            </div>


                                        </form>

                                    </div>
                                </div>
                            </div>
                            <?php
                        }

                        ?>
                    </div>
                    <div class="order_summary">
                        <div style="padding: 25px;" class="order_container">
                            <h2>ORDER SUMMARY</h2>
                            <hr style="width:30px; height: 1.4px;">
                            <h3>USCART404372730</h3>
                            <hr style="height: 0.5px;">
                            <table class="order_tbl">
                                <tr class="subtotal">
                                    <td class="col_1">Subtotal</td>
                                    <td class="col_2">
                                        <?php
                                        $total_cost = 0;
                                        foreach ($list_carts as $cart) {
                                            $total_cost += ($cart['price'] * $cart['quantity']);
                                        }
                                        echo number_format($total_cost) . " VND";
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col_1">Shipping</td>
                                    <td class="col_2">
                                        <div class="shipping">
                                            <p>Free (Premium Express)</p>
                                            <img src="../public/img/shipping.png" alt="shipping.png">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col_1">Estimated Total</td>
                                    <td class="estimated_total col_2">
                                        <?php
                                        $total_cost = 0;
                                        foreach ($list_carts as $cart) {
                                            $total_cost += ($cart['price'] * $cart['quantity']);
                                        }
                                        echo number_format($total_cost) . " VND";
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <div class="acoordition">
                                <div class="accordion-item">
                                    <button class="accordion-header">
                                        VIEW DETAILS
                                        <span class="accordion-icon">+</span>
                                    </button>
                                    <p>You will be charged at the time of shipment. If this is a personalized or
                                        made-to-order purchase, you will be charged at the time of purchase.</p>
                                    <div class="accordion-content">
                                        <table style="width: 100%;" class="order_tbl">
                                            <tr>
                                                <td class="col_1">
                                                    <div class="stock">
                                                        <p>In Stock:</p>
                                                        <img class="stock_img" src="../../public/img/help.png"
                                                            alt="help.png">


                                                        <div class="modal">
                                                            <div class="modal-contain">
                                                                <div class="modal-content">
                                                                    <p style="margin-bottom: 15px">GG Emblem small
                                                                        shoulder bag</p>
                                                                    <p>In Stock:</p>
                                                                    <p style="margin-bottom: 15px">Estimated
                                                                        delivery within 2 - 3 business days.
                                                                        Delivery between 9 am - 8 pm, Monday to
                                                                        Friday. A signature will be required upon
                                                                        delivery.</p>
                                                                    <p style="margin-bottom: 15px">GG Emblem small
                                                                        shoulder bag</p>
                                                                    <p>In Stock:</p>
                                                                    <p>Estimated delivery within 2 - 3 business
                                                                        days. Delivery between 9 am - 8 pm, Monday
                                                                        to Friday. A signature will be required upon
                                                                        delivery.</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </td>
                                                <td class="col_2">
                                                    <?php
                                                    $total_cost = 0;
                                                    foreach ($list_carts as $cart) {
                                                        $total_cost += ($cart['price'] * $cart['quantity']);
                                                    }
                                                    echo number_format($total_cost) . " VND";
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="checkout">
                                <button><a style="" href="checkout.php">Checkout</a></button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- MODAL -->
    <style>
        /* Modal styling */
        .stock_img:hover+.modal,
        .modal:hover {
            opacity: 1;
            visibility: visible;
        }

        .modal {
            display: none;
            position: absolute;
            top: 30px;
            /* left: 50%; */
            z-index: 3;
            transform: translateX(-50%);
            left: 0;
            top: 0;
            width: 100%;
            width: 450px;

            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: opacity 0.3s, visibility 0.3s;

            justify-content: center;
            align-items: center;
        }

        /* Hiển thị modal khi hover */
        .stock:hover .modal {
            display: block;
        }

        .modal-contain {
            position: relative;
            background-color: white;
            padding: 30px 25px;
            max-width: 450px;
            height: auto;
        }

        .modal-content {
            width: 100%;
            text-align: center;
            justify-items: center;
        }

        .modal-content p {
            color: #000;
            line-height: 1.35;
            font-size: 12px;
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 450;
            font-style: normal;
            /* margin-bottom: 20px; */
            margin-top: 3px;
            margin-bottom: 0;
        }
    </style>

</body>
<!-- ============================================ FOOTER ============================================-->

<div id="footer">
    <div id="content_footer">
        <p style="font-size: 15px; font-weight: bold;">SIGN UP FOR STYLESEEKER UPDATES</p>
        <p style="font-size: 28px; line-height: 45px;">Embrace the holiday spirit by exploring unique gifts and
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

                .close {
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
                    <img src="../public/img/close.png" alt="X" class="close">
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
                    }

                    .detailed_locator .fa-regular {
                        color: #fff;
                        margin-right: 3px;
                        font-size: 15px;
                    }
                </style>
                <div class="locator">
                    <div class="detailed_locator">
                        <span class="locate">470 Tran Dai Nghia Street, Hoa Hai, Ngu Hanh Son, Da Nang</span>
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
                        to our latest collections, events and initiatives. More details on this are provided in
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
            <!-- <div class="row">VIET NAM</div> -->
        </div>
    </div>
    <p>© 2022 - 2024 Style Seeker S.p.A. - All rights reserved. SIAE LICENCE # 2294/I/1936 and 5647/I/1936</p>
</div>
<script src="../../public/js/cart.js"></script>
</div>
<script>
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

<script>
    //Accordion
    document.querySelectorAll(".accordion-header").forEach(button => {
        button.addEventListener("click", () => {
            const accordionItem = button.parentElement;
            accordionItem.classList.toggle("active");

            if (accordionItem.classList.contains("active")) {
                content.style.height = content.scrollHeight + "px";
            } else {
                content.style.height = "0";
            }
        });
    });

</script>

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

<script>
    // ================================= BILL =================================
    const openCardBillBtn = document.getElementById('open_card_bill')
    const cardBill = document.getElementById('bill')
    const backdropBill = document.querySelector('.backdropBill')

    openCardBillBtn.addEventListener('click', openCardBill)
    backdropBill.addEventListener('click', closeCardBill)

    //Open Card
    function openCardBill() {
        cardBill.classList.add('open')
        backdropBill.style.display = 'block'

        setTimeout(() => {
            backdropBill.classList.add('show')
        }, 0)
    }

    //Close Card
    function closeCardBill() {
        cardBill.classList.remove('open')
        backdropBill.classList.remove('show')

        setTimeout(() => {
            backdropBill.style.display = 'none'
        }, 500)
    }
</script>
