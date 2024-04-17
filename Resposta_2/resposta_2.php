<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <h1>Listagem de Pedidos</h1>
    <table id="pedidosTable" border="1">
        <thead>
            <tr>
                <th>ID do Pedido</th>
                <th>ID do Usuário</th>
                <th>Total do Pedido</th>
                <th>Data do Pedido</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // conexão com o banco de dados
        require_once('../conexao/conexao.php');
            $sql = "SELECT * FROM orders";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row_count = 0;
                while ($row = $result->fetch_assoc()) {
                    $row_class = ($row_count % 2 == 0) ? 'table-row-even' : 'table-row-odd';
                    echo "<tr class='$row_class'>";
                    echo "<td>" . $row["order_id"] . "</td>";
                    echo "<td>" . $row["order_user_id"] . "</td>";
                    echo "<td>R$ " . number_format($row["order_total"], 2, ',', '.') . "</td>";
                    echo "<td>" . $row["order_date"] . "</td>";
                    echo "</tr>";
                    $row_count++;
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum pedido encontrado.</td></tr>";
            }
            // Fechar conexão com o banco de dados
            $conn->close();
            ?>
        </tbody>
    </table>

    <br>
    <button onclick="imprimir()">Imprimir</button>
</body>
<script src="script.js"></script>
</html>
