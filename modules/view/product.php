<?php
session_start();
ob_start();
require "../../db/connect.php";
require "../../db/database.php";

require "../../inc/header.php";
require 'side_cart.php';

require "../../lib/pagging.php";

$num_per_page = 10;
$num_page = ceil($num_rows_subcategory_items / $num_per_page);
// echo "Number of pages: " . $num_page . "<br>";
// Index of each page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $num_per_page;
// echo "<br>" . "The current page: " . $page;
// echo "<br>" . "The index of page " . $page . " is " . $start;

// echo "<br> Category: ".$category."<br>Subcategory: ".$subcategory."<br>Variant:  ".$variant."<br>";
$where = "";
if (!empty($category) && !empty($subcategory)) {
    if ($subcategory == "shirt")
        $subcategory = "Shirt";
    if ($subcategory == "bag")
        $subcategory = "Bag";
    if ($subcategory == "hat")
        $subcategory = "Hat";
    if ($subcategory == "shoes")
        $subcategory = "Shoes";

    $where = "category='{$category}' AND subcategory='{$subcategory}'";
}
if ($category == "GIFT") {
    if ($subcategory == "shirt")
        $subcategory = "Shirt";
    if ($subcategory == "bag")
        $subcategory = "Bag";
    if ($subcategory == "hat")
        $subcategory = "Hat";
    if ($subcategory == "shoes")
        $subcategory = "Shoes";

    $where = "`subcategory`='{$subcategory}'";
}
if (!empty($category) && empty($subcategory)) {
    $where = "category='{$category}'";
}
if (!empty($variant)) {
    if ($category == "GIFT") {
        $where = "`variant`='{$variant}'";
    } else {
        $where = "category='{$category}' AND `variant`='{$variant}'";
    }
}
// echo "Where: ".$where;
require "../../lib/getProducts.php";
$list_subcategory_items = get_products($start, $num_per_page, $where);

if ($subcategory == "Shirt")
    $subcategory = "shirt";
if ($subcategory == "Bag")
    $subcategory = "bag";
if ($subcategory == "Hat")
    $subcategory = "hat";
if ($subcategory == "Shoes")
    $subcategory = "shoes";
