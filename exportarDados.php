<?php

include('conexao.php');


$conn->set_charset("utf8");


$sql = "SELECT u.nome, d.nivel_chuva, d.nivel_rio, d.nivel_reservatorio, d.data_hora 
FROM usuario u INNER JOIN dados d ON (d.id = u.id)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $datetime = date('dmY_His'); 
    $filename = "dados_" . $datetime . ".csv"; 


    $file = fopen($filename, 'w');


    $delimiter = ";";


    $headers = array("Nome", "Nivel da chuva", "Nivel do Rio","Nivel do Reservatório","Data e Hora"); // Substitua pelas colunas da sua tabela
    fputcsv($file, $headers, $delimiter);

    while ($row = $result->fetch_assoc()) {

        $csvData = [];
        foreach ($row as $field) {
            $csvData[] = $field;
        }
        fputcsv($file, $csvData, $delimiter);
    }

    fclose($file);


    header("Content-Type: application/csv; charset=utf-8");
    header("Content-Disposition: attachment; filename=$filename");


    readfile($filename);


    unlink($filename);
} else {
    echo "Nenhum dado encontrado na tabela.";
}

$conn->close();

?>
