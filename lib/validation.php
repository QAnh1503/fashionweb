<?php
    function is_password($password)
{
    $pattern = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
    return preg_match($pattern, $password);
}

function is_email($email)
{
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return preg_match($pattern, $email);
}

function is_username($username)
{
    $pattern = "/^[A-Za-z0-9_\.]{6,32}$/";
    return preg_match($pattern, $username);
}


    // is_phone
    function is_phone($phone)
    {
        // Mẫu regex cho số điện thoại hợp lệ (bắt đầu bằng số 0, bao gồm 10 hoặc 11 chữ số)
        $pattern = "/^0[0-9]{9,10}$/";
        if (!preg_match($pattern, $_POST['phone'], $matchs))
            return false;
        return true;
    }


    // form error
    function form_error($label_field)
    {
        global $error;
        if (!empty($error[$label_field]))
        {
            return "<p class='error' style='color:red; font-size: 12px; font-family: 'Times New Roman', Times, serif;'>{$error[$label_field]}</p>";
        }
    }    


    // set_value
    function set_value ($label_field)
    {
        global $$label_field;
        if (!empty($$label_field)) return $$label_field;
    }



    // redirect to
    // function redirect_to($url, $status = 302) {
    //     header("Location: " . $url, true, $status);
    //     exit(); // Đảm bảo dừng hẳn việc xử lý sau khi chuyển hướng
    // }
    function redirect_to($url = "?page=home")
    {
        if (!empty($url))
            header("Location: {$url}");
        else
            return false;
    }

    //==================== LOGIN =====================
    function check_login ($username, $password)
    {
        // require "../data/users.php";
        global $list_users;
        if (is_array($list_users))
        {
            foreach ($list_users as $user)
            {
                if ($username == $user['username'] && $password == $user['password'])
                {
                    return true;
                }
            }
            return false;
        }
        else echo "list users is not an array";
    }
    #### return true if logged in ####
    function is_login()
    {
        if (isset($_SESSION['is_login']))
            return true;
        return false;
    }
    #### return username of the person logging in ####
    function user_login()
    {
        if (!empty($_SESSION['user_login']))
            return $_SESSION['user_login'];
        return false;
    }

    #### display login information #### ($_SESSION)
    # Case 1:
    // function infor_user ($username, $field='id')
    // {
    //     global $list_users;
    //     if (isset($_SESSION['is_login']))
    //     {
    //         foreach ($list_users as $user)
    //         {
    //             if ($username == $user['username'])
    //             {
    //                 if (array_key_exists($field, $user)) // Hàm in_array là ktra gtri có tồn tại trong mảng hay 0? 
    //                                                                  // Hàm array_key_exists là ktra key có exist in array đó hay 0?
    //                     return $user[$field];
    //             }
    //         }
    //     }
    //     else return false;
    // }
    # Case 2: => should be used
    function infor_user ( $field='id')
    {
        global $list_users;
        if (isset($_SESSION['is_login']))
        {
            foreach ($list_users as $user)
            {
                if ($_SESSION['user_login'] == $user['username'])
                {
                    if (array_key_exists($field, $user)) // Hàm in_array là ktra gtri có tồn tại trong mảng hay 0? 
                                                                     // Hàm array_key_exists là ktra key có exist in array đó hay 0?
                        return $user[$field];
                }
            }
        }
        else return false;
    } 

    #### display login information #### ($_COOKIE)
    // function infor_user ($field='id')
    // {
    //     global $list_users;
    //     if (isset($_COOKIE['is_login']))
    //     {
    //         foreach ($list_users as $user)
    //         {
    //             if (array_key_exists($field, $user))
    //             {
    //                 return $user[$field];
    //             }
    //         }
    //     }
    //     return false;
    // } 

?>