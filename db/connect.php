<?php
    // $conn= mysqli_connect("localhost", "root", "", "fashion_website", 3307);
    // if (!$conn)
    // {
    //     echo "Connection failed!"."<br>".mysqli_connect_error();
    //     die();
    // }
?>

<?php
$host = "localhost";
$port = "5432";
$dbname = "fashionweb";
$user = "postgres";
$password = "mypass123"; // thay bằng mật khẩu của bạn

// try {
//     // Kết nối bằng PDO
//     $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;", $user, $password);

//     // Kiểm tra kết nối
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "✅ Kết nối PostgreSQL thành công!";
// } catch (PDOException $e) {
//     echo "❌ Kết nối thất bại: " . $e->getMessage();
// }

    $connection= pg_connect("host=localhost dbname=fashionweb user=postgres password=mypass123");
    if (!$connection)
    {
        echo "Error";
        exit;
    }

?>
