<?php
session_start();
require "../db/connect.php"; // Kết nối cơ sở dữ liệu
require "../db/database.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_cmt'])) {
    // Kiểm tra và gán giá trị từ $_POST
    $account_id = isset($_POST['account_id']) ? intval($_POST['account_id']) : null;
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : null;
    $order_id=  isset($_POST['order_id']) ? intval($_POST['order_id']) : null;
    $rating = isset($_POST['rate']) ? intval($_POST['rate']) : null;
    $comment = isset($_POST['comment']) ? htmlspecialchars(trim($_POST['comment'])) : null;
    $currentDate = date('Y-m-d'); // Định dạng: YYYY-MM-DD

    // Echo ra các giá trị để kiểm tra
    echo "Account ID: " . $account_id . "<br>";
    echo "Product ID: " . $product_id . "<br>";
    echo "Order ID: " . $order_id . "<br>";
    echo "Rating: " . $rating . "<br>";
    echo "Comment: " . $comment . "<br>";
    echo $currentDate;
    // var_dump($_POST);

    $data = array(
        'account_id' => $account_id,
        'product_id' => $product_id,
        'order_id' => $order_id,
        'rating' => $rating,
        'comment' => $comment,
        'created_at' => $currentDate,
    );
    db_insert("feedback", $data);
    echo "Insert successfully!";

    header("Location: purchase_history.php");

} else {
    echo "Invalid request.";
}
?>