?>
<link rel="stylesheet" href="../../public/css/product.css" type="text/css">
<style>
    #list_product {
        position: relative;
        height: 970px;
    }

    /*  PAGGING  */
    ul.pagging {
        float: right;
        margin-top: 23px;
        position: absolute;
        bottom: 0;
        right: 0;
    }

    ul.pagging li {
        float: left;
        padding: 0px 2px;
    }

    ul.pagging li a {
        color: #000;
        display: block;
        padding: 7px 7px;
        border: 1px solid #dedede;
    }

    ul.pagging li.active a {
        /* color: #f00; */
        display: block;
        padding: 7px 7px;
        /* border: 1px solid #f00; */
        border: 1px solid;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    ul.pagging li a:hover {
        font-weight: bold;
        /* color: #fa9c44; */
        display: block;
        padding: 7px 7px;
        border: 1px solid rgb(12, 12, 12);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        /* Hiệu ứng bóng */
        transition: box-shadow 0.3s ease;
        /* Hiệu ứng mượt mà */
    }
</style>
<style>
    /* General Styles */
    /* #main_body {
    padding: 16px;
}

#upper_part {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 16px;
}

#upper_part img {
    max-width: 100%;
    height: auto;
}

#content_upper_part {
    text-align: center;
    max-width: 600px;
} */

    @media (min-width: 992px) and (max-width: 1199px) {

        /* list product */
        #list_product {
            margin: 0 30px 30px 30px;
            display: flex;
            flex-wrap: wrap;
            /* Cho phép xuống hàng */
            justify-content: space-between;

            height: fit-content;
            padding-bottom: 30px;
        }

        .product {
            max-width: 285px;
            height: 440px;
            border: 1px solid #e1dede;

            flex: 1 1 21%;
            box-sizing: border-box;
            /* Đảm bảo padding không làm tăng kích thước thực */
            margin-bottom: 20px;
        }

        .product img {
            width: 100%;
            height: 260px;
        }

        .img_content {
            margin-top: 35px;
            width: 85%;
            text-align: center;
            justify-self: center;
        }
    }

    /* Desktop ≥ 1200px */
    @media (min-width: 1200px) {
        /* Code responsive tại đây */
    }

    /* Responsive for tablets */
    @media (max-width: 768px) {
        #content_upper_part h2 {
            font-size: 25px;
            line-height: 10px;
            margin-bottom: 30px;
        }

        #content_upper_part p {
            font-size: 7px;
            line-height: 17px;
        }

        .quantity_product {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .subcategory a {
            display: inline-block;
            margin: 8px 0;
        }
        .subcategory {
            margin-left: 0px;
        }
    }

    /* Responsive for mobile phones */
    @media (max-width: 480px) {
        #content_upper_part h2 {
            /* margin-bottom: 20px; */
            line-height: 30px;
            font-size: 15px;
        }

        #content_upper_part p {
            font-size: 5px;
            line-height: 3px;
        }

        .product {
            width: 100%;
            margin-bottom: 16px;
        }

        .product img {
            max-width: 100%;
        }

        .img_content h3 {
            font-size: 18px;
        }

        .quantity_product span {
            display: block;
            margin-bottom: 8px;
        }
        #list_product {
            height: fit-content;
            padding-bottom: 30px;
        }
    }

    #list_product {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        height: fit-content;
        padding-bottom: 30px;
    }

    .product {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .img_content {
        margin-top: 8px;
    }

    img {
        max-width: 100%;
        height: auto;
        object-fit: cover;
    }

    h2,
    p {
        text-align: center;
        margin: 8px 0;
    }

    h2 {
        font-size: 24px;
    }

    p {
        font-size: 16px;
        line-height: 1.5;
    }
</style>

<!-- ============================================ MAIN ============================================-->
<div id="main_body">
    <div id="upper_part">
        <?php ?>
        <img src="../../public/img/<?php
        if ($category == "WOMEN")
            echo "WOMEN.webp";
        if ($category == "MEN")
            echo "MEN.jpg";
        if ($category == "GIFT")
            echo "GIFT.jpg";
        ?>" alt="upper_part_img.jpg">
        <div id="content_upper_part">
            <?php
            if ($category == "WOMEN") {
                ?>
                <h2>ESSENTIALS FOR WOMEN</h2>
                <?php
            }
            if ($category == "MEN") {
                ?>
                <h2>ESSENTIALS FOR MEN</h2>
                <?php
            }
            if ($category == "GIFT") {
                ?>
                <h2>GIFTS FOR YOUR LOVER</h2>
                <?php
            }
            ?>
            <p>Crafted for everyday luxury, STYLESEEKER designer handbags blend sophistication and flair, with
                StyleSeeker
                Blondie,
                SS Emblem, and StyleSeeker B.</p>
        </div>
    </div>
    <div class="quantity_product">
        <span><strong><?php echo $num_rows_subcategory_items ?></strong> PRODUCTS</span>
        <div class="subcategory">
            <a href="product.php?category=<?php echo $category; ?>&subcategory=bag"><span
                    class="under_span_subcategory">BAG</span></a>
            <a href="product.php?category=<?php echo $category; ?>&subcategory=shoes"><span
                    class="under_span_subcategory">SHOES</span></a>
            <a href="product.php?category=<?php echo $category; ?>&subcategory=hat"><span
                    class="under_span_subcategory">HAT</span></a>
            <a href="product.php?category=<?php echo $category; ?>&subcategory=shirt"><span
                    class="under_span_subcategory">SHIRT</span></a>
        </div>
        <div style="position: relative;">
            <input class="filterBtn" type="submit" name="filter" value="FILTER" id="filter">
            <div class="filter">
                <div class="price_filter">
                    <form action="" method="POST">
                        <div class="price_filter_increase">
                            <input type="submit" name="price_filter_increase" value="Price"><i
                                class="fa-solid fa-arrow-up"></i>
                        </div>
                        <div class="price_filter_decrease">
                            <input type="submit" name="price_filter_decrease" value="Price"><i
                                class="fa-solid fa-arrow-down"></i>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="product_filter">
                    <?php
                    if ($category == "GIFT" && $subcategory == "") {
                        ?>
                        <a href="product.php?category=WOMEN">WOMEN</a>
                        <a href="product.php?category=MEN">MEN</a>
                        <?php
                    }
                    if ($category == "WOMEN" && $subcategory == "") {
                        ?>
                        <a href="product.php?category=WOMEN&subcategory=bag">Bag</a>
                        <a href="product.php?category=WOMEN&subcategory=shoes">Shoes</a>
                        <a href="product.php?category=WOMEN&subcategory=shirt">Shirt</a>
                        <a href="product.php?category=WOMEN&subcategory=hat">Hat</a>
                        <?php
                    }
                    if ($category == "MEN" && $subcategory == "") {
                        ?>
                        <a href="product.php?category=MEN&subcategory=bag">Bag</a>
                        <a href="product.php?category=MEN&subcategory=shoes">Shoes</a>
                        <a href="product.php?category=MEN&subcategory=shirt">Shirt</a>
                        <a href="product.php?category=MEN&subcategory=hat">Hat</a>
                        <?php
                    }
                    if ($subcategory == "bag") {
                        ?>
                        <!-- <input type="submit" name="hand_bag" value="Hand Bag">
                                <input type="submit" name="bag" value="Bag">
                                <input type="submit" name="wallet" value="Wallet"> -->
                        <a
                            href="product.php?category=<?php echo $category; ?>&subcategory=<?php echo $subcategory ?>&variant=hand_bag">Hand
                            Bag</a>
                        <a
                            href="product.php?category=<?php echo $category; ?>&subcategory=<?php echo $subcategory ?>&variant=bag">Bag</a>
                        <a
                            href="product.php?category=<?php echo $category; ?>&subcategory=<?php echo $subcategory ?>&variant=wallet">Wallet</a>
                        <?php
                    }
                    if ($subcategory == "shoes") {
                        ?>
                        <!-- <input type="submit" name="high_heels" value="High Heels">
                                <input type="submit" name="sprot_shoes" value="Sport Shoes"> -->
                        <a href="product.php?category=<?php echo $category; ?>&subcategory=shoes&variant=high_heels">High
                            Heels</a>
                        <a href="product.php?category=<?php echo $category; ?>&subcategory=shoes&variant=sport_shoes">Sport
                            Shoes</a>
                        <?php
                    }
                    if ($subcategory == "shirt") {
                        ?>
                        <!-- <input type="submit" name="jacket" value="Jacket">
                                <input type="submit" name="shirt" value="Shirt"> -->
                        <a href="product.php?category=<?php echo $category; ?>&subcategory=shirt&variant=jacket">Jacket</a>
                        <a href="product.php?category=<?php echo $category; ?>&subcategory=shirt&variant=shirt">Shirt</a>
                        <?php
                    }
                    if ($subcategory == "hat") {
                        ?>
                        <!-- <input type="submit" name="bucket_bag" value="Bucket Hat">
                                <input type="submit" name="baseball_cap" value="Baseball Cap"> -->
                        <a href="product.php?category=<?php echo $category; ?>&subcategory=hat&variant=bucket_hat">Bucket
                            Hat</a>
                        <a href="product.php?category=<?php echo $category; ?>&subcategory=hat&variant=baseball_cap">Baseball
                            Cap</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <span> | SORT BY: SUGGESTED</span>
        </div>
    </div>
    <div id="list_product">
        <?php
        foreach ($list_subcategory_items as $item) {
            ?>
            <div class="product">

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
                $img_pathItem .= $item["product_image_1"];
                $img_pathItemAdd .= $item["product_image_2"];
                ?>
                <img src="<?php echo $img_pathItem ?>" alt="<?php echo $item["product_image_1"] ?>"
                    onmouseover="changeImage(this, '<?php echo $img_pathItemAdd ?>')"
                    onmouseout="resetImage(this, '<?php echo $img_pathItem ?>')">


                <div class="img_content">
                    <h3><?php echo $item['name'] ?></h3>
                    <span style="display:block; margin-bottom: 12px; color: #000; font-size:18px">
                        <?php echo number_format($item['price'], 0, '.', ',') . " VND"; ?></span>
                    <!-- <span class="shop_this">SHOP THIS</span> -->
                    <a href="detailed_product.php?slug=<?php echo str_replace(' ', '-', $item['name']) ?>&id=<?php echo $item['product_id'] ?>"
                        class="shop_this">SHOP THIS</a>
                </div>

                <div class="add_to_favourites" onclick="toggleFavourite(this)">
                    <i class="fas fa-heart"></i>
                    <!-- <span>Add to favourites</span> -->
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        $url = "product.php?category=" . urlencode($category) . "&subcategory=" . urlencode($subcategory);
        if (!empty($variant)) {
            $url .= "&variant=" . urlencode($variant);
        }
        echo get_pagging($num_page, $page, $url);
        ?>
    </div>

    <!-- <?php //echo get_pagging($num_page, $page, "product.php?category=<?php echo $category; ?>&subcategory=<?php //echo $subcategory; ?><?php //if (!empty($variant)) echo '&variant='.$variant ?>"); ?> -->

</div>

<!-- change image -->
<script>
    //Change Image
    function changeImage(imgElement, newSrc) {
        imgElement.classList.add("hidden"); //mờ ảnh trước khi đổi
        setTimeout(function () {
            imgElement.src = newSrc;
            imgElement.classList.remove("hidden"); //bỏ hiệu ứng mờ để hiện ảnh mới lên
        }, 200); // set 0.5s (khớp với transition)
    }
    function resetImage(imgElement, originalSrc) {
        imgElement.src = originalSrc;
    }
</script>

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
<style>
    .plus {
        font-size: 12px;
    }
    .sign_up_for_ss {
        font-size: 15px; font-weight bold;
    }
    .embrace {
        font-size: 28px; 
        line-height: 45px;
    }
    /* ================== Responsive =================== */
    @media (max-width: 768px) {
        #content_footer p {
            font-size: 14px;
        }

        #footer {
            padding: 30px 15px;
        }

        #content_footer {
            width: 90%;
            margin: 20px auto;
        }

        .sign_up_for_ss {
            font-size: 10px; 
        }
        .embrace {
            font-size: 19px; 
            line-height: 37px;
        }

        .column {
            width: 100%;
            margin-bottom: 20px;
        }

        .main_row {
            font-size: 13px;
        }

        .row {
            font-size: 11px;
        }

        .plus {
            font-size: 18px;
        }

        .locator {
            width: 100%;
        }

        .modal_contain_footer {
            width: 90%;
        }

        .locator p {
            font-size: 12px;
        }

        .locator .detailed_locator {
            flex-direction: column;
            text-align: center;
        }

        .detailed_locator i {
            font-size: 20px;
        }
        #footer p {
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        #footer {
            padding: 20px 10px;
        }

        .main_row {
            font-size: 9px;
        }

        .row {
            font-size: 7.5px;
        }

        .plus {
            font-size: 9px;
        }

        .locator p {
            font-size: 10px;
        }

        .locator .detailed_locator i {
            font-size: 10px;
        }
        .detailed_locator span {
            font-size: 9px;
        }

        .modal_contain_footer {
            width: 90%;
            padding: 30px 10px;
        }

        .modal_content_footer h1 {
            font-size: 12px;
        }

        .modal_content_footer a {
            font-size: 10px;
        }

        #footer p {
            font-size: 9px;
        }
    }
