<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "teste_hangar";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>
