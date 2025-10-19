<!-- <link rel="stylesheet" href="../public/css/contact_us.css"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    /* ==== Back Drop ====*/
    .backdropBill {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 2;
        display: none;
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .backdropBill.show {
        display: block;
        opacity: 1;
    }

    .bill {
        /* overflow-y: scroll; */
        overflow-y: auto;
        position: fixed;
        top: 0;
        right: 0;
        /* height: auto; */
        height: 100%;
        width: 50%;
        background-color: #fff;
        box-shadow: -10px 0 15px var(--light-gray);
        /*hiệu ứng đổ bóng bên trái của thanh bên*/
        z-index: 3;
        /* transform: translateX(110%);  */
        /* transform: translateX(0); */
        display: none;
        transition: transform 0.7s ease-in-out;
        border: 1px solid #eee;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .bill.open {
        /* transform: translateX(0); */
        display: block;
    }

    .card_content_bill {
        display: flex;
        height: 100%;
        flex-direction: column;
        position: relative;
        padding: 0 60px;
        overflow-y: auto;
    }

    .top_bar {
        display: flex;
        justify-content: space-between;
    }

    .top_bar h3 {
        margin-top: 15px;
        margin-bottom: 0;
        font-weight: 550;
        font-size: 15px;
        line-height: 10px;
        color: #000;
        font-family: "Montserrat", sans-serif;
    }

    .print {
        display: flex;
        align-items: end;
    }

    .print h4 {
        margin-top: 15px;
        margin-bottom: 0;
        font-weight: 300;
        font-size: 12px;
        color: #000;
        font-family: "Montserrat", sans-serif;
    }

    .title_bill {
        align-content: center;
        text-align: center;
    }

    .email {
        display: flex;
        height: auto;
        align-items: center;
        justify-content: flex-end;
    }

    .email p {
        color: #000;
        font-family: "Montserrat", sans-serif;
        padding-left: 5px;
        font-size: 11px;
        font-weight: 300;
        margin: 0;
        text-align: right;
        width: fit-content;
    }

    .title_bill h1 {
        color: #000;
        font-size: 30px;
        font-family: "Montserrat", sans-serif;
        font-weight: 400;
        padding: 50px 0;
    }
</style>
<!-- Backdrop -->
<div class="backdropBill"></div>

<!-- Bill -->
<div id="bill" class="bill">
    <div class="card_content_bill">
        <!-- Cart Header-->
        <!-- <span id="close_btn_contact" class="close_btn_contact">&times;</span> -->
        <div class="top_bar">
            <h3 style="text-align: left;">STYLE SEEKER</h1>
                <div class="print">
                    <i class="fa-solid fa-print" style="font-size: 15px;padding-right: 5px;"></i>
                    <h4>Print</h4>
                </div>
        </div>
        <hr
            style="padding: 0.1px;border: none !important;height: 0.5px !important;background: #eeeaea !important;width: 100% !important;">

        <div class="title_bill">
            <div class="email">
                <i class="fa-regular fa-envelope" style="font-size: 12px; height: 10px;"></i>
                <p>assistance@us-onlineshopping.styleseeker.com</p>
            </div>
            <h1>MY SHOPPING BAG</h1>
        </div>

        <div class="selections">
            <hr
                style="padding: 0.1px;border: none !important;height: 0.5px !important;background: #eeeaea !important;width: 100% !important;">
            <?php
            foreach ($list_carts as $value) {
                ?>
                <div class="selection" style="width: 100%;">
                    <div class="selection_img">
                        <?php
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
                        $img_pathItem .= $value['product-image-1'];
                        ?>
                        <img style="width: 110px;height: 130px;" src="<?php echo $img_pathItem ?>"
                            alt="<?php echo $value['name'] ?>">
                    </div>
                    <div class="selection_detail">
                        <div class="selection_detail_1"
                            style="display:flex; flex-direction:row; justify-content:space-between">
                            <div>
                                <a style="cursor: unset;font-size: 13.5px;"
                                    href="detailed_product.php?slug=<?php echo str_replace(' ', '-', $value['name']) ?>&id=<?php echo $value['id'] ?>">
                                    <?php echo $value['name']; ?>
                                </a>
                                <p style="margin-top:10px">Style:
                                    <?php echo htmlspecialchars($value['id']); ?>
                                </p>
                                <p>Variation: <?php echo htmlspecialchars($value['color']); ?></p>
                            </div>
                            <!-- <div class="counter_status_comment"
                                                style="display:flex; flex-direction:column; justify-content:space-between;height: 81px;">
                                               

                                                <div class="status_comment">
                                                    <h4>AVAILABLE</h4>
                                                    <p>Enjoy complimentary delivery or Collect In Store.</p>
                                                </div>
                                            </div> -->
                            <div>
                                <p style="font-size: 15px;text-align: right; width: 100%;"><?php
                                $priceItem = $value['price'] * $value['quantity'];
                                echo number_format($priceItem, 0, '.', ',') ?> VND</p>

                                <!-- Input số lượng -->
                                <p style="text-align: right;font-size: 10px;">QTY: <?php echo $value['quantity'] ?></p>
                            </div>
                        </div>
                        <div class="selection_detail_2">
                            <!-- <p>$<?php
                            //$priceItem = $value['price'] * $value['quantity'];
                            //echo number_format($priceItem, 0, '.', ',') ?></p> -->



                            <!-- <span class="under_span-update"><a
                                                        href="action/update_cart.php?slug=cart&id_product=<?php //echo $value['id'] ?>&quantity=<?php
                                                         // if (isset($_POST['quantityNum'])) echo $_POST['quantityNum'] ;
                                                         // else echo $quantityNum ?>">SAVED
                                                        ITEM</a></span> -->


                            <!-- <button class="under_span-update" name="update">SAVED ITEM</button> -->

                            <form action="" method="POST" style="width:100%;">

                                <div>

                                    <!-- Input ID sản phẩm -->
                                    <input type="hidden" name="productId" value="<?php echo $value['id']; ?>">

                                    <div class="counter_status_comment"
                                        style="display:flex; flex-direction:column; justify-content:space-between;">

                                        <div class="status_comment">
                                            <h4
                                                style='font-family: "Montserrat", sans-serif; font-weight: 500;font-size: 13px;'>
                                                AVAILABLE</h4>
                                            <p style="font-size: 11px;">Enjoy complimentary delivery or Collect
                                                In Store.</p>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
                <hr
                    style="padding: 0.1px;border: none !important;height: 0.5px !important;background: #eeeaea !important;width: 100% !important;">
                <?php
            }
            ?>
        </div>
        <table class="order_tbl" style="margin-top: 20px;">
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
                        <p style="text-align: right;">Free (Premium Express)</p>
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
        <!-- Cart Items -->
        <!-- <div class="call_us">
            <div class="title_cart_item">
                <i class="fa-solid fa-phone"></i>
                <div class="phone">
                    <span>CALL US</span>

                    <div style="display: flex;flex-direction: column;">
                        <span style="border-bottom: 1px solid #000;margin-bottom: 8px;font-size: 13px;">+84.399.589.895</span>
                        <span style="border-bottom: 1px solid #000;font-size: 13px;">+84.399.589.895</span>
                    </div>
                </div>
            </div>
            <div class="content_card_item">
                <p>Monday - Saturday from 9 AM to 11 PM.
                    Sunday from 10 AM to 9 PM.</p>
            </div>
        </div>
        <div class="facebook">
            <div class="title_cart_item">
                <i class="fa-brands fa-facebook-f"></i>
                <span>FACEBOOK</span>
            </div>
            <div class="content_card_item">
                <div style="margin-bottom: 7px;">
                    <span>Her :</span>
                    <a style="color: #000;" href="">Quynhanhnguyenhuufb.com</a>
                </div>
                <div style="margin-bottom: 10px;">
                    <span>Him :</span>
                    <a style="color: #000;" href="">Quocanhnguyenlefb.com</a>
                </div>
            </div>
        </div>
        <div class="live_chat">
            <div class="title_cart_item">
                <i style="color: #ffea00;" class="fa-solid fa-circle"></i>
                <span>LIVE CHAT</span>
            </div>
            <div class="content_card_item">
                <p>Monday - Saturday from 9 AM to 11 PM.
                    Sunday from 10AM to 9PM.</p>
            </div>
        </div> -->
        <!-- Cart Actions -->
        <!-- <h3 style="text-align: left;" class="cart_actions_contact">Do you need further assistance?</h3>
        <a class="cart_actions_contact_a" href="">Get in Contact with Us</a> -->
    </div>
</div>