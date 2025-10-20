<?php
session_start();
ob_start();
require "../db/connect.php";
require "../db/database.php";
require "../lib/validation.php";

// echo "SESSION: " . $_SESSION['email_login'];
$email_login=$_SESSION['email_login'];

$user_id_active = 0;
$cart_id_active = 0;
$tbl_users = db_fetch_array("SELECT * FROM `tbl_users`");
$tbl_carts = db_fetch_array("SELECT * FROM `carts`");
foreach ($tbl_users as $item) {
    if ($item['email'] == $_SESSION['email_login']) {
        $user_id_active = $item['account_id'];
    }
}
// echo "User Id Active: " . $user_id_active;
foreach ($tbl_carts as $item) {
    if (($item['user_id'] == $user_id_active) && ($item['status']=="Active")) {
        $cart_id_active = $item['cart_id'];
    }
}
// echo "Cart Id Active: " . $cart_id_active;

$list_carts = db_fetch_array("SELECT * FROM `cart_items` WHERE `cart_id`={$cart_id_active}");
$num_rows = db_num_rows("SELECT * FROM `cart_items` where `cart_id`={$cart_id_active}");

// print_r($_SESSION); 

    // if (isset($_COOKIE['is_login']))
    // {
    //     echo "Cookie: ".$_COOKIE['email_login'];
    // }
$listUsers= db_fetch_array("SELECT * FROM `tbl_users`");
$id_user_account=0;
foreach ($listUsers as $user){
    if ($user['email'] == $_SESSION['email_login'])
    {
        $id_user_account= $user['account_id'];
        break;
    }
}
$_SESSION['id_user_account']= $id_user_account;
$current_date = date('Y-m-d');
// echo $current_date;

// $raw_date = '2024-11-29'; 
// $formatted_date = date('d-m-Y', strtotime($raw_date));
// echo $formatted_date; 

