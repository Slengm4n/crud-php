<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf=-8">
    <meta charset ="utf-8" />
	<link rel="stylesheet" type="text/css" href="estilo.css">
    <link rel="stylesheet" type="text/css" href="../STYLES/style.css">
    <title> Fabrica de Produtos ecologicos </title>

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
        $productname = $_POST['productname'];
        $productdescription= $_POST['productdescription'];
        $productbarcode = $_POST['productbarcode'];
        $productcategory = $_POST['productcategory'];
        $productquantity = $_POST['productquantity'];
        $productvalor = $_POST['productvalor'];

        $sql = "INSERT INTO tabela_estoque (productname, productdescription, productbarcode, productcategory, productquantity, productvalor)
        VALUES ('$productname', '$productdescription', '$productbarcode', '$productcategory', '$productquantity', '$productvalor')";

        if (!mysqli_query($conn, $sql)) {
            die('Erro ao inserir os dados: ' . mysqli_error($conn));
        } else {
            echo "<script language='javascript' type='text/javascript'>
            alert('Dados cadastrados com sucesso!')
            window.location.href='crud.php?acao=selecionar'</script> ";
        }
        break;
		
		

case 'deletar':
    $sql = "DELETE FROM tabela_estoque WHERE stock_id = '" . $id . "'";
    
    if (!mysqli_query($conn, $sql)) {
        die('Error: ' . mysql_error($conn));
    } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Dados excluidos com sucesso!')
        window.location.href='crud.php?acao=selecionar'</script>";}

        mysqli_close($conn);
        header("Location:crud.php?acao=selecionar");
        break;
		
		


case 'montar':

    $id = $_GET ['id'];
    $sql = 'SELECT * FROM tabela_estoque WHERE stock_id =' . $id;
    $resultado = mysqli_query($conn, $sql) or die('Erro ao retornar dados');

        echo "<form method='post' name='dados' action='crud.php?acao=atualizar' onSubmit='return enviados();' >";
        echo "<table width='588' border='0' align='center' >";

        while ($registro = mysqli_fetch_array($resultado)){
            echo " <tr>";
            echo " <td>Código:</td>";
            echo " <td>";
            echo " <input name='id' type='text' class='formbutton' id='id'value=" . $id . " readonly>";
            echo " </td> ";
            echo " </tr>";

        echo "<tr> ";
        echo "<td><label for='productname'>Nome do produto:</label></td>";
        echo "<td><input id='productname' name='productname' value=" . htmlspecialchars($registro['productname']) . " ";
        echo "</tr>";

        echo "<tr>";
        echo "<td><label for='productdescription'>Descrição do produto:</label></td>";
        echo "<td><input id='productdescription' name='productdescription' value=" . $registro['productdescription']. " ";
        echo "</tr>";

        echo "<tr>";
        echo "<td><label for='productbarcode'>Código de barras do produto:</label></td>";
        echo "<td><input id=productbarcode' name='productbarcode' value=" . $registro['productbarcode']. " ";
        echo "</tr>";

        echo "<tr>";
        echo "<td><label for='productcategory'>Categoria:</label></td>";
        echo "<td><input id='productcategory' name='productcategory'value=" . $registro['productcategory']. " ";
        echo "</tr>";

        echo "<tr>";
        echo "<td><label for='productquantity'>Quantidade:</label></td>";
        echo "<td><input id='productquantity' name='productquantity' value=" . $registro['productquantity']. " ";
        echo "</tr>";

        echo "<tr>";
        echo "<td><label for='productvalor'>Valor:</label></td>";
        echo "<td><input id='productvalor' name='productvalor' value=" . $registro['productvalor']. " ";
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
        $productname = $_POST['productname'];
        $productdescription= $_POST['productdescription'];
        $productbarcode = $_POST['productbarcode'];
        $productcategory = $_POST['productcategory'];
        $productquantity = $_POST['productquantity'];
        $productvalor = $_POST['productvalor'];


    $sql = "UPDATE tabela_estoque SET productname = '".$productname . "', productdescription = '".$productdescription. "', productbarcode = '" .$productbarcode . "', productcategory = '" .$productcategory . "', productquantity = '" .$productquantity . "', productvalor = '" .$productvalor . "' WHERE stock_id = '" .$codigo . "'"; 

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
    echo "<center>Produtos cadastrados na base de dados.<br></center>";
    echo "</div>";
    echo "<tr>";
    echo "<th> Nome do produto: </th>";
    echo "<th> Descrição do produto: </th>";
    echo "<th> Código de barras do produto: </th>";
    echo "<th> Categoria: </th>";
    echo "<th> Quantidade: </th>";
    echo "<th> Valor: </th>";
    echo "<th> Ação </th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";


    $sql = "SELECT * FROM tabela_estoque"; 
    $resultado = mysqli_query($conn, $sql) or die("Erro ao retornar dados");

    while ($registro = mysqli_fetch_array($resultado)) {
 
        $id = $registro['stock_id'];
        $productname = $registro['productname'];
        $productdescription = $registro['productdescription'];
        $productbarcode = $registro['productbarcode'];
        $productcategory = $registro['productcategory'];
        $productquantity = $registro['productquantity'];
        $productvalor = $registro['productvalor'];

        echo "<tr>";
        echo "<td>" . $productname . "</td>";
        echo "<td>" . $productdescription . "</td>";
        echo "<td>" . $productbarcode . "</td>";
        echo "<td>" . $productcategory . "</td>";
        echo "<td>" . $productquantity . "</td>";
        echo "<td>" . $productvalor . "</td>";
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