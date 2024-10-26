<?php
require 'db.php';

// $sql = "CREATE INDEX idx_title ON products(title);";
$sql = "SELECT * FROM products WHERE title = 'Xiaomi Redmi Note 13';";

$mysqli->query($sql);
$mysqli->close();

