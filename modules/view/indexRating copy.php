<?php 
// session_start();
// ob_start();
// require "../db/connect.php";
// require "../db/database.php";
// require "../lib/validation.php";
// require "../inc/header.php";
// require 'side_cart.php';
    require "purchase_history.php";
    // if (isset($_POST['post_cmt']))
    // {
    //     echo "ACCOUNT ID: ".$account_id;
    //     echo "<br>";
    //     echo "PRODUCT ID: ".$product_id;
    //     // header("Location: ../home.php");
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link GG font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- Link icon Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Rating</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            /* box-sizing: border-box; */
            font-family: 'Poppins', sans-serif;
        }
        body {
            /* display: grid; */
            /* height: 100%; */
            place-items: center;
            text-align: center;
            /* background: #000; */
        }
        .container {
            position: relative;
            width: 390px;
            background-color: #111;
            padding: 20px 30px;
            border: 1px solid #444;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;

        }

        /* POSTED */
         .post {
            display: none;
            z-index: 3;
            position: fixed;

            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            /* ******** */
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .post.open {
            display: block;
        }

         .text {
            font-size: 25px;
            color: #666;
            font-weight: 500;
        }
         .edit {
            /* position: absolute;
            right: 10px;
            top: 5px; */
            font-size: 16px;
            color: #666;
            font-weight: 500;
            cursor: pointer;
        }
         .edit:hover {
            text-decoration: underline;
        }

        /* ***** */
        .star-widget {
            /* display: none; */
            display: block;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 3;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .star-widget.open {
            display: block;
        }


         .star-widget input {
            display: none;
        }

        .star-widget label{
            font-size: 40px;
            color: #444;
            padding: 10px;
            float: right;
            transition: all 0.2s ease;
        }
        input:not(:checked) ~ label:hover,
        input:not(:checked) ~ label:hover ~ label {
            color: #fd4;
        }
        input:checked ~ label {
            color: #fd4;
        }
        input#rate-5:checked ~ label {
            color: #fe7;
            text-shadow: 0 0 20px #952;
        }

        #rate-1:checked ~ form header:before {
            content: "I hate it";
        }
        #rate-2:checked ~ form header:before {
            content: "I don't like it";
        }
        #rate-3:checked ~ form header:before {
            content: "It is awesome";
        }
        #rate-4:checked ~ form header:before {
            content: "I like it";
        }
        #rate-5:checked ~ form header:before {
            content: "I love it";
        }

        .container form {
            display: none;
        }
        input:checked ~ form {
            display: block;
        }
        form header {
            width: 100%;
            font-size: 25px;
            color: #fe7;
            font-weight: 500;
            margin: 5px 0 20px 0;
            text-align: center;
            transition: all 0.2s ease;
        }
        form .textarea {
            height: 100px;
            width: 100%;
            overflow: hidden;
        }
        form .textarea textarea {
            height: 100%;
            width: 100%;
            outline: none;
            color: #eee;
            border: 1px solid #333;
            background: #222;
            padding: 10px;
            font-size: 17px;
            resize: none;
        }
        form .btn {
            height: 45px;
            width: 100%;
            margin: 15px 0;
        }
        form .btn button {
            height: 100%;
            width: 100%;
            border: 1px solid #444;
            outline: none;
            background: #222;
            color: #999;
            font-size: 17px;
            font-weight: 500;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        form .btn button:hover {
            background: #1b1b1b ;
        }


        /* ==== Back Drop ====*/
        .backdropRating {
            /* position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgb(118 118 118 / 50%);

            display: none;
            opacity: 0;
            
            transition: opacity 0.5s ease;
            z-index: 2; */


            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2;
            /* display: none;
            opacity: 0; */

            display: block;
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        .backdropRating.show {
            display: block;
            opacity: 1;
        }

    </style>
    
</head>
<div class="backdropRating"></div>
<body>
    <!-- <div style="text-align: center; display: grid;place-items: center;min-height: 100vh; z-index: 3; position: fixed;width: 100%;"> -->
        <!-- <div class="container"> -->
            <div class="post">
                <div class="text">Thanks for rating us!</div>
                <div class="edit">EDIT</div>
            </div>
            <div class="star-widget">
                <!-- <div style="display:flex; justify-content: center;"> -->

            <form action="save_feedback.php" method="POST">
                <input type="hidden" name="account_id" value="<?php echo $_GET['account_id'] ?>">
                <input type="hidden" name="product_id" value="<?php echo $_GET['product_id'] ?>">
                <input type="hidden" name="order_id" value="<?php echo $_GET['order_id'] ?>">

                <input type="radio" name="rate" value="5" id="rate-5">
                <label for="rate-5" class="fas fa-star"></label>
                <input type="radio" name="rate"  value="4" id="rate-4">
                <label for="rate-4" class="fas fa-star"></label>
                <input type="radio" name="rate"  value="3" id="rate-3">
                <label for="rate-3" class="fas fa-star"></label>
                <input type="radio" name="rate" value="2" id="rate-2">
                <label for="rate-2" class="fas fa-star"></label>
                <input type="radio" name="rate" value="1" id="rate-1">
                <label for="rate-1" class="fas fa-star"></label>

                <!-- </div> -->
                
                
                    <header></header>
                    <div class="textarea">
                        <textarea name="comment" cols="30" placeholder="Describe your experience.."></textarea>
                    </div>
                    <div class="btn">
                        <button type="submit" name="post_cmt">Post</button>
                    </div>
            </form>
            </div>
        <!-- </div> -->
    <!-- </div> -->
    <!-- <script>
        const btn = document.querySelector("button");
        const post = document.querySelector(".post");
        const widget = document.querySelector(".star-widget");
        const editBtn = document.querySelector(".edit");

        btn.onclick = ()=> {
            widget.style.display = 'none';
            post.style.display = 'block';

            editBtn.onclick = ()=> {
                widget.style.display = 'block';
                post.style.display = 'none';
            }
            return false;
        }
    </script> -->
</body>

</html>