// $idProducts= array();
// foreach ($list_carts as $cart)
// {
//     $idProducts[]=$cart['id'];
// }
// print_r($idProducts);
?>
<?php
$cities = [
    "Ha Noi",
    "Ho Chi Minh",
    "Da Nang",
    "Hai Phong",
    "Can Tho", // Thành phố trực thuộc Trung ương
    "Bac Giang",
    "Bac Kan",
    "Bac Ninh",
    "Cao Bang",
    "Dien Bien",
    "Ha Giang",
    "Ha Nam",
    "Hai Duong",
    "Hoa Binh",
    "Hung Yen",
    "Lai Chau",
    "Lang Son",
    "Lao Cai",
    "Nam Dinh",
    "Ninh Binh",
    "Phu Tho",
    "Quang Ninh",
    "Son La",
    "Thai Binh",
    "Thai Nguyen",
    "Tuyen Quang",
    "Vinh Phuc",
    "Yen Bai", // Miền Bắc

    "Binh Dinh",
    "Binh Thuan",
    "Dak Lak",
    "Dak Nong",
    "Gia Lai",
    "Ha Tinh",
    "Khanh Hoa",
    "Kon Tum",
    "Nghe An",
    "Ninh Thuan",
    "Phu Yen",
    "Quang Binh",
    "Quang Nam",
    "Quang Ngai",
    "Quang Tri",
    "Thanh Hoa",
    "Thua Thien - Hue", // Miền Trung

    "An Giang",
    "Ba Ria - Vung Tau",
    "Bac Lieu",
    "Ben Tre",
    "Binh Duong",
    "Binh Phuoc",
    "Ca Mau",
    "Dong Nai",
    "Dong Thap",
    "Hau Giang",
    "Kien Giang",
    "Long An",
    "Soc Trang",
    "Tay Ninh",
    "Tien Giang",
    "Tra Vinh",
    "Vinh Long" // Miền Nam
];
$countries = [
    "Albania",
    "Algeria",
    "Andorra",
    "Angola",
    "Antigua and Barbuda",
    "Argentina",
    "Armenia",
    "Australia",
    "Austria",
    "Azerbaijan",
    "Bahamas",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Belarus",
    "Belgium",
    "Belize",
    "Benin",
    "Bhutan",
    "Bolivia",
    "Bosnia and Herzegovina",
    "Botswana",
    "Brazil",
    "Brunei",
    "Bulgaria",
    "Burkina Faso",
    "Burundi",
    "Cabo Verde",
    "Cambodia",
    "Cameroon",
    "Canada",
    "Central African Republic",
    "Chad",
    "Chile",
    "China",
    "Colombia",
    "Comoros",
    "Congo",
    "Congo (Democratic Republic)",
    "Costa Rica",
    "Croatia",
    "Cuba",
    "Cyprus",
    "Czech Republic",
    "Denmark",
    "Djibouti",
    "Dominica",
    "Dominican Republic",
    "Ecuador",
    "Egypt",
    "El Salvador",
    "Equatorial Guinea",
    "Eritrea",
    "Estonia",
    "Eswatini",
    "Ethiopia",
    "Fiji",
    "Finland",
    "France",
    "Gabon",
    "Gambia",
    "Georgia",
    "Germany",
    "Ghana",
    "Greece",
    "Grenada",
    "Guatemala",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Honduras",
    "Hungary",
    "Iceland",
    "India",
    "Indonesia",
    "Iran",
    "Iraq",
    "Ireland",
    "Israel",
    "Italy",
    "Jamaica",
    "Japan",
    "Jordan",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Korea (North)",
    "Korea (South)",
    "Kuwait",
    "Kyrgyzstan",
    "Laos",
    "Latvia",
    "Lebanon",
    "Lesotho",
    "Liberia",
    "Libya",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Madagascar",
    "Malawi",
    "Malaysia",
    "Maldives",
    "Mali",
    "Malta",
    "Marshall Islands",
    "Mauritania",
    "Mauritius",
    "Mexico",
    "Micronesia",
    "Moldova",
    "Monaco",
    "Mongolia",
    "Montenegro",
    "Morocco",
    "Mozambique",
    "Myanmar",
    "Namibia",
    "Nauru",
    "Nepal",
    "Netherlands",
    "New Zealand",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "North Macedonia",
    "Norway",
    "Oman",
    "Pakistan",
    "Palau",
    "Panama",
    "Papua New Guinea",
    "Paraguay",
    "Peru",
    "Philippines",
    "Poland",
    "Portugal",
    "Qatar",
    "Romania",
    "Russia",
    "Rwanda",
    "Saint Kitts and Nevis",
    "Saint Lucia",
    "Saint Vincent and the Grenadines",
    "Samoa",
    "San Marino",
    "Sao Tome and Principe",
    "Saudi Arabia",
    "Senegal",
    "Serbia",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Slovakia",
    "Slovenia",
    "Solomon Islands",
    "Somalia",
    "South Africa",
    "South Sudan",
    "Spain",
    "Sri Lanka",
    "Sudan",
    "Suriname",
    "Sweden",
    "Switzerland",
    "Syria",
    "Taiwan",
    "Tajikistan",
    "Tanzania",
    "Thailand",
    "Timor-Leste",
    "Togo",
    "Tonga",
    "Trinidad and Tobago",
    "Tunisia",
    "Turkey",
    "Turkmenistan",
    "Tuvalu",
    "Uganda",
    "Ukraine",
    "United Arab Emirates",
    "United Kingdom",
    "United States",
    "Uruguay",
    "Uzbekistan",
    "Vanuatu",
    "Vatican City",
    "Venezuela",
    "Vietnam",
    "Yemen",
    "Zambia",
    "Zimbabwe"
];


$total_cost=0;
foreach ($list_carts as $item)
{
    $total_cost += $item['price']*$item['quantity'];
}
// echo $total_cost;

