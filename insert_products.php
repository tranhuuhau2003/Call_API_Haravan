<?php
require 'db.php'; // Kết nối cơ sở dữ liệu
require 'get_products.php'; // Lấy sản phẩm từ API

// Load config
$config = require 'config.php';

// Lấy danh sách sản phẩm
$products = getProducts($config['access_token'], $config['shop']);

// Kiểm tra nếu có sản phẩm để xử lý
if (!empty($products)) {
    foreach ($products as $product) {
        // Chuẩn bị câu lệnh SQL để chèn sản phẩm
        $stmt = $mysqli->prepare("INSERT INTO products (title, vendor, product_type, created_at, updated_at, body_html, body_plain, handle, images, published_at, tags, variants, metafields_global_title_tag, metafields_global_description_tag) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Chuyển đổi mảng variants và images thành JSON để lưu trữ
        $variantsJson = json_encode($product['variants']);
        $imagesJson = json_encode($product['images']);
        
        // Gán giá trị cho các tham số
        $stmt->bind_param("ssssssssssssss",
            $product['title'],
            $product['vendor'],
            $product['product_type'],
            $product['created_at'],
            $product['updated_at'],
            $product['body_html'],
            $product['body_plain'],
            $product['handle'],
            $imagesJson,
            $product['published_at'],
            $product['tags'],
            $variantsJson,
            $product['metafields_global_title_tag'],
            $product['metafields_global_description_tag']
        );

        // Thực hiện chèn và kiểm tra kết quả
        if ($stmt->execute()) {
            echo "Product inserted: <br>";
            echo "<pre>";
            print_r($product); // In ra toàn bộ thông tin của sản phẩm
            echo "</pre><br>";
        } else {
            echo "Error: " . $stmt->error . "<br>";
        }

        // Đóng câu lệnh chuẩn bị sau khi thực hiện
        $stmt->close();
    }
} else {
    echo "No products found.";
}

// Đóng kết nối cơ sở dữ liệu
$mysqli->close();
?>
