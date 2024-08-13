<?php

$servidor = "localhost";
$banco = "db_lscustom";
$usuario = "root";
$senha = "";
$porta = "3306";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($servidor, $usuario, $senha, $banco, $porta);
    $conn->set_charset("utf8mb4");


} catch (mysqli_sql_exception $e) {

    error_log("Erro ao conectar ao banco de dados: " . $e->getMessage(), 0);

    die("Falha na conexão com o banco de dados. Por favor, tente novamente mais tarde.");
}

