<?php
require 'db.php';

function getProducts($accessToken, $shop) {
    $url = "https://apis.hara.vn/com/products.json"; // Đảm bảo URL này đúng

    // Khởi tạo cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        "Authorization: Bearer {$accessToken}", // Sử dụng Access Token
    ]);

    // Gửi yêu cầu và lấy phản hồi
    $response = curl_exec($ch);
    curl_close($ch);

    // Chuyển đổi phản hồi JSON thành mảng PHP
    $data = json_decode($response, true);
    return $data['products'] ?? []; // Trả về danh sách sản phẩm hoặc mảng rỗng
}

// Kiểm tra hàm
$config = require 'config.php';
$products = getProducts($config['access_token'], $config['shop']);

if (empty($products)) {
    echo "No products found.<br>";
} else {
    echo "Number of products fetched: " . count($products) . "<br>";
}
