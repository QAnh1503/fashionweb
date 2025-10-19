<?php
function get_products ($start=1, $num_per_page=10, $WHERE='')
{
    global $conn; // Sử dụng từ khóa global để lấy biến $conn từ phạm vi toàn cục
    $query = "SELECT * FROM `product`";
    if (!empty($WHERE))
    {
        // $WHERE = "WHERE {$WHERE}";
        $query .= " WHERE {$WHERE}";
    }
    $query .= " LIMIT {$start}, {$num_per_page}";
    // echo "<br>Query: ".$query;
    $list_products= db_fetch_array($query);
    return $list_products;
}
?>