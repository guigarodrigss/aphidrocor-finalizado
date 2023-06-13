<?php
include('conexao.php');

if(isset($_POST['enviar'])){
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"]; 
    $senha = $_POST["senha"];
    $telefone = $_POST["telefone"];
    $setor = $_POST["setor"];
    $permissao = $_POST["permissao"];

    $sql = "INSERT INTO usuario (nome, senha, telefone, setor, permissao) VALUES ('$nome', '$senha', '$telefone','$setor','$permissao')";

    if (mysqli_query($conn, $sql)) {
        echo "Dados inseridos com sucesso";
    } else {
        echo "Erro ao inserir dados: " . mysqli_error($conn);
    }
}
}
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin</title>
    <link rel="stylesheet" href="assets/css/cadastro_us.css">
</head>
<body>
    <main>
        <div class="forms">
            <form method="POST" class="formulario" action="CadastrarUsuario.php">
                <h1 class="form_titulo">Criar Usuário</h1>

                <label class="form_label" for="nome"></label>
                <input class="form_input" type="text" placeholder="Nome Completo" name="nome" id = "nome" required>
                <label class="form_label" for="senha"></label>
                <input class="form_input" type="password" placeholder="Crie uma Senha" name="senha" id = "senha"required>
                <label class="form_label" for="telefone"></label>
                <input class="form_input" type="number" placeholder="Número de Telefone" name="telefone" id = "telefone" required>
                <label for="permissao">Escolha a permissão:</label>
                <select class="form-select" aria-label="Default select example" name="setor" id="setor" required>
                    <option selected></option>
                    <option value="nivel rio">Nível do Rio</option>
                    <option value="Volume da Chuva">Volume da Chuva</option>
                    <option value="Nível do Reservatório">Nível do Reservatório</option>
                    <option value="Todos os campos">Todos os campos</option>
                </select>
                <label for="permissao">Escolha o Tipo de acesso:</label>
                <select class="form-select" aria-label="Default select example" name="permissao" id="permissao" required>
                    <option selected></option>
                    <option value="1">Administrador</option>
                    <option value="0">Usuário</option>
                </select>
                <button type="submit" class="button" name = "enviar">Criar usuário</button>
                <button><a href="paineladmin.php">Voltar</button>
                <img class="form_img" src="assets/imgs/Logo_apac.png" alt="Logo Apac">
            </form>
        </div>
    </main>
</body>
</html>