</style>
<div id="footer">
    <div id="content_footer">
        <p class="sign_up_for_ss">SIGN UP FOR STYLESEEKER UPDATES</p>
        <p class="embrace">Embrace the holiday spirit by exploring unique gifts and
            uncovering the latest news from the House.</p>
        <p class="plus">Subscribe</p>
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
    <p>© 2016 - 2022 StyleSeeker S.p.A. - All rights reserved. SIAE LICENCE # 2294/I/1936 and 5647/I/1936</p>
</div>
<script src="../public/js/product.js"></script>
<script>
    //Modal
    const modal = document.querySelector('.modal_footer');
    const btn = document.querySelector('.locator');
    const closeBtn = document.querySelector('.close');

    btn.onclick = function (event) {
        event.preventDefault();
        modal.style.display = 'flex';
    }
    closeBtn.onclick = function (event) {
        modal.style.display = 'none';
    }
    window.onclick = function (event) {
        if (event.target == 'modal')
            modal.style.display = 'none';
    }
</script>

<!-- CART -->
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

<!-- CONTACT US -->
<script>
    const openCardContact = document.getElementById('open_card_contact')
    const cardContact = document.getElementById('sidecard_contact')
    const closeBtnCardContact = document.getElementById('close_btn_contact')
    const backdropContact = document.querySelector('.backdropContact')

    openCardContact.addEventListener('click', openCard)
    closeBtnCardContact.addEventListener('click', closeCard)
    backdropContact.addEventListener('click', closeCard)

    //Open Cart
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
    document.querySelector('.filterBtn').addEventListener('click', function () {
        const filterMenu = document.querySelector('.filter');
        filterMenu.classList.toggle('show');
    });

</script>
</div>
</body>