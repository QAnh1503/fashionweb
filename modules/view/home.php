<?php



require "../../inc/header_home.php";

require 'side_cart.php';

?>

<style>
    .for_someone a {
        color: #fff;
    }
    .for_someone a:hover {
        color: #000;
    }
    .content-vid h2 {
        color: #000;
        font-family: "Montserrat", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
        font-size: 22px;
        font-weight: 400;
        text-transform: uppercase;
    }

    .main_content_container {
        height: 2500px;
    }

    .img-below-vid {
        width: 300px;
        height: 450px;
    }

    @keyframes fade-in {
        from {
            transform: scale(0.8);
            opacity: 0.5;
        }

        to {
            transform: scale(1.2);
            opacity: 1;
        }
    }

    .service-container {
        width: 100%;
        height: 100%;
        background: #000;
        text-align: center;
        height: 850px;
    }

    .title_service {
        font-family: "Montserrat", sans-serif;
        font-size: 30px;
        color: #fff;
        font-weight: 400;
        text-transform: uppercase;
    }

    .services {
        all: unset;
        /* width: 900px; */
        overflow-x: hidden;
    }

    .service-icon {
        max-width: 300px;
    }

    .service-content {
        display: flex;
        justify-content: center;
        color: #fff;
        /* width: 1100px; */
        gap: 30px;
    }

    .content-title {
        margin-top: 40px;
        font-size: 17px;
        text-transform: uppercase;
        font-weight: 600;
        color: #fff;
    }

    .content_p {
        color: #fff;
        font-family: "Montserrat", sans-serif;
        margin: 20px 10px;
        /* padding: 0 18px; */
    }

    .img_service {
        max-width: 300px;
        max-height: 400px;
        overflow: hidden;
    }

    .img_service li {
        list-style-type: none;
    }

    .img_service li a img {
        display: block;
        max-width: 100%;
        max-height: 100%;
        width: 300px;
        height: 400px;
        transition: all 0.3s ease-in-out;
    }

    .img_service li:hover img {
        transform: scale(1.1);
        opacity: 0.8;
    }

    /* =================== SPEACIAL THING ======================*/
    .special-container {
        width: 100%;
        height: 100%;
        background: #fff;
        text-align: center;
        height: 700px;
    }

    .title_special {
        font-family: "Montserrat", sans-serif;
        font-size: 30px;
        color: #000;
        font-weight: 400;
        text-transform: uppercase;
    }

    .img_special li a img {
        width: 250px;
        height: 350px;
    }

    /* ============== CSS TRANSITION ============== */
    .hiddenSpecial {
        opacity: 0;
        filter: blur(5px);
        transform: translateX(-100%);
        transition: all 1s;
    }

    @media(prefers-reduced-motion) {
        .hidden {
            transition: none;
        }
    }

    .show {
        opacity: 1;
        filter: blur(0);
        transform: translateX(0);
    }



    /* =================== BLOG ======================*/
    .blog-container {
        width: 100%;
        height: 100%;
        background: #fff;
        text-align: center;
        height: 800px;
    }

    .title_blog {
        font-family: "Montserrat", sans-serif;
        font-size: 30px;
        color: #000;
        font-weight: 400;
        text-transform: uppercase;
    }
</style>

<link rel="stylesheet" href="../../public/css/style.css" type="text/css">



<div class="main_video_container">
    <div class="video-main">
        <video autoplay muted loop playsinline
            src="../../public/img/LOUIS VUITTON 2021 ｜ High End Jewelry Film ｜ Directed by Augusta Quaynor - Trim.mp4"></video>
    </div>
    <div class="video_content">
        <div class="video_title">
            <h1 style="min-height: 100vh;">STYLE SEEKER</h1>
        </div>
        <section class="hidden">
            <h3>Holiday Collection</h3>
            <p>
                Kendall Jenner and Jessica Chastain star in the first chapter of a four-part campaign to
                celebrate the holidays. Reaching deep into the House’s history and travel-infused origins, the
                first act mirrors The Savoy hotel in London where Guccio Gucci became inspired to establish his
                namesake atelier.
            </p>
            <div>
                <a style="align-items: center; justify-content: center;" id="discover_gift" href="discover.php">DISCOVER STYLESEEKER</a>
            </div>
        </section>
        <section class="hidden">
            <p>
                Join us for the holiday season to find unique gifts and discover the House's latest news!
            </p>
        </section>

        <section class="hidden">
            <p>
                Enjoy an exclusive selection of carefully curated items, perfect for everyone on your list. From
                luxurious accessories to innovative designs, our collection brings together style and
                craftsmanship to make this season truly memorable. Don’t miss out on limited-edition pieces and
                festive surprises that await you—experience the joy of gifting with us today!
            </p>
        </section>

        <section class="hidden">
            <h2>Discover unique holiday elegance.</h2>
            <p>
                "Unwrap joy this holiday season with our thoughtfully curated collection, featuring exceptional
                gifts designed to delight both her and him."
            </p>
            <div class="for_someone_container">
                <span class="for_someone"><a  href="product.php?category=WOMEN">For her</a></span>
                <span class="for_someone"><a  href="product.php?category=MEN">For him</a></span>
            </div>
        </section>
    </div>
