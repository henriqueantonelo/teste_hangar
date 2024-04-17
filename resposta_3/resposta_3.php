<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Vendas Totais por País</h2>
    <form method="GET">
        <label for="country">Selecione o país:</label>
        <select id="country" name="country">
            <option value="">Todos os países</option>
            <?php
            require_once('../conexao/conexao.php');


            //obtendo países da tabela
            $sql_countries = "SELECT DISTINCT user_country FROM user";
            $result_countries = $conn->query($sql_countries);

            //menu suspenso
            if ($result_countries->num_rows > 0) {
                while ($row = $result_countries->fetch_assoc()) {
                    $country = $row['user_country'];
                    echo "<option value='$country'>$country</option>";
                }
            }

            $conn->close();
            ?>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <!-- exibindo os resultados -->
    <table>
        <thead>
            <tr>
                <th>País</th>
                <th>Total de vendas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $filter_country = isset($_GET['country']) ? $_GET['country'] : '';

            $conn = new mysqli($servername, $username, $password, $dbname);

            //vendas totais por país
            $sql = "SELECT user_country AS country, SUM(order_total) AS total_sales FROM orders JOIN user ON orders.order_user_id = user.user_id";
            if (!empty($filter_country)) {
                $sql .= " WHERE user_country = '$filter_country'";
            }
            $sql .= " GROUP BY user_country";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['country']}</td><td>{$row['total_sales']}</td></tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No sales data found.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
