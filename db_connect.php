<?php
// Conexão com banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "system_login";

$connect = mysqli_connect($servername, $username, $password, $db_name);
//saber se o bd está ok
if(mysqli_connect_error()){
    echo "falha na conexão" . mysqli_connect_error();
}

?>