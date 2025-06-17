<?php
// session_start();

$host = "localhost";   // Endereço do servidor (normalmente localhost)
$user = "root";        // Usuário do banco de dados
$pass = "";            // Senha do banco de dados (em geral, para o MySQL local é vazio)
$dbname = "biblioteca_mvc2";   // Nome do banco de dados

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
