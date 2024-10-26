<?php
require 'db.php';

// Tạo bảng
$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    vendor VARCHAR(255),
    product_type VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME,
    body_html TEXT,
    body_plain TEXT,
    handle VARCHAR(255),
    images TEXT,
    published_at DATETIME,
    tags TEXT,
    variants TEXT,
    metafields_global_title_tag VARCHAR(255),
    metafields_global_description_tag VARCHAR(255)
)";

if ($mysqli->query($sql) === TRUE) {
    echo "Table products created successfully<br>";
} else {
    echo "Error creating table: " . $mysqli->error;
}

$mysqli->close();