</div>
</div>




<section style="z-index: 1; width:100%; background-color:#fff" class="hidden">
    <div class="content_below">
        <h2 id="content_below_h2">MAY WE HELP YOU?</h2>
        <p class="content_below_p">Explore the collection with our Client Advisors and find perfect gifts for your
            loved ones.</p>
        <p class="content_below_p_contact_us" id="open_card_contact_below">Contact Us</p>
        <script>
            // ================================= CONTACT US BELOW =================================
            const openCardContactBelow = document.getElementById('open_card_contact_below')
            const cardContactBelow = document.getElementById('sidecard_contact')
            const closeBtnCardContactBelow = document.getElementById('close_btn_contact')
            const backdropContactBelow = document.querySelector('.backdropContact')

            openCardContactBelow.addEventListener('click', openCardBelow)
            closeBtnCardContactBelow.addEventListener('click', closeCardBelow)
            backdropContactBelow.addEventListener('click', closeCardBelow)

            function openCardBelow() {
                cardContactBelow.classList.add('open')
                backdropContactBelow.style.display = 'block'

                setTimeout(() => {
                    backdropContactBelow.classList.add('show')
                }, 0)
            }

            function closeCardBelow() {
                cardContactBelow.classList.remove('open')
                backdropContactBelow.classList.remove('show')

                setTimeout(() => {
                    backdropContactBelow.style.display = 'none'
                }, 500);
            }

        </script>
    </div>
