<?php
include('conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM dados WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $nome = $row['id'];
}

if (isset($_POST['excluir'])) {
    $sql = "DELETE FROM dados WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Dado excluído com sucesso";
    } else {
        echo "Erro ao excluir dado: " . mysqli_error($conn);
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
            <h1 class="form_titulo">Excluir Dados</h1>

            <p>Tem certeza que deseja excluir o dado: <?php echo $nome; ?>?</p>

            <form method="POST" class="formulario" action="DeletarDados.php?id=<?php echo $nome; ?>">
                <button type="submit" class="button" name="excluir">Excluir</button>
                <button><a href="ListarDados.php">Voltar</a></button>
            </form>
        </div>
    </main>
</body>
</html>
