<?php
session_start();
include('conexao.php');

$setor = $_SESSION['setor'];
$id = $_SESSION['id'];

$nivelRioDisabled = '';
$volumeChuvaDisabled = '';
$nivelReservatorioDisabled = '';

if($setor === 'nivel rio')
{
    $volumeChuvaDisabled = 'disabled';
    $nivelReservatorioDisabled = 'disabled';
}
else if($setor === 'Volume da Chuva')
{
    $nivelRioDisabled = 'disabled';
    $nivelReservatorioDisabled = 'disabled';
}
else if($setor === 'Nível do Reservatório')
{
    $nivelRioDisabled = 'disabled';
    $volumeChuvaDisabled = 'disabled';
}

if(isset($_POST['enviar']))
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $nivelRio ='';
        if(isset($_POST["nivel_rio"]))
        {
            $nivelRio = $_POST["nivel_rio"];
        }

        $volumeChuva = '';

        if(isset($_POST["volume_chuva"]))
        {
            $volumeChuva = $_POST["volume_chuva"];
        }

        $nivelReservatorio = '';

        if(isset($_POST["nivelReservatorio"]))
        {
            $nivelReservatorio = $_POST["nivelReservatorio"];
        }

        $sql = "INSERT INTO dados(nivel_rio, nivel_chuva, nivel_reservatorio,id)
        VALUES ('$nivelRio', '$volumeChuva', '$nivelReservatorio', '$id')";

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
    <title>Dados</title>
    <link rel="stylesheet" href="assets/css/formulario.css">
</head>
<body>
    <div class="forms">
        <form class="formulario" method="POST" action = "formulario.php">
        <h1 align='center'>Bem vindo ao sistema, <br><?php echo isset($_SESSION['nome']) ? $_SESSION['nome'] : '';?></h1>
            <h3 class="form_titulo">Preencha os Dados</h3>
            <label class="form_label <?php echo $nivelRioDisabled ?>" for="nivel_rio"></label>
            <input class="form_input" type="text" placeholder="Insira o nível do rio" id="user_id" name = "nivel_rio" <?php echo $nivelRioDisabled ?>>
            <label class="form_label <?php echo $volumeChuvaDisabled ?>" for="volume_chuva"></label>
            <input class="form_input" type="text" placeholder="Insira o volume da chuva" id="user_pass" name = "volume_chuva" <?php echo $volumeChuvaDisabled ?>>
            <label class="form_label <?php echo $nivelReservatorioDisabled ?>" for="nivel_reservatorio"></label>
            <input class="form_input" type="text" placeholder="Insira o nível do reservatório" id="user_pass" name="nivelReservatorio" <?php echo $nivelReservatorioDisabled ?>>
            <button type="submit" class="button" name ="enviar">Enviar</button>
            <br>
            <button type="submit" name="logout"><a href="logout.php">Sair</button>
            <img class="form_img" src="assets/imgs/Logo_apac.png" alt="Logo Apac">
        </form>
    </div>
</body>
</html>
