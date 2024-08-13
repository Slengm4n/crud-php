<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf=-8">
    <meta charset ="utf-8" />
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

include_once "conexao.php";

$acao = $_GET['acao'];
if (isset($_GET['id'])){
    $id = $_GET['id'];
}

switch ($acao) {
    case 'inserir':
        $clientname = $_POST['clientname'];
        $clientcpf = $_POST['clientcpf'];
        $clientadress = $_POST['clientadress'];
        $clientcep = $_POST['clientcep'];
        $clientnumber = $_POST['clientnumber'];
        $clientemail = $_POST['clientemail'];

        $sql = "INSERT INTO tabela_clientes (clientname, clientcpf, clientadress, clientcep, clientnumber, clientemail)
         VALUES ('$clientname', '$clientcpf', '$clientadress', '$clientcep', '$clientnumber', '$clientemail')";

        if (!mysqli_query($conn, $sql)) {
            die('Erro ao inserir os dados: ' . mysqli_error($conn));
        } else {
            echo "<script language='javascript' type='text/javascript'>
            alert('Dados cadastrados com sucesso!')
            window.location.href='crud.php?acao=selecionar'</script> ";
        }
        break;
    
		
		

case 'deletar':
    $sql = "DELETE FROM tabela_clientes WHERE client_id = '" . $id . "'";
    
    if (!mysqli_query($conn, $sql)) {
        die('Error: ' . mysqli_error($conn));
    } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Dados excluidos com sucesso!')
        window.location.href='crud.php?acao=selecionar'</script>";}

        mysqli_close($conn);
        header("Location:crud.php?acao=selecionar");
        break;
		

     
case 'montar':

    $id = $_GET ['id'];
    $sql = 'SELECT * FROM tabela_clientes WHERE client_id =' . $id;
    $resultado = mysqli_query($conn, $sql) or die('Erro ao retornar dados');

    echo "<form method='post' name='dados' action='crud.php?acao=atualizar' onSubmit='return enviardados();'>";
        echo "<table>";
        echo "<h1>Recadastramento</h1>";

        while ($registro = mysqli_fetch_array($resultado)){
        echo " <tr>";
        echo " <td>Código:</td>";
        echo " <td>";
        echo " <input name='id' type='text' class='formbutton' id='id'value=" . $id . " readonly>";
        echo " </td> ";
        echo " </tr>";
            
        echo "<tr> ";
        echo "<td><label for='clientname'>Nome do Cliente:</label></td>";
        echo "<td><input id='clientname' name='clientname' value=" . htmlspecialchars($registro['clientname']) . " ";
        echo "</tr>";

        echo "<tr>";
        echo "<td><label for='clientcpf'>CPF do Cliente:</label></td>";
        echo "<td><input id='clientcpf' name='clientcpf' value=" .  $registro['clientcpf']. " ";
        echo "</tr>";

        echo "<tr>";
        echo "<td><label for='clientadress'>Endereço do Cliente:</label></td>";
        echo "<td><input id='clientadress' name='clientadress' value=" . $registro['clientadress'] . " ";
        echo "</tr>";


        echo "<tr>";
        echo "<td><label for='clientcep'>CEP do Cliente:</label></td>";
        echo "<td><input id='clientcep' name='clientcep' value=" . $registro['clientcep']. " ";
        echo "</tr>";

        echo "<tr>";
        echo "<td><label for='clientnumber'>Número de telefone do cliente:</label></td>";
        echo "<td><input type='number' id='clientnumber' name='clientnumber' value=" . $registro['clientnumber'] . " ";
        echo "</tr>";

        echo "<tr>";
        echo "<td><label for='clientemail'>Email do Cliente:</label></td>";
        echo "<td><input type='email' id='clientemail' name='clientemail' value=" . $registro['clientemail'] . " ";
        echo "</tr>";


        echo "<tr>";

        echo " <td>  <input name='Submit' type='submit' class='formobjects' value='Cadastrar'> </td> ";

        echo "</table> ";
        echo "</form> ";

        }


    mysqli_close($conn);
    break;

    case 'atualizar':
        $codigo = $_POST['id'];
        $clientname = $_POST['clientname'];
        $clientcpf = $_POST['clientcpf'];
        $clientadress = $_POST['clientadress'];
        $clientcep = $_POST['clientcep'];
        $clientnumber = $_POST['clientnumber'];
        $clientemail = $_POST['clientemail'];
    
    
        $sql = "UPDATE tabela_clientes SET clientname = ' ".$clientname . "', clientcpf = '".$clientcpf . "', clientadress = '".$clientadress . "', clientcep = '".$clientcep . "', clientnumber = '" .$clientnumber . "', clientemail = '" .$clientemail . "' WHERE client_id = '" .$codigo . "'"; 
    
        if (!mysqli_query($conn, $sql)) {
            die('Erro no comando SQL UPDATE: ' . mysqli_error($conn));
        } else {
            echo "<script language='javascript' type='text/javascript'>
            alert('Dados atualizados com sucesso!')
            window.location.href='crud.php?acao=selecionar'</script>";
        }
    
        mysqli_close($conn);
        header("Location:crud.php?acao=selecionar");
        break;


        
case 'selecionar':
    date_default_timezone_set('America/Sao_Paulo');
    header("Content-type: text/html; charset=utf-8");
    include_once "conexao.php";

    echo "<meta charset='utf-8'>";
    echo "<center> <table class='content-table' style='max-width: 100%; overflow-x: auto;'>";
    date_default_timezone_set('America/Sao_Paulo');
    echo "<thead>";
    echo "<div class='title'>";
    echo "<center>Clientes caastrados na base de dados.<br></center>";
    echo "</div>";
    echo "<tr>";
    echo "<th> Nome do cliente: </th>";
    echo "<th> CPF do cliente: </th>";
    echo "<th> Endereço do cliente: </th>";
    echo "<th> CEP: </th>";
    echo "<th> Número do cliente: </th>";
    echo "<th> Email do cliente: </th>";
    echo "<th> Ação </th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $sql = "SELECT * FROM tabela_clientes"; 
    $resultado = mysqli_query($conn, $sql) or die("Erro ao retornar dados");

    while ($registro = mysqli_fetch_array($resultado)) {
 
        $id = $registro['client_id']; 
        $clientname = $registro['clientname'];
        $clientcpf = $registro['clientcpf'];
        $clientadress = $registro['clientadress'];
        $clientcep = $registro['clientcep'];
        $clientnumber = $registro['clientnumber'];
        $clientemail = $registro['clientemail'];

        echo "<tr>";
        echo "<td>" . $clientname . "</td>";
        echo "<td>" . $clientcpf . "</td>";
        echo "<td>" . $clientadress . "</td>";
        echo "<td>" . $clientcep . "</td>";
        echo "<td>" . $clientnumber . "</td >";
        echo "<td>" . $clientemail . "</td>";
        echo "           
            <td>
                <a href='crud.php?acao=deletar&id=$id'><img src='../IMG/delete.png' alt='Deletar' title='Deletar registro'></a>
                <a href='crud.php?acao=montar&id=$id'><img src='../IMG/update.png' alt='Atualizar' title='Atualizar registro'></a>
                <a href='../PAGES/clientes.php'><img src='../IMG/input.png' alt='Inserir' registro'></a>
            </td>";

        echo "</tr>";       
    }

    mysqli_close($conn);
    break;

    
default:
        echo "<script language= 'javascript' type= 'text/javascript'> window.location.href= 'index.php'</script>";
        break;
}


?>

</body>

</html>