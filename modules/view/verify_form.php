<?php

if (isset($_POST['verify'])) {
    session_start();
    require "../db/connect.php";
    require "../db/database.php";
    $id_user_account= $_SESSION['id_user_account'];
    $current_date = date('Y-m-d');
    $cart_id_active = 0;
    $tbl_carts = db_fetch_array("SELECT * FROM `carts`");
    foreach ($tbl_carts as $item) {
        if ($item['user_id'] == $id_user_account) {
            $cart_id_active = $item['cart_id'];
        }
    }
    echo "Cart Id Active: " . $cart_id_active;

    $list_carts = db_fetch_array("SELECT * FROM `cart_items` WHERE `cart_id`={$cart_id_active}");
    // echo "verify: ";
    // echo "<br>";
    // print_r($_POST);
    // echo "<br>";
    $otpcode= $_POST['otp1'];
    $otpcode.= $_POST['otp2'];
    $otpcode.= $_POST['otp3'];
    $otpcode.= $_POST['otp4'];
    $otpcode.= $_POST['otp5'];
    $otpcode.= $_POST['otp6'];

    echo "optcode".$otpcode;
    echo "<br>";
    echo "session otp".$_SESSION['OTP'];
   
    if ($_SESSION['OTP'] == $otpcode)
    {        
        $data1= array (
            "user_id" => $id_user_account,
            "date" => $current_date
        );
        // Thêm đơn hàng vào bảng "orders" và lấy ID của đơn hàng vừa tạo
        $order_id = db_insert("orders", $data1);

        foreach ($list_carts as $cart)
        {
            $data2 = array(
                // "fullname" => $lastname . " " . $firstname,
                // "email" => $email,
                // "phone" => $phone,
                // "date" => $current_date,
                "order_id" => $order_id, // Liên kết với đơn hàng vừa tạo
                "product_id" => $cart['id'],
                "quantity" => $cart['quantity']
            );
            db_insert("order_details", $data2);
        }
        

        // print_r($data);

        // db_insert("history_purchase", $data);


    
        $dataStatusUpdate = array(
            'status' => "Checkout"
        );
        db_update('carts', $dataStatusUpdate, "`cart_id`={$cart_id_active} AND `status`='Active'");
        // echo "Insert successfully !";
        // redirect_to("thankyou.php");
        header("Location: thankyou.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP VERIFY</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Abel&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Play:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Shadows+Into+Light&family=Space+Grotesk:wght@300..700&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        .form {
            font-family: "Montserrat", sans-serif;
            width: 500px;
            height: 300px;
            margin: auto;
            background-color: #fff;
            border-radius: 10px;
            top: 50%;
            /* Căn giữa theo chiều dọc */
            left: 50%;
            /* Căn giữa theo chiều ngang */
            transform: translate(-50%, -50%);
            /* Đưa form về chính giữa */
        }

        .form h2 {
            color: #000;
            margin-top: 50px;
            font-size: 24px;
            font-weight: 500;
        }

        .form p {
            font-size: 11px;
            display: block;
            margin: auto;
            width: 400px;
        }

        .fields-input {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 15px 0;
        }

        .otp_field {
            border-radius: 5px;
            font-size: 40px;
            height: 50px;
            width: 50px;
            border: 3px solid #cacaca;
            margin: 1%;
            text-align: center;
            font-weight: 600;
            outline: none;
        }

        .otp_field::-webkit-inner-spin-button,
        .otp_field::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .otp_field:valid {
            border-color: #000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
            /* Bóng đen mềm */
        }

        #verify {
            border: none;
            background-color: #000;
            border-radius: 0;
            color: #fff;
            width: 150px;
            height: 40px;
            font-family: "Montserrat", sans-serif;
            font-weight: 500;
            transition: transform 0.3s ease;
        }

        #verify:hover {
            opacity: 0.8;
            transform: scale(0.93);
        }

        @media only screen and (max-width:455px) {
            .otp_field {
                font-size: 30px;
                height: 30px;
                width: 30px;
            }
        }

        /* ==== Back Drop ====*/
        .backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 3;
            display: block;
            opacity: 1;
            transition: opacity 0.5s ease;
        }
    </style>
</head>



<body>
    <!-- Backdrop -->
    <div class="backdrop"></div>

    <div class="form" style="text-align:center;  position: fixed;z-index:4">
        <h2>Verify Your Account</h2>
        <p>We emailed you the six digit otp code to Enter the code below to confirm your email address...</p>
        <form action="verify_form.php" autocomplete="off" method="POST">
            <!-- <div class="error-text">Error
            </div> -->
            <div class="fields-input">
                <input type="number" name="otp1" class="otp_field" placeholder="0" min="0" max="9" required
                    onpaste="false">
                <input type="number" name="otp2" class="otp_field" placeholder="0" min="0" max="9" required
                    onpaste="false">
                <input type="number" name="otp3" class="otp_field" placeholder="0" min="0" max="9" required
                    onpaste="false">
                <input type="number" name="otp4" class="otp_field" placeholder="0" min="0" max="9" required
                    onpaste="false">
                <input type="number" name="otp5" class="otp_field" placeholder="0" min="0" max="9" required
                    onpaste="false">
                <input type="number" name="otp6" class="otp_field" placeholder="0" min="0" max="9" required
                    onpaste="false">
            </div>
            <div class="submit">
                <input type="submit" name="verify" id="verify" class="button" value="Verify Now">
            </div>
        </form>
    </div>

    <script>
        const otp = document.querySelectorAll('.otp_field');
        // focus on first input
        otp[0].focus();
        otp.forEach((field, index) => {
            field.addEventListener('keydown', (e) => {
                if (e.key >= 0 && e.key <= 9) {
                    otp[index].value = "";
                    setTimeout(() => {
                        otp[index + 1].focus();
                    }, 6);
                }
                else if (e.key === 'Backspace') {
                    setTimeout(() => {
                        otp[index - 1].focus();
                    }, 6);
                }
            });
        });
    </script>
</body>

</html>