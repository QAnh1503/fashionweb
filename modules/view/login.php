<?php

session_start();
ob_start();

 
require "../../db/connect.php";
require "../../db/database.php";
require "../../lib/validation.php";
if (isset($_POST['btn_login'])) {
    $error = array();

    redirect_to('home.php');
    // email
    // if (empty($_POST['email']))
    //     $error['email'] = "This field is mandatory.<br>";
    // else {
    //     if (is_email($_POST['email']))
    //         $email = $_POST['email'];
    //     else
    //         $error['email'] = "Invalid email. Please try again.";
    // }

    // password
    // if (empty($_POST['password']))
    //     $error['password'] = "This field is mandatory.<br>";
    // else {
    //     if (!(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 32)) {
    //         $error['password'] = "The length of character request form 6 to 32.";
    //     } else {
    //         if (is_password($_POST["password"]))
    //             $pass = $_POST["password"];
    //         else
    //             $error["password"] = "Invalid password. Please try again.";
    //     }
    // }




    // $list_users = db_fetch_array("SELECT * FROM `tbl_users`");
    // if (empty($error)) {
       
    //     echo "Empty Error!";

    //     if (is_array($list_users)) {
    //         foreach ($list_users as $user) {
    //             if ($email == $user['email'] && md5($pass) == $user['password']) {
    //                 echo "echo Login sucessfully!";
    //                 //============ Lưu trữ phiên đăng nhập ==============
    //                 $_SESSION['is_login'] = true;
    //                 $_SESSION['email_login'] = $email;

    //                 if (isset($_POST['remember_me'])) {
    //                     setcookie('is_login', true, time() + 3600, '/');
    //                     setcookie('email_login', $email, time() + 3600, '/');
    //                 } 
                  
    //                 redirect_to('home.php');
    //             } else
    //                 echo "Invalid email or pass.";
    //         }
    //     } else
    //         $error['account'] = "Email or Password is not exist!";
    // }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="../../public/css/reset.css" type="text/css">
    <link rel="stylesheet" href="../../public/css/login.css" type="text/css">
    <link rel="stylesheet" href="../../public/css/users.css" type="text/css">
    <style>

        #form-login input[type='text'] {
            display: block;
            margin: 5px auto;
            width: 100%;
            height: 40px;
            margin-top: 40px;
            background: rgb(247 247 248);
            padding: 0 0 0 10px;
            color: #585858;
            border: none;
        }

        #form-login input[type='password'] {
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
            margin-bottom: 7px;
            padding: 5px;
            border: none;
        }

        #form-login input[type='checkbox'] {
            margin: 0;
            margin-right: 5px;
        }

        .remember_me {
            cursor: pointer;
            font-size: 12.5px;
            margin-top: 0.5px;
        }

        #lost-pass {
            display: block;
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
                
            </ul>
            <hr id="horizontal-line">
        </div>
        <!-- end header -->
        <div id="wp-form-login">
            <div id="form-login">
                <h2>LOGIN</h2>
                <form action="" id="form-user-pass" method="POST">
                    <input type="text" name="email" value="" placeholder="Email">
                    <?php echo form_error('email'); ?><br>

                    <input type="password" name="password" value="" placeholder="Password">
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

                    <div style="display:flex; align-items: center;margin-bottom: 25px;">
                        <input type="checkbox" name="remember_me" value="" id="remember_me" class="remember_me">
                        <label for="remember_me" class="remember_me">Remember me</label>
                    </div>
                    <a href="" id="lost-pass">Forget password?</a>

                    <input id="btn_login" type="submit" name="btn_login" value="LOGIN">
                    <?php echo form_error('account'); ?>

                </form>

            </div>
            <div class="form-register">
                <p>You don't have account?</p>
                <a href="register_confirm.php">Register</a>
            </div>
        </div>
    </div>

</body>


</html>