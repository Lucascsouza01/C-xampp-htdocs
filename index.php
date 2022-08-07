<?php
// Conexão com o bd por require
require_once 'db_connect.php';

//Sessão 
session_start();

//BTN ENVIAR
if(isset($_POST['btn-login'])):
    $erros = array();
    $login = mysqli_escape_string($connect, $_POST['login']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);

    // criação de variaveis para teste de erros
    if(empty($login) or empty($senha)):
        $error[] = "<li> Preencha o campo Login/Senha:<br></li>";
   //verificação se existe no bd
    else:
        $sql = "SELECT login FROM user WHERE login = '$login'";
        $resultado = mysqli_query($connect, $sql);
      
     
        //verificação de login digitado existe no bd
        if (mysqli_num_rows($resultado) > 0):
            // criptografia da senha
            $senha = md5($senha);
            //verificação de login digitado existe no bd
            $sql = "SELECT * FROM user WHERE login = '$login' AND senha = '$senha'";
            $resultado = mysqli_query($connect, $sql);

            if (mysqli_num_rows($resultado) == 1):
                // fetch converte o resultado a um array e atribui a dados.
                $dados = mysqli_fetch_array($resultado);
            //lembrar de sempre fechar a conexão
                mysqli_close($connect);
                $_SESSION['logado'] = true;
                $_SESSION['id_usuario'] = $dados['id'];
                //redirecionar o usuario
                header('Location: home.php');
            else:
                $erros[] = "<li>Usuário e senha não conferem</li>";
            endif;

        else:
            $erros[] = "<li> Usuário não existe</li>";
        endif;
    endif;
endif;
?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>

</head>

<body>
    <h1>Login</h1>
    <!--Para verificar algum possivel erro-->
    <?php
    if(!empty($erros)):
        foreach ($erros as $erro):
        echo $erro;
    endforeach;
endif;
    
?>
    <hr>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" id="form">
        Login:
        <input type="text" name="login">
        Senha:
        <input type="password" name="senha">
        <button type="submit" name="btn-login" id="btn">Entrar</button>

    </form>
</body>

</html>