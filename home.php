<?php

// Conexão com o bd por require
require_once 'db_connect.php';

//inicio da Sessão 
session_start();
// verificação para não acessar direto
if (!isset($_SESSION['logado'])):
    header('Location:index.php');
endif;
//dados
$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM user WHERE id = '$id'";
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);
//Lembrar de fechar a conexão
mysqli_close($connect);

?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pag de redirecionamento </title>
</head>

<body>
    <h2>Teste ok<?php echo $_SESSION['nome'];?></h2>
    <a href="logout.php">Sair</a>
</body>

</html>