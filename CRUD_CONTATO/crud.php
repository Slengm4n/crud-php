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
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $tell = $_POST['tell'];
        $email = $_POST['email'];
        $mesage = $_POST['mesage'];
        $nregistro = $_POST['nregistro'];

        $sql = "INSERT INTO tabela_contato (nome, sobrenome, tell, email, mesage, nregistro)
         VALUES ('$nome', '$sobrenome', '$tell', '$email', '$mesage' , '$nregistro')";

        if (!mysqli_query($conn, $sql)) {
            die('Erro ao inserir os dados: ' . mysqli_error($conn));
        } else {
            echo "<script language='javascript' type='text/javascript'>
            alert('Dados cadastrados com sucesso!')
            window.location.href='crud.php?acao=selecionar'</script> ";
        }
        break;
		
		

case 'deletar':
    $sql = "DELETE FROM tabela_contato WHERE contact_id = '" . $id . "'";
    
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
    $sql = 'SELECT * FROM tabela_contato WHERE contact_id =' . $id;
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
        echo "<td><label for='nome'>Nome do Cliente:</label></td>";
        echo "<td><input id='nome' name='nome' value=" . htmlspecialchars($registro['nome']) . " ";
        echo "</tr>";

        echo "<tr> ";
        echo "<td><label for='sobrenome'>Nome do Cliente:</label></td>";
        echo "<td><input id='sobrenome' name='sobrenome' value=" . $registro['sobrenome']. " ";
        echo "</tr>";

        echo "<tr>";
        echo "<td><label for='tell'>Telefone do cliente:</label></td>";
        echo "<td><input id='tell' name='tell' value=" . $registro['tell']. " ";
        echo "</tr>";

        echo "<tr>";
        echo "<td><label for='email'>E-mail do cliente:</label></td>";
        echo "<td><input id='email' name='email' value=" . $registro['email']. " ";
        echo "</tr>";

        echo "<tr>";
        echo "<td><label for='mesage'>Mensagem do cliente:</label></td>";
        echo "<td><input type='text' id='mesage' name='mesage' value=" . $registro['mesage']. " ";
        echo "</tr>";

        
        echo "<tr>";
        echo "<td><label for='nregistro'>N° de registro do cliente:</label></td>";
        echo "<td><input type='text' id='nregistro' name='nregistro' value=" . $registro['nregistro']. " ";
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
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $tell = $_POST['tell'];
        $email = $_POST['email'];
        $mesage = $_POST['mesage'];
        $nregistro = $_POST['nregistro'];
        
        $sql = "UPDATE tabela_contato SET nome = '".$nome."', sobrenome ='".$sobrenome."' ,tell = '".$tell."', email = '".$email."', mesage = '" .$mesage. "', nregistro = '" .$nregistro. "'  WHERE contact_id = '".$codigo."'";
        
        if (!mysqli_query($conn, $sql)) {
            die('Erro no comando SQL UPDATE: ' . mysqli_error($conn));
        } else {
            echo "<script language='javascript' type='text/javascript'>
            alert('Dados atualizados com sucesso!')
            window.location.href='crud.php?acao=selecionar'</script>";
        }
    
        mysqli_close($conn);
        header("Location: crud.php?acao=selecionar");
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
    echo "<center>Histórico de mensagens.<br></center>";
    echo "</div>";
    echo "<tr>";
    echo "<th> Nome do cliente: </th>";
    echo "<th> Sobrenome do clinte: </th>";
    echo "<th> Telefone do cliente: </th>";
    echo "<th> Email do cliente: </th>";
    echo "<th> Mensagem do cliente: </th>";
    echo "<th> N° de registro do cliente: </th>"; 
    echo "<th> Ação </th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";


    $sql = "SELECT * FROM tabela_contato"; 
    $resultado = mysqli_query($conn, $sql) or die("Erro ao retornar dados");

    while ($registro = mysqli_fetch_array($resultado)) {
 
        $id = $registro['contact_id']; 
        $nome = $registro['nome'];
        $sobrenome = $registro['sobrenome'];
        $tell = $registro['tell'];
        $email = $registro['email'];
        $mesage = $registro['mesage'];
        $nregistro = $registro['nregistro'];

        echo "<tr>";
        echo "<td>" . $nome . "</td>";
        echo "<td>" . $sobrenome . "</td>";
        echo "<td>" . $tell . "</td>";
        echo "<td>" . $email . "</td>";
        echo "<td>" . $mesage . "</td>";
        echo "<td>" . $nregistro . "</td>";
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