<?php
require 'db.php';


try {
    // Tạo kết nối PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Câu truy vấn SQL
    $sql = "SELECT * FROM products WHERE product_type = :product_type";
    
    // Chuẩn bị câu lệnh truy vấn
    $stmt = $pdo->prepare($sql);

    // Bind giá trị cho biến `:title`
    $stmt->bindParam(':product_type', $product_type);
    
    // Gán giá trị cho biến $title
    $product_type = 'Xiaomi';

    // Thực thi câu truy vấn
    $stmt->execute();

    // Lấy tất cả kết quả
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // In kết quả ra màn hình
    if ($results) {
        echo "<h1>Kết quả truy vấn</h1>";
        foreach ($results as $row) {
            echo "ID: " . $row['id'] . "<br>";
            echo "Title: " . $row['title'] . "<br>";
            echo "Vendor: " . $row['vendor'] . "<br>";
            echo "Product Type: " . $row['product_type'] . "<br>";
            echo "Created At: " . $row['created_at'] . "<br>";
            echo "Updated At: " . $row['updated_at'] . "<br>";
            echo "Description: " . $row['body_html'] . "<br>";
            echo "<hr>";
        }
    } else {
        echo "Không tìm thấy sản phẩm nào.";
    }
} catch (PDOException $e) {
    // Bắt lỗi nếu có vấn đề kết nối hoặc thực thi
    echo "Lỗi kết nối hoặc truy vấn: " . $e->getMessage();
}

?>
