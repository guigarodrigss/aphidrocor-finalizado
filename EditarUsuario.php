<?php
include('conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM usuario WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $nome = $row['nome'];
    $senha = $row['senha'];
    $telefone = $row['telefone'];
    $setor = $row['setor'];
    $permissao = $row['permissao'];
    $mensagem = '';
}

if (isset($_POST['enviar'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $senha = $_POST["senha"];
        $telefone = $_POST["telefone"];
        $setor = $_POST["setor"];
        $permissao = $_POST["permissao"];

        $sql = "UPDATE usuario SET nome='$nome', senha='$senha', telefone='$telefone', setor='$setor', permissao='$permissao' WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            echo "Dados atualizados com sucesso!!!";
        } else {
            $mensagem =  "Erro ao atualizar dados: " . mysqli_error($conn);
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
            <form method="POST" class="formulario" action="EditarUsuario.php?id=<?php echo $id; ?>">
                <h1 class="form_titulo">Editar Usuário</h1>
                <p><?php $mensagem 
                ?></p>

                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <label class="form_label" for="nome">Nome Completo:</label>
                <input class="form_input" type="text" placeholder="Nome Completo" name="nome" id="nome" value="<?php echo $nome; ?>">

                <label class="form_label" for="senha">Senha:</label>
                <input class="form_input" type="password" placeholder="Crie uma Senha" name="senha" id="senha" value="<?php echo $senha; ?>">

                <label class="form_label" for="telefone">Telefone:</label>
                <input class="form_input" type="number" placeholder="Número de Telefone" name="telefone" id="telefone" value="<?php echo $telefone; ?>">

                <label for="setor">Escolha o Setor:</label>
                <select class="form-select" aria-label="Default select example" name="setor" id="setor">
                    <option selected></option>
                    <option value="nivel rio" <?php if ($setor == 'nivel rio') echo 'selected'; ?>>Nível do Rio</option>
                    <option value="Volume da Chuva" <?php if ($setor == 'Volume da Chuva') echo 'selected'; ?>>Volume da Chuva</option>
                    <option value="Nível do Reservatório" <?php if ($setor == 'Nível do Reservatório') echo 'selected'; ?>>Nível do Reservatório</option>
                    <option value="Todos os campos" <?php if ($setor == 'Todos os campos') echo 'selected'; ?>>Todos os campos</option>
                </select>

                <label for="permissao">Escolha o Tipo de Acesso:</label>
                <select class="form-select" aria-label="Default select example" name="permissao" id="permissao">
                    <option selected></option>
                    <option value="1" <?php if ($permissao == '1') echo 'selected'; ?>>Administrador</option>
                    <option value="0" <?php if ($permissao == '0') echo 'selected'; ?>>Usuário</option>
                </select>

                <button type="submit" class="button" name="enviar">Salvar</button>
                <button><a href="paineladmin.php">Voltar</a></button>
                <img class="form_img" src="/CURSOAPAC2/assets/imgs/Logo_apac.png" alt="Logo Apac">
            </form>
        </div>
    </main>
</body>
</html>
