<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            background-image: url("assets/imgs/Hidrocor_Background.png");
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #5990ca;
            color: white;
            margin: 0;
            border-radius: 15px;
        }

        form {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            width: 300px;
            background-color: #cccccc;
        }

        button[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #5990ca;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .button {
            padding: 5px 10px;
            background-color: #5990ca;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #6fa2d9;
        }

        .button:active {
            background-color: #367c39;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .message {
            margin-top: 20px;
            padding: 10px;
            background-color: #f44336;
            color: white;
            font-weight: bold;
        }

        .back-button {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Usuários</h1>

        <form method="POST" action="">
            <input type="text" name="search" placeholder="Digite o nome do usuário" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
            <button type="submit">Buscar</button>
        </form>

        <?php
        include('conexao.php');

        $sql = "SELECT * FROM usuario";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $search = $_POST["search"];
            $sql .= " WHERE nome LIKE '%$search%'";
        }

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            echo "<table>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Setor</th>
                        <th>Permissão</th>
                        <th>Ações</th>
                    </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . $row["nome"] . "</td>
                        <td>" . $row["telefone"] . "</td>
                        <td>" . $row["setor"] . "</td>
                        <td>" . $row["permissao"] . "</td>
                        <td>
                            <a href='EditarUsuario.php?id=" . $row["id"] . "' class='button'>Editar</a>
                            <a href='DeletarUsuario.php?id=" . $row["id"] . "' class='button'>Excluir</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='message'>Nenhum usuário encontrado.</p>";
        }

        mysqli_close($conn);
        ?>

        <div class="back-button">
            <a href="paineladmin.php" class="button">Voltar</a>
        </div>
    </div>
</body>
</html>