</section>
<div class="main_content_container">
    <section style=" width: 80%; margin-bottom:100px">
        <div class="each_main_content_container">
            <img class="img-below-vid" src="../../public/img/fashion-voguebus.webp" alt="img-fashion">
            <div class="content-vid">
                <h2>
                    Featured this season
                </h2>
            </div>
        </div>
    </section>
    <section style=" width: 80%; margin-bottom:150px">
        <div class="each_main_content_container">
            <div class="content-vid">
                <h2>
                    Winter 24 hot Trends
                </h2>
            </div>
            <img class="img-below-vid" src="../../public/img/winter24.avif" alt="img-fashion">
        </div>
    </section>


    <!-- Special thing -->
    <div class="special-container">
        <div class="title">
            <div class="line4"
                style="display: flex; align-items: center;justify-content: center;height: 70px;margin-top: 120px;margin-bottom: 10px;">
                <h3 class="title_special">Something special for the holidays</h3>
            </div>
        </div>
        <div class="row service-content"
            style="width: 1100px;margin: 0 auto;display: flex;justify-content: space-between;  ">
            <div class="col-lg-3 col-sm-6 services">
                <div class="special-icon hiddenSpecial">
                    <div class="img_special">
                        <li>
                            <a href="">
                                <img src="../../public/img/special_thing/handbag.jpg" alt="special_thing/handbag.jpg">
                            </a>
                        </li>
                    </div>
                    <h3 style="color:#000; font-weight:400;margin-top: 30px;" class="content-title">Women's Handbags
                    </h3>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 services">
                <div class="special-icon hiddenSpecial" style="transition-delay: 500ms;">
                    <div class="img_special">
                        <li>
                            <a href="">
                                <img src="../../public/img/special_thing/smaillleathergoods.jpg"
                                    alt="special_thing/smaillleathergoods.jpg">
                            </a>
                        </li>
                    </div>
                    <h3 style="color:#000; font-weight:400;margin-top: 30px;" class="content-title">Women's Small
                        Leathergoods</h3>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 services">
                <div class="special-icon hiddenSpecial" style="transition-delay: 1000ms;">
                    <div class="img_special">
                        <li>
                            <a href="">
                                <img src="../../public/img/special_thing/mensbag.jpg" alt="special_thing/mensbag.jpg">
                            </a>
                        </li>
                    </div>
                    <h3 style="color:#000; font-weight:400;margin-top: 30px;" class="content-title">Men's Bags</h3>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 services">
                <div class="special-icon hiddenSpecial" style="transition-delay: 1500ms;">
                    <div class="img_special">
                        <li>
                            <a href="">
                                <img src="../../public/img/special_thing/menssneaker.jpg"
                                    alt="special_thing/menssneaker.jpg">
                            </a>
                        </li>
                    </div>
                    <h3 style="color:#000; font-weight:400;margin-top: 30px;" class="content-title">Men's Sneakers</h3>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Blog -->
    <div class="blog-container">
        <div class="title">
            <div class="line4"
                style="display: flex; align-items: center;justify-content: center;height: 70px;margin-top: 60px;margin-bottom: 20px;">
                <h3 class="title_blog">Blog & News</h3>
            </div>
        </div>
        <div class="row service-content">
            <div class="col-lg-3 col-sm-6 services">
                <div class="service-icon">
                    <div class="img_service">
                        <li>
                            <a href="">
                                <img src="../../public/img/862896e19196336dcfd14d31e22c17bc.jpg" alt="personalization">
                            </a>
                        </li>
                    </div>
                    <h3 style="color:#000" class="content-title">Casual Solid Outerwear</h3>
                    <p style="color:#000" class="content_p">Due to the many variations in monitors, the color in the
                        image could look slightly different, please take physical design and color shall prevail. </p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 services">
                <div class="service-icon">
                    <div class="img_service">
                        <li>
                            <a href="">
                                <img src="../../public/img/21f82730bbf8a8c0478f84e9f19ad7cb.jpg" alt="collection">
                            </a>
                        </li>
                    </div>
                    <h3 style="color:#000" class="content-title">Featured Handbag</h3>
                    <p style="color:#000" class="content_p">We love how our rich espresso brown Charlot bag puts a fresh
                        spin on the classic black handbag. Use the adjustable strap to wear it as a crossbody bag or
                        shoulder bag.</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 services">
                <div class="service-icon">
                    <div class="img_service">
                        <li>
                            <a href="">
                                <img src="../../public/img/e1b4b9f07ad6c4226df428a69455bb35.jpg" alt="membership">
                            </a>
                        </li>
                    </div>
                    <h3 style="color:#000" class="content-title">Nike RYZ 365 2White</h3>
                    <p style="color:#000" class="content_p">Shop Nike RYZ 365 2White (W) and other curated products on
                        LTK, the easiest way to shop everything from your favorite creators.</p>
                </div>
            </div>
        </div>
    </div>

   

</div>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/67696c16af5bfec1dbe0b156/1ifpssepb';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

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
                .footer {
                    position: relative;
                }

                .modal_footer {

                    display: none;
                    /* Ẩn đi khi chưa kích hoạt */
                    position: fixed;
                    position: absolute;
                    z-index: 5;
                    left: 0;
                  
                    margin-top: 0px;
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
                   
                    max-width: 800px;
                    height: 500px;
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
                    position: absolute;
                    top: 0;
                    font-family: "Montserrat", sans-serif;
                    font-optical-sizing: auto;
                    font-weight: 650;
                    font-style: normal;
                    font-size: 13px;
                    color: #000;
                }

                .modal_content_footer a {
                    /* position: absolute; */

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
                    <img src="../../public/img/close.png" alt="X" class="close">
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
                       
                        <i class="fa-regular fa-paper-plane"></i>
                       
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
    <p>© 2020 - 2024 Style Seeker S.p.A. - All rights reserved. SIAE LICENCE # 2294/I/1936 and 5647/I/1936</p>
</div>
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
<script>
    const observerSpecial = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            console.log(entry) // console.log(entry) : print the detail of entry
            if (entry.isIntersecting) { // entry.isIntersecting: true if this element is in the viewport or false otherwise
                entry.target.classList.add('show'); // entry.target: the element is observing 
                // entry.target.classList.add('show'): add class 'show' to the element (to change display style)
            } else {
                entry.target.classList.remove('show');
            }
        });
    });
    const hiddenSpecialElements = document.querySelectorAll('.hiddenSpecial');
    hiddenSpecialElements.forEach((el) => observerSpecial.observe(el)); // observe all hidden elements (to track each class '.hidden' element using IntersectionObserve)
</script>
</body>

</html>