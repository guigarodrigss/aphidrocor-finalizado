<?php
include('conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM usuario WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $nome = $row['nome'];
}

if (isset($_POST['excluir'])) {
    $sql = "DELETE FROM usuario WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: ListarUsuario.php");
    } else {
        echo "Erro ao excluir usuário: " . mysqli_error($conn);
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
            <h1 class="form_titulo">Excluir Usuário</h1>

            <p>Tem certeza que deseja excluir o usuário: <?php echo $nome; ?>?</p>

            <form method="POST" class="formulario" action="DeletarUsuario.php?id=<?php echo $id; ?>">
                <button type="submit" class="button" name="excluir">Excluir</button>
                <button><a href="ListarUsuario.php">Voltar</a></button>
            </form>
        </div>
    </main>
</body>
</html>
