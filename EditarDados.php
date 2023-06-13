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
        <form class="formulario" method="POST" action="EditarDados.php">
            <h1 class="form_titulo">Preencha os Dados</h1>
            <?php
            session_start();
            include('conexao.php');

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["nivel_rio"]) && isset($_POST["volume_chuva"]) && isset($_POST["nivel_reservatorio"])) {
                    $nivelRio = $_POST["nivel_rio"];
                    $volumeChuva = $_POST["volume_chuva"];
                    $nivelReservatorio = $_POST["nivel_reservatorio"];

                    // Verifique se os dados foram fornecidos corretamente
                    if (!empty($nivelRio) && !empty($volumeChuva) && !empty($nivelReservatorio)) {
                        $id_dados = $_POST["id_dados"];

                        // Atualize os dados no banco de dados
                        $sql = "UPDATE dados SET nivel_rio = '$nivelRio', nivel_chuva = '$volumeChuva', nivel_reservatorio = '$nivelReservatorio' WHERE id_dados = '$id_dados'";
                        if (mysqli_query($conn, $sql)) {
                            echo "Dados atualizados com sucesso";
                        } else {
                            echo "Erro ao atualizar dados: " . mysqli_error($conn);
                        }
                    } 
            }
        }

            // Consulta ao banco de dados para obter os dados existentes
            $id_dados = isset($_GET['id_dados']) ? $_GET['id_dados'] : '';
            $sql_select = "SELECT * FROM dados WHERE id_dados = '$id_dados'";
            $result_select = mysqli_query($conn, $sql_select);
            $row_select = mysqli_fetch_assoc($result_select);

            // Verifique se a consulta retornou resultados
            if ($row_select) {
                $nivelRio = $row_select["nivel_rio"] ?? '';
                $volumeChuva = $row_select["nivel_chuva"] ?? '';
                $nivelReservatorio = $row_select["nivel_reservatorio"] ?? '';
            }
            ?>

            <input type="hidden" name="id_dados" value="<?php echo $id_dados; ?>">
            <input class="form_input" type="text" placeholder="Insira o nível do rio" id="user_id" name="nivel_rio" value="<?php echo $nivelRio; ?>">
            <input class="form_input" type="text" placeholder="Insira o volume da chuva" id="user_pass" name="volume_chuva" value="<?php echo $volumeChuva; ?>">
            <input class="form_input" type="text" placeholder="Insira o nível do reservatório" id="user_pass" name="nivel_reservatorio" value="<?php echo $nivelReservatorio; ?>">
            <button class="form_button" type="submit">Atualizar Dados</button>
        </form>
    </div>
</body>
</html>
