<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="../STYLES/style.css">
    <title>LS Custom</title>
</head>

<body>    
<!--HEADER-->
<nav class="Header">
    <label class="logo">LS CUSTOMS</label>
    <ul>
        <li><a href="../PAGES/opcoes.php">OPÇÕES</a></li>
        <li><a href="../PAGES/contato.php">CONTATO</a></li>
    </ul>
</nav>
<!--FIM HEADER-->

<br><br>

<?php

$mysqli = require __DIR__ . "/../database/db.php";
$acao = $_GET['acao'] ?? '';
$id = $_GET['id'] ?? '';

switch ($acao) {
    case 'inserir':
        $clientname = $_POST['clientname'];
        $veihclemodel = $_POST['veihclemodel'];
        $veihcleplate = $_POST['veihcleplate'];
        $veihclecolor = $_POST['veihclecolor'];
        $veihcleyear = $_POST['veihcleyear'];
        $indate = $_POST['indate'];
        $outdate = $_POST['outdate'];
        $materiais = $_POST['materiais'];
        $maodeobra = $_POST['maodeobra'];
        $payment = $_POST['payment'];
        $description = $_POST['description'];

        $sql = "INSERT INTO tabela_registros (clientname, veihclemodel, veihcleplate, veihclecolor, veihcleyear, indate, outdate, materiais, maodeobra, payment, description)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssds", $clientname, $veihclemodel, $veihcleplate, $veihclecolor, $veihcleyear, $indate, $outdate, $materiais, $maodeobra, $payment, $description);

        if (!$stmt->execute()) {
            die('Erro ao inserir os dados: ' . $stmt->error);
        } else {
            echo "<script>
            alert('Dados cadastrados com sucesso!');
            window.location.href='registry.php?acao=selecionar';
            </script>";
        }
        $stmt->close();
        break;

    case 'deletar':
        $sql = "DELETE FROM tabela_registros WHERE registry_id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            die('Error: ' . $stmt->error);
        } else {
            echo "<script>
            alert('Dados excluídos com sucesso!');
            window.location.href='registry.php?acao=selecionar';
            </script>";
        }
        $stmt->close();
        break;

    case 'montar':
        $sql = "SELECT * FROM tabela_registros WHERE registry_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        echo "<form method='post' name='dados' action='registry.php?acao=atualizar' onSubmit='return enviados();'>";
        echo "<div class='container-pages'>";
        echo "<div class='header-pages'>";
        echo "<h2>Atualização de Registro</h2>";
        echo "</div>";
        echo "<div class='form'>";

        while ($registro = $resultado->fetch_assoc()) {
            echo "<div class='form-content'>";
            echo "<label for='id'>Código:</label>";
            echo "<input name='id' type='text' class='formbutton' id='id' value='" . htmlspecialchars($id) . "' readonly>";
            echo "</div>";

            echo "<div class='form-content'>";
            echo "<label for='clientname'>Nome do cliente:</label>";
            echo "<input id='clientname' name='clientname' value='" . htmlspecialchars($registro['clientname']) . "'>";
            echo "</div>";

            echo "<div class='form-content'>";
            echo "<label for='veihclemodel'>Modelo do veículo:</label>";
            echo "<input id='veihclemodel' name='veihclemodel' value='" . htmlspecialchars($registro['veihclemodel']) . "'>";
            echo "</div>";

            echo "<div class='form-content'>";
            echo "<label for='veihcleplate'>Placa:</label>";
            echo "<input id='veihcleplate' name='veihcleplate' value='" . htmlspecialchars($registro['veihcleplate']) . "'>";
            echo "</div>";

            echo "<div class='form-content'>";
            echo "<label for='veihclecolor'>Cor:</label>";
            echo "<input id='veihclecolor' name='veihclecolor' value='" . htmlspecialchars($registro['veihclecolor']) . "'>";
            echo "</div>";

            echo "<div class='form-content'>";
            echo "<label for='veihcleyear'>Ano:</label>";
            echo "<input id='veihcleyear' name='veihcleyear' value='" . htmlspecialchars($registro['veihcleyear']) . "'>";
            echo "</div>";

            echo "<div class='form-content'>";
            echo "<label for='indate'>Data de entrada:</label>";
            echo "<input type='date' id='indate' name='indate' value='" . htmlspecialchars($registro['indate']) . "'>";
            echo "</div>";

            echo "<div class='form-content'>";
            echo "<label for='outdate'>Data de saída:</label>";
            echo "<input type='date' id='outdate' name='outdate' value='" . htmlspecialchars($registro['outdate']) . "'>";
            echo "</div>";

            echo "<div class='form-content'>";
            echo "<label for='materiais'>Custo de Materiais:</label>";
            echo "<input id='materiais' name='materiais' value='" . htmlspecialchars($registro['materiais']) . "'>";
            echo "</div>";

            echo "<div class='form-content'>";
            echo "<label for='maodeobra'>Valor mão de obra:</label>";
            echo "<input id='maodeobra' name='maodeobra' value='" . htmlspecialchars($registro['maodeobra']) . "'>";
            echo "</div>";

            echo "<div class='form-content'>";
            echo "<label for='payment'>Método de pagamento:</label>";
            echo "<input id='payment' name='payment' value='" . htmlspecialchars($registro['payment']) . "'>";
            echo "</div>";

            echo "<div class='form-content'>";
            echo "<label for='description'>Descrição:</label>";
            echo "<input id='description' name='description' value='" . htmlspecialchars($registro['description']) . "'>";
            echo "</div>";

            echo "<div class='form-content'>";
            echo "<button type='submit' class='formobjects'>Atualizar</button>";
            echo "</div>";
        }

        echo "</div>";
        echo "</div>";
        echo "</form>";
        
        $stmt->close();
        break;

    case 'atualizar':
        $codigo = $_POST['id']; 
        $clientname = $_POST['clientname'];
        $veihclemodel = $_POST['veihclemodel'];
        $veihcleplate = $_POST['veihcleplate'];
        $veihclecolor = $_POST['veihclecolor'];
        $veihcleyear = $_POST['veihcleyear'];
        $indate = $_POST['indate'];
        $outdate = $_POST['outdate'];
        $materiais = $_POST['materiais'];
        $maodeobra = $_POST['maodeobra'];
        $payment = $_POST['payment'];
        $description = $_POST['description'];

        $sql = "UPDATE tabela_registros 
                SET clientname = ?, veihclemodel = ?, veihcleplate = ?, veihclecolor = ?, veihcleyear = ?, indate = ?, outdate = ?, materiais = ?, maodeobra = ?, payment = ?, description = ?
                WHERE registry_id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssdis", $clientname, $veihclemodel, $veihcleplate, $veihclecolor, $veihcleyear, $indate, $outdate, $materiais, $maodeobra, $payment, $description, $codigo);
        
        if (!$stmt->execute()) {
            die('Error: ' . $stmt->error);
        } else {
            echo "<script>
            alert('Dados atualizados com sucesso!');
            window.location.href='registry.php?acao=selecionar';
            </script>";
        }
        $stmt->close();
        break;

    case 'selecionar':
        $sql = "SELECT * FROM tabela_registros";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->get_result();

        echo "<div class='container-pages'>";
        echo "<div class='header-pages'>";
        echo "<h2>Registros Cadastrados</h2>";
        echo "</div>";
        echo "<div class='form'>";

        while ($registro = $resultado->fetch_assoc()) {
            echo "<div class='form-content'>";
            echo "<p>Código: " . htmlspecialchars($registro['registry_id']) . "</p>";
            echo "<p>Cliente: " . htmlspecialchars($registro['clientname']) . "</p>";
            echo "<p>Veículo: " . htmlspecialchars($registro['veihclemodel']) . "</p>";
            echo "<p>Placa: " . htmlspecialchars($registro['veihcleplate']) . "</p>";
            echo "<p>Cor: " . htmlspecialchars($registro['veihclecolor']) . "</p>";
            echo "<p>Ano: " . htmlspecialchars($registro['veihcleyear']) . "</p>";
            echo "<p>Entrada: " . htmlspecialchars($registro['indate']) . "</p>";
            echo "<p>Saída: " . htmlspecialchars($registro['outdate']) . "</p>";
            echo "<p>Materiais: " . htmlspecialchars($registro['materiais']) . "</p>";
            echo "<p>Mão de Obra: " . htmlspecialchars($registro['maodeobra']) . "</p>";
            echo "<p>Pagamento: " . htmlspecialchars($registro['payment']) . "</p>";
            echo "<p>Descrição: " . htmlspecialchars($registro['description']) . "</p>";
            echo "<a href='registry.php?acao=montar&id=" . htmlspecialchars($registro['registry_id']) . "'>Atualizar</a> ";
            echo "<a href='registry.php?acao=deletar&id=" . htmlspecialchars($registro['registry_id']) . "'>Excluir</a>";
            echo "</div><br>";
        }

        echo "</div>";
        echo "</div>";

        $stmt->close();
        break;

    default:
        break;
}

$conn->close();

?>
</body>
</html>
