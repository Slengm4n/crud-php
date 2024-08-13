<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="../STYLES/style.css">
    <title> LsCustom </title>
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

    if (!$mysqli instanceof mysqli) {
        echo "Falha na conexão com o banco de dados.";
        exit();
    }

    if (isset($_GET['acao'])) {
        $acao = $_GET['acao'];
        $id = $_GET['id'] ?? null;

        switch ($acao) {
            case 'inserir':
                $stmt = $mysqli->prepare("INSERT INTO tabela_contato (nome, sobrenome, tell, email, mesage, nregistro) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $_POST['nome'], $_POST['sobrenome'], $_POST['tell'], $_POST['email'], $_POST['mesage'], $_POST['nregistro']);
                if ($stmt->execute()) {
                    echo "<script>alert('Dados cadastrados com sucesso!'); window.location.href='contact.php?acao=selecionar';</script>";
                } else {
                    echo "<script>alert('Erro ao inserir os dados: " . htmlspecialchars($stmt->error) . "');</script>";
                }
                $stmt->close();
                break;

            case 'deletar':
                if ($id) {
                    $stmt = $mysqli->prepare("DELETE FROM tabela_contato WHERE contact_id = ?");
                    $stmt->bind_param("i", $id);
                    if ($stmt->execute()) {
                        echo "<script>alert('Dados excluídos com sucesso!'); window.location.href='contact.php?acao=selecionar';</script>";
                    } else {
                        echo "<script>alert('Erro ao excluir os dados: " . htmlspecialchars($stmt->error) . "');</script>";
                    }
                    $stmt->close();
                }
                break;

            case 'montar':
                if ($id) {
                    $stmt = $mysqli->prepare("SELECT * FROM tabela_contato WHERE contact_id = ?");
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $resultado = $stmt->get_result();
                    $registro = $resultado->fetch_assoc();

                    if ($registro) {
                        echo "<form method='post' action='contact.php?acao=atualizar'>";
                        echo "<h1>Recadastramento</h1>";
                        echo "<table>";
                        echo "<tr><td>Código:</td><td><input name='id' type='text' value='" . htmlspecialchars($id) . "' readonly></td></tr>";
                        echo "<tr><td><label for='nome'>Nome do Cliente:</label></td><td><input id='nome' name='nome' value='" . htmlspecialchars($registro['nome']) . "'></td></tr>";
                        echo "<tr><td><label for='sobrenome'>Sobrenome do Cliente:</label></td><td><input id='sobrenome' name='sobrenome' value='" . htmlspecialchars($registro['sobrenome']) . "'></td></tr>";
                        echo "<tr><td><label for='tell'>Telefone do cliente:</label></td><td><input id='tell' name='tell' value='" . htmlspecialchars($registro['tell']) . "'></td></tr>";
                        echo "<tr><td><label for='email'>E-mail do cliente:</label></td><td><input id='email' name='email' value='" . htmlspecialchars($registro['email']) . "'></td></tr>";
                        echo "<tr><td><label for='mesage'>Mensagem do cliente:</label></td><td><input type='text' id='mesage' name='mesage' value='" . htmlspecialchars($registro['mesage']) . "'></td></tr>";
                        echo "<tr><td><label for='nregistro'>N° de registro do cliente:</label></td><td><input type='text' id='nregistro' name='nregistro' value='" . htmlspecialchars($registro['nregistro']) . "'></td></tr>";
                        echo "<tr><td colspan='2'><input name='Submit' type='submit' value='Atualizar'></td></tr>";
                        echo "</table>";
                        echo "</form>";
                    }

                    $stmt->close();
                }
                break;

            case 'atualizar':
                $stmt = $mysqli->prepare("UPDATE tabela_contato SET nome = ?, sobrenome = ?, tell = ?, email = ?, mesage = ?, nregistro = ? WHERE contact_id = ?");
                $stmt->bind_param("ssssssi", $_POST['nome'], $_POST['sobrenome'], $_POST['tell'], $_POST['email'], $_POST['mesage'], $_POST['nregistro'], $_POST['id']);
                if ($stmt->execute()) {
                    echo "<script>alert('Dados atualizados com sucesso!'); window.location.href='contact.php?acao=selecionar';</script>";
                } else {
                    echo "<script>alert('Erro ao atualizar os dados: " . htmlspecialchars($stmt->error) . "');</script>";
                }
                $stmt->close();
                break;

            case 'selecionar':
                echo "<meta charset='utf-8'>";
                echo "<center><table class='content-table' style='max-width: 100%; overflow-x: auto;'>";
                echo "<thead>";
                echo "<div class='title'>";
                echo "<center>Histórico de mensagens.<br></center>";
                echo "</div>";
                echo "<tr>";
                echo "<th>Nome do cliente</th>";
                echo "<th>Sobrenome do cliente</th>";
                echo "<th>Telefone do cliente</th>";
                echo "<th>Email do cliente</th>";
                echo "<th>Mensagem do cliente</th>";
                echo "<th>N° de registro do cliente</th>";
                echo "<th>Ação</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                $resultado = $mysqli->query("SELECT * FROM tabela_contato");

                while ($registro = $resultado->fetch_assoc()) {
                    $id = htmlspecialchars($registro['contact_id']);
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($registro['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($registro['sobrenome']) . "</td>";
                    echo "<td>" . htmlspecialchars($registro['tell']) . "</td>";
                    echo "<td>" . htmlspecialchars($registro['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($registro['mesage']) . "</td>";
                    echo "<td>" . htmlspecialchars($registro['nregistro']) . "</td>";
                    echo "<td>
                            <a href='contact.php?acao=deletar&id=$id'><img src='../IMG/delete.png' alt='Deletar' title='Deletar registro'></a>
                            <a href='contact.php?acao=montar&id=$id'><img src='../IMG/update.png' alt='Atualizar' title='Atualizar registro'></a>
                            <a href='../PAGES/clientes.php'><img src='../IMG/input.png' alt='Inserir registro'></a>
                        </td>";
                    echo "</tr>";
                }

                echo "</tbody></table></center>";
                $resultado->free();
                break;

            default:
                echo "<script>window.location.href='index.php';</script>";
                break;
        }
    } else {
        echo "<script>window.location.href='index.php';</script>";
    }

    $mysqli->close();
    ?>
</body>
</html>
