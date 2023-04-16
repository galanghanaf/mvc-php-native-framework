<?php 
define("BASE_URL", "http://localhost/php-mvc/");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "db_mvc");

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
