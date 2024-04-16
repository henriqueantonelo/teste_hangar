<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
require_once('conexao.php');
// Consulta SQL para calcular a média dos pedidos por dia
$sql = "SELECT DATE(order_date) AS order_day, AVG(order_total) AS avg_order_total
        FROM orders
        GROUP BY DATE(order_date)";

$result = $conn->query($sql);

// Iniciar a construção da tabela HTML
echo '<table border="1">
<tr>
<th>Data do Pedido</th>
<th>Média dos Pedidos por Dia</th>
</tr>';

// Iterar sobre os resultados da consulta
while ($row = $result->fetch_assoc()) {
    $orderDay = $row['order_day'];
    $avgOrderTotal = $row['avg_order_total'];
    
    // Definir a cor da linha com base na média dos pedidos
    $colorClass = '';
    if ($avgOrderTotal < 3000) {
        $colorClass = 'red';
    } elseif ($avgOrderTotal > 3000) {
        $colorClass = 'green';
    } else {
        $colorClass = 'gray';
    }
    
    // Exibir a linha da tabela com formatação condicional de cor
    echo '<tr class="' . $colorClass . '">
    <td>' . $orderDay . '</td>
    <td>' . number_format($avgOrderTotal, 2) . '</td>
    </tr>';
}

echo '</table>';
$conn->close();
?>
</body>
</html>
