<?php
$host = 'localhost'; // Địa chỉ máy chủ
$db = 'haravan'; // Tên cơ sở dữ liệu
$user = 'root'; // Tên người dùng
$pass = ''; // Mật khẩu

// Kết nối đến cơ sở dữ liệu
$mysqli = new mysqli($host, $user, $pass, $db);

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} else {
    echo "Connected successfully to the database.<br>";
}
