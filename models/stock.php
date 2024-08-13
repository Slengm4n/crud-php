<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <title>Fabrica de Produtos Ecologicos</title>
</head>
<body>    
    <!--HEADER-->
    <nav class="Header">
        <label class="logo">LS CUSTOMS</label>
        <ul>
            <li><a href="../public/opcoes.php">OPÇÕES</a></li>
            <li><a href="../public/contato.php">CONTATO</a></li>
        </ul>
    </nav>
    <!--FIM HEADER-->
    <br><br>

    <?php
    $mysqli = require __DIR__ . "/../database/db.php";

    $acao = $_GET['acao'] ?? '';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    switch ($acao) {
        case 'inserir':
            $stmt = $conn->prepare("INSERT INTO tabela_estoque (productname, productdescription, productbarcode, productcategory, productquantity, productvalor) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssii", $_POST['productname'], $_POST['productdescription'], $_POST['productbarcode'], $_POST['productcategory'], $_POST['productquantity'], $_POST['productvalor']);

            if (!$stmt->execute()) {
                die('Erro ao inserir os dados: ' . $stmt->error);
            } else {
                echo "<script>
                alert('Dados cadastrados com sucesso!');
                window.location.href='stock.php?acao=selecionar';
                </script>";
            }
            $stmt->close();
            break;

        case 'deletar':
            $stmt = $conn->prepare("DELETE FROM tabela_estoque WHERE stock_id = ?");
            $stmt->bind_param("i", $id);

            if (!$stmt->execute()) {
                die('Erro ao deletar os dados: ' . $stmt->error);
            } else {
                echo "<script>
                alert('Dados excluídos com sucesso!');
                window.location.href='stock.php?acao=selecionar';
                </script>";
            }
            $stmt->close();
            break;

        case 'montar':
            $stmt = $conn->prepare("SELECT * FROM tabela_estoque WHERE stock_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();

            echo "<form method='post' action='stock.php?acao=atualizar'>";
            echo "<table width='588' border='0' align='center'>";

            while ($registro = $resultado->fetch_assoc()) {
                echo "<tr><td>Código:</td><td><input name='id' type='text' value='" . htmlspecialchars($id) . "' readonly></td></tr>";
                echo "<tr><td><label for='productname'>Nome do produto:</label></td><td><input id='productname' name='productname' value='" . htmlspecialchars($registro['productname']) . "'></td></tr>";
                echo "<tr><td><label for='productdescription'>Descrição do produto:</label></td><td><input id='productdescription' name='productdescription' value='" . htmlspecialchars($registro['productdescription']) . "'></td></tr>";
                echo "<tr><td><label for='productbarcode'>Código de barras do produto:</label></td><td><input id='productbarcode' name='productbarcode' value='" . htmlspecialchars($registro['productbarcode']) . "'></td></tr>";
                echo "<tr><td><label for='productcategory'>Categoria:</label></td><td><input id='productcategory' name='productcategory' value='" . htmlspecialchars($registro['productcategory']) . "'></td></tr>";
                echo "<tr><td><label for='productquantity'>Quantidade:</label></td><td><input id='productquantity' name='productquantity' value='" . htmlspecialchars($registro['productquantity']) . "'></td></tr>";
                echo "<tr><td><label for='productvalor'>Valor:</label></td><td><input id='productvalor' name='productvalor' value='" . htmlspecialchars($registro['productvalor']) . "'></td></tr>";
                echo "<tr><td><input name='Submit' type='submit' value='Atualizar'></td></tr>";
            }

            echo "</table>";
            echo "</form>";

            $stmt->close();
            break;

        case 'atualizar':
            $stmt = $conn->prepare("UPDATE tabela_estoque SET productname = ?, productdescription = ?, productbarcode = ?, productcategory = ?, productquantity = ?, productvalor = ? WHERE stock_id = ?");
            $stmt->bind_param("ssssiii", $_POST['productname'], $_POST['productdescription'], $_POST['productbarcode'], $_POST['productcategory'], $_POST['productquantity'], $_POST['productvalor'], $_POST['id']);

            if (!$stmt->execute()) {
                die('Erro ao atualizar os dados: ' . $stmt->error);
            } else {
                echo "<script>
                alert('Dados atualizados com sucesso!');
                window.location.href='stock.php?acao=selecionar';
                </script>";
            }
            $stmt->close();
            break;

        case 'selecionar':
            echo "<meta charset='utf-8'>";
            echo "<center><table class='content-table' style='max-width: 100%; overflow-x: auto;'>";
            echo "<thead><tr><th>Nome do produto</th><th>Descrição</th><th>Código de barras</th><th>Categoria</th><th>Quantidade</th><th>Valor</th><th>Ação</th></tr></thead>";
            echo "<tbody>";

            $stmt = $conn->prepare("SELECT * FROM tabela_estoque");
            $stmt->execute();
            $resultado = $stmt->get_result();

            while ($registro = $resultado->fetch_assoc()) {
                echo "<tr><td>" . htmlspecialchars($registro['productname']) . "</td>";
                echo "<td>" . htmlspecialchars($registro['productdescription']) . "</td>";
                echo "<td>" . htmlspecialchars($registro['productbarcode']) . "</td>";
                echo "<td>" . htmlspecialchars($registro['productcategory']) . "</td>";
                echo "<td>" . htmlspecialchars($registro['productquantity']) . "</td>";
                echo "<td>" . htmlspecialchars($registro['productvalor']) . "</td>";
                echo "<td>
                    <a href='stock.php?acao=deletar&id=" . htmlspecialchars($registro['stock_id']) . "'><img src='../assets/img/delete.png' alt='Deletar' title='Deletar registro'></a>
                    <a href='stock.php?acao=montar&id=" . htmlspecialchars($registro['stock_id']) . "'><img src='../assets/img/update.png' alt='Atualizar' title='Atualizar registro'></a>
                    <a href='../public/estoque.php'><img src='../assets/img/input.png' alt='Inserir' registro'></a>
                </td></tr>";
            }

            echo "</tbody></table></center>";

            $stmt->close();
            break;

        default:
            echo "<script>window.location.href='index.php';</script>";
            break;
    }

    $conn->close();
    ?>
</body>
</html>
