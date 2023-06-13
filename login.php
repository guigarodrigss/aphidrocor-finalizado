<?php
include('conexao.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  if (empty($_POST['telefone'])) {
    echo "Preencha seu telefone.";
    exit;
  }
  
  if (empty($_POST['senha'])) {
    echo "Preencha sua senha.";
    exit;
  }
  
  $telefone = $_POST['telefone'];
  $senha = $_POST['senha'];
  
  $sql = "SELECT * FROM usuario WHERE telefone = '$telefone' AND senha = '$senha'";
  $resultado = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($resultado) == 1) {
    
    $usuario = mysqli_fetch_assoc($resultado);
    $permissao = $usuario['permissao'];
    $nome = $usuario['nome'];
    $setor = $usuario['setor'];
    $id = $usuario['id'];

    $_SESSION['id'] = $usuario['id'];
    $_SESSION['telefone'] = $telefone;
    $_SESSION['permissao'] = $permissao;
    $_SESSION['nome'] = $nome;
    $_SESSION['setor'] = $setor;
    
    function verificarEnvioUsuario($conn, $id) {
      $currentDateTime = new DateTime();
      $currentDateTime->setTimezone(new DateTimeZone('UTC'));
      $currentDate = $currentDateTime->format('Y-m-d');
  
      $sqlDados = "SELECT data_hora FROM dados WHERE id = $id";
      $result = $conn->query($sqlDados);
  
      
      
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastDateTime = new DateTime($row["data_hora"]);
        $lastDateTime->setTimezone(new DateTimeZone('UTC'));
        $lastDate = $lastDateTime->format('Y-m-d');
  
  
        if ($lastDate != $currentDate) {
          $diff = $currentDateTime->diff($lastDateTime);
          if ($diff->days == 0 && $diff->h < 24) {
            return true;
          }
        }
      }
  
      return false;
    }
      
    if (verificarEnvioUsuario($conn, $id)) {
      echo "Você já enviou os dados hoje. Tente novamente após 24 horas.";
    } else {

          if ($permissao == 0) {
            header("Location: formulario.php");
            exit;
          } elseif ($permissao == 1) {
            header("Location: paineladmin.php");
            exit;
          }
        }
      } else {
        echo "Usuário ou senha inválidos.";
      }
    }
    


?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hidrocor - Coleta e organização de dados hidrometeorológicos da Agência Pernambucana de Águas e Clima">
    <title>Hidrocor - Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<style>
  body{
    background-image: url("assets/imgs/Hidrocor_Background.png");
    }
  .formulario_titulo{
    font-family: 'Bebas Neue', sans-serif;
  }
  .form_input1, .form_input2{
    font-family: 'Roboto', sans-serif;
  }
</style>
<body>
    <form class="formulario" method="POST">
        <div class="formulario_left">
            <h1 class="formulario_titulo">LOGIN</h1>
            <label class="form_label" for="user_telefone">TELEFONE</label>
            <input class="form_input1" type="text" placeholder="Informe seu telefone" id="user_telefone" name= "telefone" required>
            <label class="form_label" for="user_pass">SENHA</label>
            <input class="form_input2" type="password" placeholder="Informe sua senha" id="user_pass" name="senha" required>
            <input type="hidden" name="permissao" value="1">
            <button type="submit" class="button" id="entrar">ENTRAR</button>
            <nav class="contatos">
                <a href="https://www.instagram.com/apac_oficial/" target="_blank"><img class="icone" src="assets/imgs/icones/icone_insta.png" alt="Instagram"></a>
                <a href="https://www.youtube.com/c/apacoficial" target="_blank"><img class="icone" src="assets/imgs/icones/icone_youtube.png" alt="Youtube"></a>
                <a href="#"><img class="icone" src="assets/imgs/icones/icone_email.png" alt="E-mail"></a>
                <a href="https://wa.me/5581984941580" target="_blank"><img class="icone" src="assets/imgs/icones/icone_telefone.png" alt="Whatsapp"></a>
            </nav>
        </div>
        <div class="formulario_right" style="justify-content: flex-start;">
            <img class="banner_img" src="assets/imgs/Hidrocor Banner.png" alt="Banner Hidrocor">
        </div>
    </form>
</body>
</html>
