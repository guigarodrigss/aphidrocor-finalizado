<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "monitoramento";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("A conexão falhou: " . mysqli_connect_error());
}

?>