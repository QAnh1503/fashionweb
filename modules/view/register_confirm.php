<?php
ob_start();
session_start();
require "../../db/connect.php";
require "../../db/database.php";
require "../../lib/validation.php";

if (isset($_POST['btn_next'])) {
    $error = array();
    $email="";
    // email
    if (empty($_POST['email']))
        $error['email'] = "This field is mandatory.<br>";
    else {
        if (is_email($_POST['email']))
            $email = $_POST['email'];
        else
            $error['email'] = "Invalid email. Please try again.";
    }
    // ========================== RESULT ================================
    // check again
    // if (empty($error))
    // {
    //     $data= array(
    //         'username'=> "QuynhAnhNguyen",
    //         'password' => "Admin123"
    //     );

    //     if ($user== $data['username'] && $pass== $data['password'])
    //     {
    //         // header("Location: index.php");
    //         redirect_to('login.php');
    //     }
    //     else
    //     {
    //         echo "The information of account is not exist in the system !";
    //     }
    // }


    if (empty($error)) {
        echo "Error is empty !";
        // header("Location: index.php");

        // redirect_to('login.php');
        require 'send_mail.php';

        $OTPcode = $num;
        $_SESSION['OTP'] = $OTPcode;
        $_SESSION['email'] = $email;
        echo $OTPcode;
        redirect_to('register.php');
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
        #form-register input[type='text'] {
            margin: 10px auto;
            width: 100%;
            height: 50px;
            background: #fff;
            padding-left: 6px;
            border: 1px solid #b0afaf;
        }
    </style>
    <link rel="stylesheet" href="../../public/css/reset.css" type="text/css">
    <link rel="stylesheet" href="../../public/css/register_confirm.css" type="text/css">
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
            <div id="form-register">
                <h2>REGISTER</h2>
                <form action="" method="POST">

                    <!-- <label for="email">Email: </label> -->
                    <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>"
                        placeholder="Email">
                    <?php echo form_error('email'); ?><br>
                    <?php
                    if (!empty($error['email'])) {
                        ?>
                        <style>
                            #form-register input[type='text'] {
                                border: 1px solid #f80909;
                            }
                        </style>
                        <?php
                    }
                    ?>

                    <br><input id="btn_next" type="submit" name="btn_next" value="NEXT"><br>
                </form>
            </div>
        </div>
    </div>
</body>

</html>