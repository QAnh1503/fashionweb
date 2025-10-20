<?php
ob_start();
session_start();
require "../../db/connect.php";
require "../../db/database.php";
require "../../lib/validation.php";

$OTP = $_SESSION['OTP'] ?? null;
$email = $_SESSION['email'] ?? '';

if (!$OTP) {
    echo "<p style='color:red;'>⚠️ OTP chưa được tạo. Vui lòng quay lại bước trước để nhận mã xác thực.</p>";
}
// echo $OTP;
// if (isset($_POST['btn_reg'])) {
//     $error = array();

//     // code
//     if (empty($_POST['code']))
//         $error['code'] = "This field is mandatory.<br>";
//     else
//         $code = $_POST['code'];

//     // firstname
//     if (empty($_POST['firstname']))
//         $error['firstname'] = "This field is mandatory.<br>";
//     else {
//         if (!(strlen($_POST['firstname']) >= 2 && strlen($_POST['firstname']) <= 32)) {
//             $error['firstname'] = 'The length of character request form 2 to 32.';
//         } else {
//             if (is_username($_POST['firstname']))
//                 $firstname = $_POST['firstname'];
//             else
//                 $error['firstname'] = "First name allows the use of letters, numbers, periods, underscores, from 6-32 characters";
//         }
//     }
//     // lastname
//     if (empty($_POST['lastname']))
//         $error['lastname'] = "This field is mandatory.<br>";
//     else {
//         if (!(strlen($_POST['lastname']) >= 2 && strlen($_POST['lastname']) <= 32)) {
//             $error['lastname'] = 'The length of character request form 2 to 32.';
//         } else {
//             if (is_username($_POST['lastname']))
//                 $lastname = $_POST['lastname'];
//             else
//                 $error['lastname'] = "Last name allows the use of letters, numbers, periods, underscores, from 6-32 characters";
//         }
//     }


//     // username
//     if (empty($_POST['username']))
//         $error['username'] = "This field is mandatory.<br>";
//     else {
//         if (!(strlen($_POST['username']) >= 6 && strlen($_POST['username']) <= 32)) {
//             $error['username'] = 'The length of character request form 6 to 32.';
//         } else {
//             if (is_username($_POST['username']))
//                 $user = $_POST['username'];
//             else
//                 $error['username'] = "Username allows the use of letters, numbers, periods, underscores, from 6-32 characters";
//         }
//     }


//     // password
//     if (empty($_POST['password']))
//         $error['password'] = "This field is mandatory.<br>";
//     else {
//         if (!(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 32)) {
//             $error['password'] = "The length of character request form 6 to 32.";
//         } else {
//             if (is_password($_POST["password"]))
//                 $pass = md5($_POST["password"]);
//             else
//                 $error["password"] = "Password allow to use alphabet, numbers, special characters start by capitaline and has 6-32 characters";
//         }
//     }


//     // email
//     if (empty($_POST['email']))
//         $error['email'] = "This field is mandatory.<br>";
//     else {
//         if (is_email($_POST['email']))
//             $email = $_POST['email'];
//         else
//             $error['email'] = "Email addresses must begin with alphanumeric characters, and may contain special characters such as ., _, %, +, and -. Then there is an @ symbol and the domain name, and finally the domain name extension of 2 or more letters.";
//     }


//     // phone
//     if (empty($_POST['phone']))
//         $error['phone'] = "This field is mandatory.<br>";
//     else {
//         if (is_phone($_POST['phone']))
//             $phone = $_POST['phone'];
//         else
//             $error['phone'] = "Số điện thoại phải bắt đầu bằng số 0 và có tổng cộng 10 hoặc 11 chữ số.";
//     }



//     // gender
//     if (empty($_POST["gender"]))
//         $error["gender"] = "This field is mandatory.<br>";
//     else
//         $gender = $_POST["gender"];



//     // ========================== RESULT ================================
//     // check again

//     if (empty($error)) {
//         echo "Error is empty !";
//         // header("Location: index.php");

//         if ($code == $OTP) {
//             echo "Valid OTP code.";
//             $data = array(
//                 "fullname" => $lastname . " " . $firstname,
//                 "username" => $user,
//                 "account_types" => "User",
//                 "role" => "Customer",
//                 "password" => $pass,
//                 "email" => $email,
//                 "phone" => $phone,
//                 "gender" => $gender,
//                 "account_image" =>"",
//             );
//             print_r($data);
//             db_insert("tbl_users", $data);
//             echo "Insert successfully !";
//         }
//         redirect_to('login.php');
//     } else
//         print_r($error);

// }

// if (isset($_POST['btn_reg']))
// {

