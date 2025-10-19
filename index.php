<?php
    // require "lib/validation.php"; 
    // if ($_SESSION['is_login']==true)
    // {
    //     echo "Login successfully !";
    //     redirect_to('modules/home.php');
    // }
    // if ($_COOKIE['is_login']==true)
    // {
    //     echo "Login successfully !";
    //     redirect_to('modules/home.php');
    // }
    // else
    //     redirect_to('modules/login.php');
?>

<?php
require "lib/validation.php"; 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Kết nối PostgreSQL</title>
</head>
<body>
  <h1>Test kết nối PostgreSQL</h1>
  <?php include 'db/connect.php'; ?>
  <?php
    redirect_to("modules/view/register_confirm.php");
  ?>

</body>
</html>
