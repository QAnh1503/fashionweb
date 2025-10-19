<?php

session_start();
ob_start();

 
require "../../db/connect.php";
require "../../db/database.php";
require "../../lib/validation.php";

$error = [];
$email = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // --- Email ---
    if (empty($email)) {
        $error['email'] = "This field is mandatory.";
    } elseif (!is_email($email)) {
        $error['email'] = "Invalid email. Please try again.";
    }

    // --- Password ---
    if (empty($password)) {
        $error['password'] = "This field is mandatory.";
    } elseif (!(strlen($password) >= 3 && strlen($password) <= 32)) {
        $error['password'] = "Password must be between 3 and 32 characters.";
    }

    // --- Chỉ chạy khi không có lỗi ---
    if (empty($error)) {
        $query = "SELECT * FROM tbl_users WHERE email = $1 LIMIT 1";
        $result = pg_query_params($connection, $query, [$email]);

        if ($result && pg_num_rows($result) > 0) {
            $user = pg_fetch_assoc($result);
            if (md5($password) == $user['password']) {
                $_SESSION['is_login'] = true;
                $_SESSION['email_login'] = $email;
                header("Location: home.php");
                exit();
            } else {
                $error['account'] = "Invalid email or password.";
            }
        } else {
            $error['account'] = "Invalid email or password.";
        }
    }
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
                    <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Email">
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