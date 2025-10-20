<?php

// session_start();
// ob_start();

// require "../lib/validation.php";

require "../db/connect.php";
require "../db/database.php";
require "../lib/validation.php";
if (isset($_POST['btn_login'])) {
    $error = array();

    // username
    // if(empty($_POST['username']))
    //     $error['username'] = "Username cannot be left blank !<br>";
    // else
    // {
    //     if ( !(strlen($_POST['username']) >= 6 && strlen($_POST['username'])<=32))
    //     {
    //         $error['username'] = 'The length of character request form 6 to 32.';
    //     }
    //     else
    //     {
    //         if (is_username($_POST['username']))
    //             $user= $_POST['username'];
    //         else
    //             $error['username']= "Username allows the use of letters, numbers, periods, underscores, from 6-32 characters";
    //     }
    // }

    // email
    if (empty($_POST['email']))
        $error['email'] = "This field is mandatory.<br>";
    else {
        if (is_email($_POST['email']))
            $email = $_POST['email'];
        else
            $error['email'] = "Invalid email. Please try again.";
    }

    // password
    if (empty($_POST['password']))
        $error['password'] = "This field is mandatory.<br>";
    else {
        if (!(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 32)) {
            $error['password'] = "The length of character request form 6 to 32.";
        } else {
            if (is_password($_POST["password"]))
                $pass = $_POST["password"];
            else
                $error["password"] = "Invalid password. Please try again.";
        }
    }



    // echo "User: {$email}<br>Password: {$pass}";
    // print_r($error);
    // check again

    $list_users = db_fetch_array("SELECT * FROM tbl_users");
    if (empty($error)) {
        // if (check_login ($email, md5($pass)))
        // {
        //     echo "Login sucessfully!";
        //     //============ Lưu trữ phiên đăng nhập ==============
        //     $_SESSION['is_login']=true;
        //     $_SESSION['email_login']=$email;

        //     if (isset($_POST['remember_me']))
        //     {
        //         setcookie('is_login', true, time()+3600, '/');
        //         setcookie('email_login', $email, time()+3600, '/');
        //     }

        //     //============ Chuyển hướng ==============
        //     redirect_to('index.php');
        // }
        echo "Empty Error!";

        if (is_array($list_users)) {
            foreach ($list_users as $user) {
                if ($email == $user['email'] && md5($pass) == $user['password']) {
                    echo "echo Login sucessfully!";
                    //============ Lưu trữ phiên đăng nhập ==============
                    $_SESSION['is_login'] = true;
                    $_SESSION['email_login'] = $email;

                    if (isset($_POST['remember_me'])) {
                        setcookie('is_login', true, time() + 3600, '/');
                        setcookie('email_login', $email, time() + 3600, '/');
                    }
                    // echo $_SESSION;
                    // echo "<br>" . $_COOKIE;
                    //============ Chuyển hướng ==============
                    // redirect_to('../index.php');
                    redirect_to('home.php');
                } else
                    echo "Invalid email or pass.";
            }
        } else
            $error['account'] = "Email or Password is not exist!";
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="../public/css/reset.css" type="text/css">
    <link rel="stylesheet" href="../public/css/login.css" type="text/css">
    <link rel="stylesheet" href="../public/css/users.css" type="text/css">
    <style>
        /* #wp-form-login {
            padding: 20px;
            text-align: center;
        } */

        #form-login input[type='text'] {
            display: block;
            margin: 5px auto;
            width: 100%;
            height: 40px;
            /* margin-bottom: 15px; */
            margin-top: 40px;
            background: rgb(247 247 248);
            padding: 0 0 0 10px;
            color: #585858;
            border: none;
        }
        #form-login input[type='number'] {
            display: block;
            margin: 5px auto;
            width: 100%;
            height: 40px;
            /* margin-bottom: 15px; */
            margin-top: 40px;
            background: rgb(247 247 248);
            padding: 0 0 0 10px;
            color: #585858;
            border: none;
        }

        #form-login input[type='password'] {
            /* display: block; */
            margin: 5px auto;
            width: 100%;
            height: 40px;
            padding: 0 0 0 10px;
            background: rgb(247 247 248);
            color: #585858;
            border: none;
        }

        #btn_login {
            color: #fff;
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
            background: #000;
            width: 100%;
            height: 50px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            /* margin-top: 20px; */
            margin-bottom: 7px;
            padding: 5px;
            border: none;
            /* border-radius: 5px; */
        }

        #form-login input[type='checkbox'] {
            margin: 0;
            margin-right: 5px;
            /* margin-bottom: 20px; */
        }

        .remember_me {
            cursor: pointer;
            /* color: #000; */
            font-size: 12.5px;
            margin-top: 0.5px;
        }

        #lost-pass {
            display: block;
            /* margin: 0 auto; */
            /* text-align: center; */
            margin: 10px 0 5px 0;
            text-align: right;
            font-size: 12px;
            color: rgb(62 62 62);
        }

        #lost-pass:hover {
            color: #000;
        }

        .form-register {
            max-width: 370px;
            margin: 0 auto;
            text-align: center;
            margin-top: 30px;
        }

        .form-register {
            max-width: 330px;
            margin: 0 auto;
            text-align: center;
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        .form-register p {
            margin-right: 5px;
        }

        .form-register a {
            color: #474747;
            text-decoration: underline;
        }

        .form-register a:hover {
            color: #000;
        }
    </style>
</head>

<body>
    <!-- ============================================ HEADER ============================================-->
    <div id="wrapper">
        <div id="header">
            <ul id="main_menu_bar">
                <li><a href="?">Style Seeker</a></li>
                <!-- <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 86.6 13.6" style="height:100%; enable-background:new 0 0 86.6 13.6;" xml:space="preserve" role="img" focusable="false" aria-labelledby="logoTitle"><title id="logoTitle">Style Seeker</title>
                        <path d="M10.2,8.4H5.6v3.3c0,1.6,1.5,1.6,1.7,1.6v0.2H0v-0.2c0.2,0,1.7-0.1,1.7-1.6V1.8c0-1.6-1.5-1.6-1.7-1.6V0h10.2
                        C13.4,0,15,2.1,15,4.2C15,6.3,13.5,8.4,10.2,8.4z M8.4,0.9H5.6v6.6h2.8c2.1,0,3.1-1.5,3.1-3.3C11.5,2.5,10.5,0.9,8.4,0.9z
                        M28.6,13.6l-6.3-5.2v3.3c0,1.6,1.5,1.6,1.7,1.6v0.2h-7.3v-0.2c0.2,0,1.7-0.1,1.7-1.6V1.8c0-1.6-1.5-1.6-1.7-1.6V0h10.2
                        c3.2,0,4.8,2.1,4.8,4.2c0,2.1-1.5,4.2-4.8,4.2h-3.1c0.7,0.7,2.2,1,3.5,1c0.6,0,1.2-0.1,1.7-0.2l5.2,4.2v0.2
                        C34.2,13.6,28.6,13.6,28.6,13.6z M25.1,0.9h-2.9v6.6h2.9c2.1,0,3.1-1.5,3.1-3.3C28.2,2.5,27.2,0.9,25.1,0.9z M45.4,13.6v-0.2
                        c0.7,0,1-0.2,1-0.7c0-0.2-0.1-0.5-0.2-0.8l-1.4-2.3h-5.7l-1,2c-0.1,0.3-0.2,0.6-0.2,0.9c0,0.5,0.2,0.8,0.8,0.8v0.2h-3.5v-0.2
                        c0.8,0,1.4-0.6,1.9-1.6l4.2-8.4l-1.2-1.9c-0.6-1-1.2-1.2-1.9-1.2V0h5.6l6.8,11.9c0.4,0.7,0.9,1.5,1.8,1.5v0.2H45.4z M41.8,4.3
                        l-2.2,4.3h4.7L41.8,4.3z M61.8,13.6h-8v-0.2c0.2,0,1.7-0.1,1.7-1.6V1.9c0-1.6-1.5-1.6-1.7-1.6V0.1h8c3.6,0,7.3,2.3,7.3,6.8
                        C69.2,11.3,65.4,13.6,61.8,13.6z M64.6,4.3c0-2.5-1.6-3.4-3.3-3.4h-1.9v11.8h1.9c1.7,0,3.3-0.9,3.3-3.4V4.3z M79.6,13.6v-0.2
                        c0.7,0,1-0.2,1-0.7c0-0.2-0.1-0.5-0.2-0.8l-1.3-2.3h-5.7l-1,2c-0.1,0.3-0.2,0.6-0.2,0.9c0,0.5,0.2,0.8,0.8,0.8v0.2h-3.5v-0.2
                        c0.8,0,1.4-0.6,1.9-1.6l4.2-8.4l-1.2-1.9c-0.6-1-1.2-1.2-1.9-1.2V0H78l6.8,11.9c0.4,0.7,0.9,1.5,1.8,1.5v0.2H79.6z M76,4.3l-2.2,4.4
                        h4.7L76,4.3z" style="fill: rgb(0, 0, 0);"></path></svg> -->
            </ul>
            <hr id="horizontal-line">
        </div>
        <!-- end header -->
        <!-- <div> -->
        <div id="wp-form-login">
            <div id="form-login">
                <h2>FORGET PASS</h2>
                <form action="" id="form-user-pass" method="POST">
                    <input type="text" name="email" value="" placeholder="Email">
                    <?php echo form_error('email'); ?>

                    <input style="border: none;
    padding: 5px 7px;
    /* border: 1px solid; */
    /* border: 1px solid #000; */
    background: unset;
    /* background: #000; */
    background: #fff;
    /* color: #fff; */
    border-radius: 2px;
    display: block;
    margin-left: auto;
    /* margin: 0 auto; */
    margin-top: 7px;
    margin-bottom: 10px;
    /* line-height: 2px; */
    text-decoration: underline;" id="sendOtp" type="submit" name="sendOtp" value="Send OTP">

                    <input style="margin-top: 0;" type="number" name="otp" value="" placeholder="OTP code">
                    <?php echo form_error('otp'); ?>

                    <input type="password" name="password" value="" placeholder="New Password">
                    <?php echo form_error('password'); ?><br>

                    <input type="password" name="password" value="" placeholder="New Password Confirmation">
                    <?php echo form_error('password'); ?><br>

                    <?php
                    if (!empty($error['email'])) {
                        ?>
                        <style>
                            #form-login input[type='text'] {
                                border: 1px solid #f80909;
                            }
                        </style>
                        <?php
                    }
                    if (!empty($error['password'])) {
                        ?>
                        <style>
                            #form-login input[type='password'] {
                                border: 1px solid #f80909;
                            }
                        </style>
                        <?php
                    }
                    ?>

                    <br>
                    <br>
                    <input id="btn_login" type="submit" name="btn_login" value="CONTINUE">
                    <?php echo form_error('account'); ?>

                </form>

            </div>
        </div>
        <!-- </div> -->
    </div>

</body>


</html>