// }
    if (isset($_POST['btn_reg'])) {
    $error = array();

    // kiểm tra dữ liệu
    $code = $_POST['code'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $user = $_POST['username'];
    $pass = md5($_POST['password']);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    if ($code == $_SESSION['OTP']) {
        $data = array(
            "fullname" => $lastname . " " . $firstname,
            "username" => $user,
            "account_types" => "User",
            "role" => "Customer",
            "password" => $pass,
            "email" => $email,
            "phone" => $phone,
            "gender" => $gender,
            "account_image" => ""
        );

        db_insert("tbl_users", $data);
        redirect_to("login.php");
    } else {
        echo "<p style='color:red;'>❌ OTP không đúng!</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        #select_gender {
            width: 100%;
            border-radius: 0;
            height: 50px;
            color: #767070;
            border: 1px solid #000;
            margin: 5px 0 20px 0;
        }
    </style>
    <link rel="stylesheet" href="../../public/css/reset.css" type="text/css">
    <link rel="stylesheet" href="../../public/css/register.css" type="text/css">
    <link rel="stylesheet" href="../../public/css/users.css" type="text/css">
</head>

<body>
    <!-- ============================================ HEADER ============================================-->
    <div id="wrapper">
        <div id="header">
            <ul id="main_menu_bar">
                <li><a href="?">Style Seeker</a></li>
                
            </ul>
            <hr id="horizontal-line">
        </div>
        <!-- end header -->

        <div id="wp-form-register">

            <!-- Modal -->
            <div id="modal" class="modal">
                <div class="modal-content">
                    <!-- <span class="close">&times;</span> -->
                    <span class="close">X</span>

                    <h3>DETAILS</h3>
                    <p>All your personal data linked to your profile in the PRADA Group customer database will be
                        processed by PRADA Group (i.e. Prada S.p.A., operating holding company of the Prada Group, and
                        its subsidiaries and affiliates, which include, without limitation, PRADA USA Corp.) to manage
                        and enhance your customer experience also in relation to your preferences on Prada, offer you
                        exclusive services and benefits reserved for registered members (e.g.: preservation of your
                        purchase orders history, faster online checkout, global customer service and personalized
                        assistance, simplified procedures for product repair and warranty, invitation to events,
                        pre-sales and other promotional initiatives and special projects, etc.), provide you with
                        information on STYLESEEKER Group products, services and events and for statistics and surveys.
                        As we operate globally, we may securely share your personal information with companies of our
                        group located around the world. We will take all appropriate security and confidentiality
                        measures as required by applicable legislation to ensure an adequate standard of data
                        protection. Privacy laws may grant you certain rights such as the right to access, delete,
                        modify and rectify your data, or to restrict or object to processing. You can withdraw your
                        consent or delete your profile at any time. For further information regarding our privacy
                        practices and your rights, please contact us at privacy@styleseeker.com.</p>

                    <div class="modal-close">
                        <span class="close-container">
                            CLOSE
                            <hr class="underline">
                        </span>
                        <!-- <hr class="underline"> -->
                    </div>
                </div>
            </div>

            <div id="form-register">
                <!-- <h2>REGISTER</h2> -->
                <h2>Create your personal account</h2>
                <p class="text_create_account">You are about to create your account. This will allow us to offer you a
                    personalized and tailored experience both online and in-store, provide you with products, services
                    and information you request from us, communicate with you, and give you access to exclusive services
                    and benefits reserved for registered members to the PRADA Group customer database.
                    <!-- <a href="#" id="moreDetailsBtn">More details</a> -->
                <div id="moreDetailsBtn">
                    <span class="details-container">
                        More details
                        <hr class="underline">
                    </span>
                </div>
                </p>


                <form action="" method="POST">

                    <div id="sent_vertification_code">
                        <img id="img_mail" style="width: 20px; height: 20px; margin-bottom: 10px"
                            src="http://localhost/fashionweb/public/img/Mail.png" alt="Mail">
                        <p><strong>We've sent a verification code to: </strong></p>
                        <p><?php echo htmlspecialchars($email); ?></p>

                    </div>

                    <!-- <label for="fullname">Fullname: </label> -->
                    <input type="text" name="code" id="code" value="<?php echo set_value('code'); ?>"
                        placeholder=" Verification code">
                    <?php echo form_error('code'); ?><br>

                    <div class="fullname" style="justify-content: space-between;">
                        <div>
                            <input style="width:232px; " type="text" name="firstname" id="firstname"
                                value="<?php echo set_value('firstname'); ?>" placeholder=" First name">
                            <?php echo form_error('firstname'); ?>
                        </div>

                        <div>
                            <input style="width:232px;" type="text" name="lastname" class="lastname" id="lastname"
                                value="<?php echo set_value('lastname'); ?>" placeholder=" Last name">
                            <?php echo form_error('lastname'); ?>

                        </div>
                    </div>
                    <div class="error_name">
                    </div>

                    <input type="text" name="phone" id="phone" value="<?php echo set_value('phone'); ?>"
                        placeholder=" Phone number (optional)">
                    <?php //echo form_error('phone'); ?><br>

                    <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>"
                        placeholder=" Username">
                    <?php //echo form_error('username'); ?><br>


                    <input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>"
                        placeholder=" Password">
                    <?php //echo form_error('password'); ?><br>


                    <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>"
                        placeholder=" Email">
                    <?php //echo form_error('email'); ?><br>


                    <select id="select_gender" name="gender">
                        <option value="" disabled selected>Choose Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <?php echo form_error('gender'); ?>
                    <br>
                    <!-- <input placeholder="" type="radio" value="male" class="input-radio" name="gender" <?php //if (!empty($gender) && $gender == 'male')
                        //echo "selected='selected'"; ?>>Male
                    <input placeholder="" type="radio" value="female" class="input-radio" name="gender"<?php //if (!empty($gender) && $gender == 'female')
                        //echo "selected='selected'"; ?>>Female
                    <?php //echo form_error('gender'); ?> -->
                    <br>

                  

                    <label class="custom-checkbox">
                        <input type="checkbox" class="checkbox_agree" id="agree" name="agree[]" value="agree">
                        <span class="checkmark"></span>
                        <span class="label-text">I agree to receive (by email and other forms of electronic
                            communication) commercial communications, including marketing and promotional messages,
                            newsletter, advertising and catalogues concerning Prada and the other brands, products and
                            services of the StyleSeeker Group.</span>
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" class="checkbox_agree" id="agree" name="agree[]" value="agree">
                        <span class="checkmark"></span>
                        <span class="label-text">I agree to be contacted by phone (including automatic telephone dialing
                            system or an artificial or prerecorded voice) or receive text message (to the number phone
                            shown in my profile) with marketing information about products or promotional offers
                            concerning Prada and the other brands, products and services of the StyleSeeker Group, even if my
                            telephone number is on a corporate, state or national Do Not Call Registry.</span>
                    </label>
                    <label class="register_label">
                        By clicking on “Register”, you confirm that you have read and understood our Privacy Statement,
                        you are over 16 years of age and that you want to register.
                    </label>
                    <?php
                    //if (!empty($error['code'])) {
                        ?>
                        <!-- <style>
                            #form-register input[type='text'][name='code'] {
                                border: 1px solid #f80909;
                            }
                        </style> -->
                        <?php
                    // }
                    // if (!empty($error['firstname'])) {
                        ?>
                        <!-- <style>
                            #form-register input[type='text'][name='firstname'] {
                                border: 1px solid #f80909;
                            }
                        </style> -->
                        <?php
                    // }
                    // if (!empty($error['lastname'])) {
                        ?>
                        <!-- <style>
                            #form-register input[type='text'][name='lastname'] {
                                border: 1px solid #f80909;
                            }
                        </style> -->
                        <?php
                    // }
                    // if (!empty($error['username'])) {
                        ?>
                        <!-- <style>
                            #form-register input[type='text'][name='username'] {
                                border: 1px solid #f80909;
                            }
                        </style> -->
                        <?php
                    // }
                    // if (!empty($error['password'])) {
                        ?>
                        <!-- <style>
                            #form-register input[type='password'] {
                                border: 1px solid #f80909;
                            }
                        </style> -->
                        <?php
                    // }
                    // if (!empty($error['phone'])) {
                        ?>
                        <!-- <style>
                            #form-register input[type='text'][name='phone'] {
                                border: 1px solid #f80909;
                            }
                        </style> -->
                        <?php
                    // }
                    // if (!empty($error['email'])) {
                        ?>
                        <!-- <style>
                            #form-register input[type='text'][name='email'] {
                                border: 1px solid #f80909;
                            }
                        </style> -->
                        <?php
                    // }
                    // if (!empty($error['gender'])) {
                        ?>
                        <!-- <style>
                            #select_gender {
                                border: 1px solid #f80909;
                            }
                        </style> -->
                        <?php
                    //}
                    ?>

                    <br><input id="btn_reg" type="submit" name="btn_reg" value="REGISTER"><br>
                </form>
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script>
        const modal = document.getElementById('modal');
        const btn = document.getElementById('moreDetailsBtn');
        const closeBtn = document.querySelector('.close');
        const closeLbl = document.querySelector('.modal-close');

        btn.onclick = function (event) {
            event.preventDefault();
            modal.style.display = 'flex';
        }

        closeBtn.onclick = function () {
            modal.style.display = 'none';
        }

        closeLbl.onclick = function () {
            modal.style.display = 'none';
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>

</html>