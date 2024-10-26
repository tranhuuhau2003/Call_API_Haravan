<?php
require 'db.php';
require 'get_products.php'; // Lấy sản phẩm từ API

// Load config
$config = require 'config.php';

// Lấy danh sách sản phẩm
$products = getProducts($config['access_token'], $config['shop']);

// Kiểm tra nếu có sản phẩm để xử lý
if (!empty($products)) {
    echo "<h1>Danh sách sản phẩm:</h1>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Title</th>
            <th>Vendor</th>
            <th>Product Type</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Handle</th>
            <th>Published At</th>
            <th>Tags</th>
            <th>Variants</th>
            <th>Images</th>
            <th>Meta Title Tag</th>
            <th>Meta Description Tag</th>
          </tr>";

    foreach ($products as $product) {
        // Chuyển đổi mảng variants và images thành chuỗi JSON
        $variantsJson = json_encode($product['variants']);
        $imagesJson = json_encode($product['images']);
        
        echo "<tr>
                <td>{$product['title']}</td>
                <td>{$product['vendor']}</td>
                <td>{$product['product_type']}</td>
                <td>{$product['created_at']}</td>
                <td>{$product['updated_at']}</td>
                <td>{$product['handle']}</td>
                <td>{$product['published_at']}</td>
                <td>" . ($product['tags'] ?? 'No Tags') . "</td>
                <td>{$variantsJson}</td>
                <td>{$imagesJson}</td>
                <td>{$product['metafields_global_title_tag']}</td>
                <td>{$product['metafields_global_description_tag']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No products found.";
}
?>
