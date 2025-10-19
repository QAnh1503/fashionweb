<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kove</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        @font-face {
            font-family: m;
            src: url(./font/MargarethRosinante-Regular.otf);
        }

        body {
            overflow-x: hidden;
            font-family: m;
        }

        section {
            height: 100vh;
            width: 100vw;
            flex-shrink: 0;
        }

        .section-1 {
            display: flex;
        }

        .section-2 {
            transform: translate(5%);
        }

        .main-wrapper {
            display: flex;
        }

        .section-3 {
            background-color: black;
            margin-top: -100vh;
            position: relative;
            overflow: hidden;
        }

        .box1 {
            width: 65%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .name {
            width: 750px;
            font-size: 150px;
        }

        .box2 {
            width: 35%;
        }

        .image-gallery {
            display: flex;
            height: 100vh;
        }

        .col {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        img {
            min-height: 300px;
            height: auto;
            width: 200px;
            object-fit: cover;
            background-color: black;
        }

        .col-1 img,
        .col-3 img {
            padding: 0.2rem 0.5rem;
        }

        .col-2 img {
            padding: 0.2rem 0;
        }

        .wrapper {
            display: flex;
            width: 100%;
            height: 100%;
        }

        .left {
            width: 65%;
            padding: 0 0.8rem;
            padding-left: 0;
            padding-bottom: 0.5rem;
        }

        .left img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        p {
            font-size: 80px;
        }

        .line-1 {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
        }

        .line-2 {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            position: relative;
        }

        .num {
            text-align: left;
            width: 100%;
        }

        .loop {
            height: 30px;
            width: 120px;
            white-space: nowrap;
            overflow: hidden;
            background: none;
            border: 1px solid #444;
            position: absolute;
            top: 75%;
            left: 80%;
            cursor: pointer;
        }

        .loop span {
            animation: loop 10s linear infinite;
            display: inline-block;
            padding-left: 110%;
        }

        .loop2 span {
            animation-delay: 5s;
        }

        @keyframes loop {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(-100%, 0);
            }
        }

        .right {
            width: 35%;
        }

        .animate-text {
            height: 120px;
            background-color: black;
            color: #fff;
            font-size: 100px;
            white-space: nowrap;
            overflow: hidden;
        }

        .animate-text span {
            animation: loop 10s linear infinite;
            display: inline-block;
        }

        .img-container {
            width: 100%;
            height: 780px;
            padding: 0.5rem;
            background-color: black;
        }

        .img-container img {
            width: 100%;
            object-fit: cover;
        }

        .rows {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            gap: 0.5rem;
        }

        .row {
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5rem;
            height: 33.33%;
            color: #fff;
        }

        .row-2 {
            background-color: #fff;
            color: black;
        }

        .row li {
            font-size: 220px;
            transform: translateX(50%);
        }

        .side-bar {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            width: 65px;
            background-color: #fff;
            height: 100%;
            padding: 1rem;
            position: fixed;
            left: -10%;
            top: 0;
            opacity: 0;
            z-index: 11;
        }

        .side-bar div {
            transform: rotate(-90deg);
        }

        .des {
            font-size: 10px;
            width: 200px;
            text-transform: uppercase;
            margin-bottom: 5rem;
        }
    </style>
</head>

<body>
<a  style="padding: 20px;color:#000" href="home.php">Back to Home</a>
    <div class="main-wrapper">
        <section class="section-1">
            <div class="box1">
                <div class="name">Designed just for you in Win</div>
            </div>
            <div class="box2">
                <div class="image-gallery">
                    <div class="col col-1">
                        <img src="../../restaurant/Brand-Website-master/img/col-1_1.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-1_2.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-1_3.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-1_4.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-1_5.jpg" alt="">
                    </div>
                    <div class="col col-2">
                        <img src="../../restaurant/Brand-Website-master/img/col-2_1.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-2_2.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-2_3.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-2_4.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-2_5.jpg" alt="">
                    </div>
                    <div class="col col-3">
                        <img src="../../restaurant/Brand-Website-master/img/col-3_1.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-3_2.webp" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-3_3.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-3_4.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-3_5.jpg" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="section-2">
            <div class="side-bar">
                <i class="fa-solid fa-expand"></i>
                <div class="brand-name">style seeker</div>
                <div class="des">HIGH QUALITY BRANDS. <br>designed just for you<br> in winter.<br></div>
            </div>
            <div class="wrapper">
                <div class="left">
                    <div class="line-1">
                        <p>STYLE SEEKER</p>
                        <div class="copy-right">
                            STYLE SEEKER &#174 <br> 2022-2024.
                        </div>

                    </div>

                    <div class="image-wrapper">
                        <img src="../../restaurant/Brand-Website-master/img/img-1.jpg" alt="">
                    </div>

                    <div class="line-2">
                        <p class="num">/24</p>
                        <p>SPRING</p>
                        <button class="loop">
                            <span>COLLECTION /SHOP&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </button>
                        <button class="loop loop2">
                            <span>COLLECTION /SHOP&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </button>
                    </div>
                </div>
                <div class="right">
                    <div class="animate-text">
                        <span>COLLECTION /19° W</span>
                    </div>
                    <div class="img-container">
                        <img src="../../restaurant/Brand-Website-master/img/im2.jpg" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="section-1">
            <div style="width: 40%; display: flex; align-items: center; justify-content: center;">
                <div class="name">This Winter</div>
            </div>
            <div class="box2">
                <div class="image-gallery">
                    <div class="col col-1">
                        <img src="../../restaurant/Brand-Website-master/img/col-1_1.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-1_2.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-1_3.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-1_4.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-1_5.jpg" alt="">
                    </div>
                    <div class="col col-2">
                        <img src="../../restaurant/Brand-Website-master/img/col-2_1.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-2_2.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-2_3.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-2_4.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-2_5.jpg" alt="">
                    </div>
                    <div class="col col-3">
                        <img src="../../restaurant/Brand-Website-master/img/col-3_1.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-3_2.webp" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-3_3.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-3_4.jpg" alt="">
                        <img src="../../restaurant/Brand-Website-master/img/col-3_5.jpg" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="section-2">
            <div class="side-bar">
                <i class="fa-solid fa-expand"></i>
                <div class="brand-name">style seeker</div>
                <div class="des">HIGH QUALITY BRANDS. <br>designed just for you<br> in winter.<br></div>
            </div>
            <div class="wrapper">
                <div class="left">
                    <div class="line-1">
                        <p>STYLESEEKER</p>
                        <div class="copy-right">
                            STYLE SEEKER &#174 <br> 2022-2024.
                        </div>

                    </div>

                    <div class="image-wrapper">
                        <img src="../../restaurant/Brand-Website-master/img/img-1.jpg" alt="">
                    </div>

                    <div class="line-2">
                        <p class="num">/24</p>
                        <p>WINTER</p>
                        <button class="loop">
                            <span>COLLECTION /SHOP&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </button>
                        <button class="loop loop2">
                            <span>COLLECTION /SHOP&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </button>
                    </div>
                </div>
                <div class="right">
                    <div class="animate-text">
                        <span>COLLECTION /19° W</span>
                    </div>
                    <div class="img-container">
                        <img src="../../restaurant/Brand-Website-master/img/im2.jpg" alt="">
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="section-3">
        <div class="rows">
            <ul class="row row-1" style="width: 100%;">
                <li>Style</li>
                <li>Seeker</li>
                <li>Style</li>
                <li>Seeker</li>
            </ul>
            <ul class="row row-2" style="width: 100%;">
                <li>Seeker</li>
                <li>Style</li>
                <li>Seeker</li>
                <li>Style</li>
               
                <!-- <li>Hạnh</li>
                <li>phúc</li> -->
            </ul>
            <ul class="row row-3" style="width: 100%;">
                <li>Style</li>
                <li>Seeker</li>
                <li>Style</li>
                <li>Seeker</li>
            </ul>
        </div>
    </section>

</body>



<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.0/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollTrigger/1.0.5/ScrollTrigger.min.js"></script>
<!-- <script src="./script.js"></script> -->


</html>
<script>
    let container = document.querySelector(".main-wrapper");
    let section = container.querySelectorAll("section");

    let tl = gsap
        .timeline({
            scrollTrigger: {
                trigger: container,
                scrub: 1,
                pin: true,
                start: "top top",
                end: "+=3300",
            },
        })
        .to(container, {
            x: () =>
                -(container.scrollWidth - document.documentElement.clientWidth - 95) +
                "px",
            ease: "none",
            duration: 1,
        })
        .to(".side-bar", {
            x: 70,
            opacity: 1,
            scrollTrigger: {
                trigger: ".side-bar",
                start: "center+=2500 center",
                scrub: 2.5,
            },
        })
        .to({}, { duration: 1 / (section.length + 1) });

    gsap.to(".col-1", {
        y: -250,
        ease: "none",
        duration: 2,
        scrollTrigger: {
            trigger: ".image-gallery",
            start: "top center",
            end: "+=3000",
            scrub: true,
        },
    });
    gsap.to(".col-2", {
        y: 250,
        ease: "none",
        duration: 2,
        scrollTrigger: {
            trigger: ".image-gallery",
            start: "top center",
            end: "+=3000",
            scrub: true,
        },
    });
    gsap.to(".col-3", {
        y: -250,
        ease: "none",
        duration: 2,
        scrollTrigger: {
            trigger: ".image-gallery",
            start: "top center",
            end: "+=3000",
            scrub: true,
        },
    });

    gsap.from(".row-2", {
        height: "0%",
        duration: 1,
        delay: 0.5,
        scrollTrigger: {
            trigger: ".section-3",
            start: "40% center",
            toggleActions: "play pause reverse reverse",
        },
    });

    gsap.from(".row li", {
        y: 200,
        opacity: 0,
        ease: "none",
        delay: 2,
        duration: 2,
        stagger: {
            amount: 1,
        },
        scrollTrigger: {
            trigger: ".row li",
            toggleActions: "play pause reverse reverse",
        },
    });

    gsap.to(".num", {
        x: 600,
        duration: 2,
        scrollTrigger: {
            trigger: ".num",
            start: "right left",
        },
    });

</script>