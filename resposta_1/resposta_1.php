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
    // conexão com o banco de dados
    require_once('../conexao/conexao.php');
$sql = "SELECT DATE(order_date) AS order_day, AVG(order_total) AS avg_order_total
        FROM orders
        GROUP BY DATE(order_date)";

$result = $conn->query($sql);


echo '<table border="1">
<tr>
<th>Data do Pedido</th>
<th>Média dos Pedidos por Dia</th>
</tr>';

while ($row = $result->fetch_assoc()) {
    $orderDay = $row['order_day'];
    $avgOrderTotal = $row['avg_order_total'];
    
    $colorClass = '';
    if ($avgOrderTotal < 3000) {
        $colorClass = 'red';
    } elseif ($avgOrderTotal > 3000) {
        $colorClass = 'green';
    } else {
        $colorClass = 'gray';
    }
    
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