if (isset($_POST['payment'])) {

    // firstname
    if (empty($_POST['firstname']))
        $error['firstname'] = "This field is mandatory.<br>";
    // else {
    //     if (!(strlen($_POST['firstname']) >= 2 && strlen($_POST['firstname']) <= 32)) {
    //         $error['firstname'] = 'The length of character request form 2 to 32.';
    //     } else {
    //         if (is_username($_POST['firstname']))
    //             $firstname = $_POST['firstname'];
    //         else
    //             $error['firstname'] = "First name allows the use of letters, numbers, periods, underscores, from 6-32 characters";
    //     }
    // }
    // lastname
    if (empty($_POST['lastname']))
        $error['lastname'] = "This field is mandatory.<br>";
    // else {
    //     if (!(strlen($_POST['lastname']) >= 2 && strlen($_POST['lastname']) <= 32)) {
    //         $error['lastname'] = 'The length of character request form 2 to 32.';
    //     } else {
    //         if (is_username($_POST['lastname']))
    //             $lastname = $_POST['lastname'];
    //         else
    //             $error['lastname'] = "Last name allows the use of letters, numbers, periods, underscores, from 6-32 characters";
    //     }
    // }

    // email
    if (empty($_POST['email']))
        $error['email'] = "This field is mandatory.<br>";
    else {
        if (is_email($_POST['email']))
            $email = $_POST['email'];
        else
            $error['email'] = "Email addresses must begin with alphanumeric characters, and may contain special characters such as ., _, %, +, and -. Then there is an @ symbol and the domain name, and finally the domain name extension of 2 or more letters.";
    }


    // phone
    if (empty($_POST['phone']))
        $error['phone'] = "This field is mandatory.<br>";
    else {
        if (is_phone($_POST['phone']))
            $phone = $_POST['phone'];
        else
            $error['phone'] = "Số điện thoại phải bắt đầu bằng số 0 và có tổng cộng 10 hoặc 11 chữ số.";
    }

    // city
    if (empty($_POST['city']))
        $error['city'] = "This field is mandatory.<br>";
    // country
    if (empty($_POST['country']))
        $error['country'] = "This field is mandatory.<br>";
    // address
    if (empty($_POST['address']))
        $error['address'] = "This field is mandatory.<br>";

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["city"])) {
        $selectedCity = str_replace('-', ' ', ucfirst($_POST["city"])); // Chuyển đổi lại về định dạng tên
        // echo "<p>You selected: " . htmlspecialchars($selectedCity) . "</p>";
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["country"])) {
        $selectedCountry = $_POST["country"];
        // echo "<p>You selected: " . htmlspecialchars($selectedCountry) . "</p>";
    }

    // echo "You have just click on Payment Btn";
    // echo "<br>";
    // echo "POST: ";
    // echo "<br>";
    // print_r($_POST);

    // ========================== RESULT ================================

    // if (empty($error)) {
    //     echo "Error is empty !";

    //     if ($code == $OTP) {
    //         echo "Valid OTP code.";
    //         $data = array(
    //             "fullname" => $lastname . " " . $firstname,
    //             "username" => $user,
    //             "account_types" => "User",
    //             "role" => "Customer",
    //             "password" => $pass,
    //             "email" => $email,
    //             "phone" => $phone,
    //             "gender" => $gender,
    //             "account_image" =>"",
    //         );
    //         print_r($data);
    //         db_insert("tbl_users", $data);
    //         echo "Insert successfully !";
    //     }
    //     redirect_to('login.php');
    // } else
    //     print_r($error);
    if (empty($error)) {
        // echo "Error is empty !";
        if (isset($_POST['payment_method'])) {
            // echo $_POST['payment_method'];
            if ($_POST['payment_method'] == "mb_bank") {
                // echo $_POST['account_num'];
                require 'send_mail_checkout.php';

                $OTPcode = $num;
                $_SESSION['OTP'] = $OTPcode;
                // echo "<br>OTP will be sent: ".$OTPcode;

                require "verify_form.php";

                
                // redirect_to('checkout.php');

                // $idProducts= array();
                // $quantities= array();
                // foreach ($list_carts as $cart)
                // {
                //     $idProducts[]=$cart['id'];
                //     $quantities[]= $cart['quantity'];
                // }
                

            }
            if ($_POST['payment_method'] == "zalopay")
            {
                $current_date = date('Y-m-d');

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
            
                $dataStatusUpdate = array(
                    'status' => "Checkout"
                );
                db_update('carts', $dataStatusUpdate, "`cart_id`={$cart_id_active} AND `status`='Active'");
                echo "Insert successfully !";
                // redirect_to("thankyou.php");
                // header("Location: thankyou.php");
                require "../zalopay/payment.php";
            }
        }

    } else
        print_r($error);
}
?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHECKOUT</title>

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

    <link rel="stylesheet" href="../public/css/reset.css" type="text/css">
    <link rel="stylesheet" href="../public/css/cart.css" type="text/css">
    <!-- <script defer src="../public/js/script.js"></script> -->


    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- LINK SELECT 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>


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
            width: 100%;
            display: flex;
            margin-bottom: 7px;
        }

        .selection_img img {
            height: 130px;
            width: 100px;
            object-fit: cover;
        }

        .selection_detail {
            position: relative;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 15px 0 0 15px;
        }

        .selection_detail_1 {
            width: 100%;
        }

        .style_qty {
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
        }

        .selection_detail_1 a {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
            font-size: 12px;
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
            width: 100%;
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

        /* .estimated_total {
                margin: 0;
                margin-top: 3px;
                width: 100%;
                text-align: right;
                color: #747474d1;
                font-size: 13px;
                font-family: "Montserrat", sans-serif;
                font-weight: 400;
            } */



        /* accordion */
        .accordion-item {
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
    <style>
        #header {
            width: 100%;
            height: 100px;
            background-color: #000;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: "Montserrat", sans-serif;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            /* Để bóng hiển thị đúng vị trí */
        }

        .return_cart {
            margin-left: 15px;
        }

        .return_cart a {
            color: #fff;
            font-size: 12px;
        }

        .big_title h1 {
            font-family: 'Times New Roman', Times, serif;
            font-size: 52px;
            font-weight: 400;
        }

        .contact_phone_num {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-right: 15px;
        }

        .contact_phone_num p {
            font-family: "Montserrat", sans-serif;
            font-size: 12px;
        }

        /* =============== MAIN BODY =============== */
        #main_body {
            display: flex;
        }

        /* ======= LEFT PART ======= */
        .left_part {
            margin: 60px 50px 10px 50px;
            width: 700px;
        }

        .right_part {
            margin: 60px 50px 60px 0;
            width: 400px;
        }

        /* UPPER PART */
        #upper_part {
            width: 100%;
            height: 70px;
            border: 1px solid #cecece82;
            padding: 17px;
            font-family: "Montserrat", sans-serif;
            text-align: left;
        }

        #upper_part h3 {
            text-transform: uppercase;
            font-weight: 400;
            color: #000;
            font-size: 15.5px;
        }

        #upper_part p {
            font-family: "Montserrat", sans-serif;
            color: #000;
            font-weight: 400;
            font-size: 11px;
            width: 100%;
            text-align: left;
            margin: 0;
        }

        /* FORM INFORMATION */
        #form-deliver {
            margin-top: 30px;
            width: 100%;
            font-family: "Montserrat", sans-serif;
        }

        #form-deliver h2,
        #form-contact_inf h2 {
            color: #000;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 15px;
            margin-bottom: 10px;
            font-family: "Montserrat", sans-serif;
        }

        #form-deliver p {
            color: #000;
            font-family: "Montserrat", sans-serif;
            margin: 0;
            text-align: left;
            font-size: 11.5px;
        }

        #form-deliver input[type='text'] {
            padding: 10px;
            margin: 5px auto;
            width: 100%;
            height: 50px;
            background-color: #fff;
            border: 1px solid #cecece82;
            font-family: "Montserrat", sans-serif;
        }

        .fullname {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 0px;
        }

        .fullname input {
            flex: 1;

            margin: 0;
            box-sizing: border-box;
            padding: 0;
        }

        #form-deliver input[type='checkbox'] {
            margin: 5px auto;
            font-family: "Montserrat", sans-serif;
        }

        #address {
            padding: 10px;
            width: 100%;
            border-radius: 0;
            height: 50px;
            color: #767070;
            border: 1px solid #cecece82;
            margin: 5px 0 20px 0;
            font-family: "Montserrat", sans-serif;
        }

        #city {
            padding: 10px;
            width: 100%;
            border-radius: 0;
            height: 50px;
            color: #767070;
            border: 1px solid #cecece82;
            margin: 5px 0 20px 0;
            font-family: "Montserrat", sans-serif;
        }

        #country {
            padding: 10px;
            width: 100%;
            border-radius: 0;
            height: 50px;
            color: #767070;
            border: 1px solid #cecece82;
            margin: 5px 0 20px 0;
            font-family: "Montserrat", sans-serif;
        }

        #form-contact_inf {
            margin-top: 20px;
        }

        #form-contact_inf input[type='text'] {
            padding: 5px;
            margin: 5px auto;
            width: 100%;
            height: 50px;
            background-color: #fff;
            border: 1px solid #cecece82;
            font-family: "Montserrat", sans-serif;
        }

        .privacy {
            display: flex;
            /* align-items: center; */
            color: #000;
            margin-top: 5px;
        }

        .privacy i {
            font-size: 12px;
            padding-top: 3px;
        }

        .privacy p {
            font-family: "Montserrat", sans-serif;
            color: #000;
            margin: 0;
            text-align: left;
            width: 100%;
            font-size: 12px;
            margin-left: 5px;
        }

        .error {
            color: red;
            font-size: 12px;
            font-family: "Montserrat", sans-serif;
            text-align: left;
            margin: 0;
        }


        /* ORDER SUMMARY */
        #account_num {
            padding: 10px;
            width: 100%;
            border-radius: 0;
            height: 50px;
            color: #767070;
            border: 1px solid #cecece82;
            margin-top: 20px;
            font-family: "Montserrat", sans-serif;
        }

        /* PAYMENT */
        #payment {
            margin: 0 0 50px 0;
            border: none;
            padding: 18px;
            background: #000;
            color: #fff;
            display: block;
            margin-left: 50px;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }

        #payment:hover {
            opacity: 0.8;
            transform: scale(0.93);
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <!-- ============================================ HEADER ============================================-->
        <div id="header">
            <div class="return_cart">
                <i class="fa-solid fa-chevron-left"></i>
                <a href="cart.php">Back to Shopping Bag</a>
            </div>
            <div class="big_title">
                <h1>Style Seeker</h1>
            </div>
            <div class="contact_phone_num">
                <i class="fa-solid fa-phone-volume"></i>
                <p>+84.399.589.895</p>
            </div>
        </div>
        <!-- ============================================ MAIN ============================================-->
        <div id="main_body">
            <form action="" method="POST">
                <div style="display:flex">
                    <div class="left_part">
                        <div id="upper_part">
                            <h3>You are checking out as:</h3>
                            <p><?php echo $_SESSION['email_login'] ?></p>
                        </div>

                        <div id="form-deliver">
                            <h2>Delivery Address</h2>
                            <p class="text_create_account">Why should we deliver to ?</p>

                            <div class="fullname" style="justify-content: space-between;">
                                <div>
                                    <input style="width:345px; " type="text" name="firstname" id="firstname"
                                        value="<?php echo set_value('firstname'); ?>" placeholder=" First name">
                                    <?php echo form_error('firstname'); ?>
                                </div>

                                <div>
                                    <input style="width:345px;" type="text" name="lastname" class="lastname"
                                        id="lastname" value="<?php echo set_value('lastname'); ?>"
                                        placeholder=" Last name">
                                    <?php echo form_error('lastname'); ?>

                                </div>
                            </div>

                            <!-- =========== ADDRESS ========== -->
                            <input type="text" name="address" id="address" value="<?php echo set_value('address'); ?>"
                                placeholder="Address">
                            <?php echo form_error('address'); ?><br>

                            <!-- ============= CITY ===========-->
                            <select id="city" name="city">
                                <option value="" disabled selected>Choose city</option>
                                <?php foreach ($cities as $city): ?>
                                    <option value="<?= strtolower(str_replace(' ', '-', $city)) ?>"><?= $city ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php echo form_error('city'); ?><br>

                            <!-- ============= COUNTRY ===========-->
                            <select name="country" id="country">
                                <option value="" disabled selected>Select Country</option>
                                <?php
                                foreach ($countries as $country) {
                                    echo "<option value=\"" . htmlspecialchars($country) . "\">" . htmlspecialchars($country) . "</option>";
                                }
                                ?>
                            </select>
                            <?php echo form_error('country'); ?>
                            <br>

                            <?php
                            //if (!empty($error['code'])) {
                            ?>
                            <!-- <style>
                                    #form-deliver input[type='text'][name='code'] {
                                        border: 1px solid #f80909;
                                    }
                                </style> -->
                            <?php
                            //}
                            if (!empty($error['firstname'])) {
                                ?>
                                <style>
                                    #form-deliver input[type='text'][name='firstname'] {
                                        border: 1px solid #f80909;
                                    }
                                </style>
                                <?php
                            }
                            if (!empty($error['lastname'])) {
                                ?>
                                <style>
                                    #form-deliver input[type='text'][name='lastname'] {
                                        border: 1px solid #f80909;
                                    }
                                </style>
                                <?php
                            }
                            if (!empty($error['address'])) {
                                ?>
                                <style>
                                    #form-deliver input[type='text'][name='address'] {
                                        border: 1px solid #f80909;
                                    }
                                </style>
                                <?php
                            }
                            if (!empty($error['city'])) {
                                ?>
                                <style>
                                    #city {
                                        border: 1px solid #f80909;
                                    }
                                </style>
                                <?php
                            }
                            if (!empty($error['country'])) {
                                ?>
                                <style>
                                    #country {
                                        border: 1px solid #f80909;
                                    }
                                </style>
                                <?php
                            }
                            ?>


                        </div>
                        <div id="form-contact_inf">
                            <h2>Contact Infor</h2>
                            <!-- PHONE -->
                            <input type="text" name="phone" id="phone" value="<?php echo set_value('phone'); ?>"
                                placeholder=" Phone number (optional)">
                            <?php echo form_error('phone'); ?><br>

                            <!-- EMAIL -->
                            <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>"
                                placeholder=" Email">
                            <?php echo form_error('email'); ?><br>


                            <?php
                            if (!empty($error['phone'])) {
                                ?>
                                <style>
                                    #form-contact_inf input[type='text'][name='phone'] {
                                        border: 1px solid #f80909;
                                    }
                                </style>
                                <?php
                            }
                            if (!empty($error['email'])) {
                                ?>
                                <style>
                                    #form-contact_inf input[type='text'][name='email'] {
                                        border: 1px solid #f80909;
                                    }
                                </style>
                                <?php
                            }
                            ?>
                            <div class="privacy">
                                <i class="fa-solid fa-unlock-keyhole"></i>
                                <p>Your privacy is important to us. View our policy here. We'll only contact you if
                                    there's an issue with your order.</p>
                            </div>
                        </div>
                    </div>
                    <div class="right_part">
                        <div id="wrapper" class="wp-inner clearfix">
                            <div class="section" id="info-cart-wp">
                                <div class="order_summary">
                                    <div style="padding: 25px;" class="order_container">
                                        <h2 style="text-align: center;font-size: 15px;font-weight: 500;">ORDER
                                            SUMMARY
                                        </h2>
                                        <h3
                                            style="margin-top: 10px;text-align: center;font-size: 12px;font-weight: 500;">
                                            <?php echo $num_rows ?> ITEMS
                                        </h3>
                                        <!-- <hr style="width:30px; height: 1.4px;"> -->
                                        <hr style="height: 0.5px;">

                                        <div class="acoordition">
                                            <div class="accordion-item">
                                                <button class="accordion-header">
                                                    VIEW DETAILS
                                                    <span class="accordion-icon">+</span>
                                                </button>
                                                <div class="accordion-content" style="max-height: none;height: auto;">
                                                    <div class="selections">
                                                        <?php
                                                        foreach ($list_carts as $value) {
                                                            ?>
                                                            <div class="selection">
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
                                                                    <img src="<?php echo $img_pathItem ?>"
                                                                        alt="<?php echo $value['name'] ?>">
                                                                </div>
                                                                <div class="selection_detail">
                                                                    <div class="selection_detail_1"
                                                                        style="display:flex; flex-direction:column; justify-content:space-between">
                                                                        <div style="margin-bottom: 10px;">
                                                                            <a
                                                                                href="detailed_product.php?slug=<?php echo str_replace(' ', '-', $value['name']) ?>&id=<?php echo $value['id'] ?>">
                                                                                <?php echo $value['name']; ?>
                                                                            </a>
                                                                            <div class="style_qty">
                                                                                <p>Style:
                                                                                    <?php echo htmlspecialchars($value['id']); ?>
                                                                                </p>
                                                                                <p style="text-align: right;">QTY:
                                                                                    <?php echo $value['quantity'] ?>
                                                                                </p>
                                                                            </div>
                                                                            <p>Variation:
                                                                                <?php echo htmlspecialchars($value['color']); ?>
                                                                            </p>
                                                                        </div>

                                                                        <div
                                                                            style="position: absolute;bottom: 0;display: flex; width: 235px;justify-content: space-between;">
                                                                            <p style="width: 170px;">Enjoy complimentary
                                                                                delivery or Collect
                                                                                In Store.</p>

                                                                            <p
                                                                                style="position: absolute;right: 0;width: fit-content;bottom:0; font-weight: 550;">
                                                                                <?php
                                                                                $priceItem = $value['price'] * $value['quantity'];
                                                                                echo number_format($priceItem, 0, '.', ',')." "; ?>
                                                                            VND</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <table style="width: 100%;" class="order_tbl">
                                                        <tr>
                                                            <td class="col_1">
                                                                <div class="stock">
                                                                    <p>In Stock:</p>
                                                                    <img class="stock_img" src="../public/img/help.png"
                                                                        alt="help.png">


                                                                    <div class="modal">
                                                                        <div class="modal-contain">
                                                                            <div class="modal-content">
                                                                                <p style="margin-bottom: 15px">GG
                                                                                    Emblem
                                                                                    small
                                                                                    shoulder bag</p>
                                                                                <p>In Stock:</p>
                                                                                <p style="margin-bottom: 15px">
                                                                                    Estimated
                                                                                    delivery within 2 - 3 business
                                                                                    days.
                                                                                    Delivery between 9 am - 8 pm,
                                                                                    Monday
                                                                                    to
                                                                                    Friday. A signature will be
                                                                                    required
                                                                                    upon
                                                                                    delivery.</p>
                                                                                <p style="margin-bottom: 15px">GG
                                                                                    Emblem
                                                                                    small
                                                                                    shoulder bag</p>
                                                                                <p>In Stock:</p>
                                                                                <p>Estimated delivery within 2 - 3
                                                                                    business
                                                                                    days. Delivery between 9 am - 8
                                                                                    pm,
                                                                                    Monday
                                                                                    to Friday. A signature will be
                                                                                    required
                                                                                    upon
                                                                                    delivery.</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <hr style="height: 0.5px;">
                                                </div>
                                            </div>
                                        </div>
                                        <table class="order_tbl">
                                            <tr class="subtotal">
                                                <td class="col_1">Subtotal</td>
                                                <td class="col_2">
                                                    <?php
                                                    $total_cost = 0;
                                                    foreach ($list_carts as $cart) {
                                                        $total_cost += ($cart['price'] * $cart['quantity']);
                                                    }
                                                    echo number_format($total_cost)." VND";
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
                                        </table>
                                        <!-- ACCOUNT NUMBER -->
                                        <h3
                                            style='font-family: "Montserrat", sans-serif;font-weight: 450;font-size: 13px;margin: 30px 0px 20px 0;'>
                                            Choose your payment method:</h3>
                                        <div class="payment-options">
                                            <label>
                                                <input type="radio" name="payment_method" value="zalopay" required>
                                                Bank Transfer via ZaloPay
                                            </label>
                                            <div class="acoordition">
                                                <div class="accordion-item">
                                                    <button class="accordion-header">
                                                        <label>
                                                            <input type="radio" name="payment_method" value="mb_bank">
                                                            Bank Transfer via MB Bank
                                                        </label>
                                                    </button>
                                                    <div class="accordion-content">
                                                        <input type="text" name="account_num" id="account_num"
                                                            value="<?php echo set_value('account_num'); ?>"
                                                            placeholder="Account Number">
                                                        <?php echo form_error('account_num'); ?>
                                                        <div>
                                                            <p class="estimated_total"
                                                                style='margin: 0;margin-top: 3px;width: 100%;text-align: right;color: #747474d1;font-size: 13px;font-family: "Montserrat", sans-serif;font-weight: 400;'>
                                                                Estimated Total :
                                                                <?php
                                                                $total_cost = 0;
                                                                foreach ($list_carts as $cart) {
                                                                    $total_cost += ($cart['price'] * $cart['quantity']);
                                                                }
                                                                echo "$ " . number_format($total_cost);
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <input type="text" name="account_num" id="account_num"
                                        value="<?php //echo set_value('account_num'); ?>" placeholder="Account Number">
                                    <?php //echo form_error('account_num'); ?> -->
                                        <!-- <div>
                                        <p class="estimated_total">Estimated Total :
                                            <?php
                                            // $total_cost = 0;
                                            // foreach ($list_carts as $cart) {
                                            //     $total_cost += ($cart['price'] * $cart['quantity']);
                                            // }
                                            // echo "$ " . number_format($total_cost);
                                            ?>
                                        </p>
                                    </div> -->



                                        <!-- <div class="checkout">
                                        <button>Checkout</button>
                                        <span>OR</span>
                                        <button>PAY WITH</button>
                                        <button>PAY WITH</button>
                                    </div> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><input id="payment" type="submit" name="payment" value="PROCEED TO PAYMENT"><br>
            </form>
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
    <p>© 2016 - 2022 Guccio Gucci S.p.A. - All rights reserved. SIAE LICENCE # 2294/I/1936 and 5647/I/1936</p>
</div>
<script src="../public/js/cart.js"></script>



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
    $(document).ready(function () {
        $('#country').select2({
            placeholder: "Select Country",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#city').select2({
            placeholder: "Choose city",
            allowClear: true
        });
    });
</script>