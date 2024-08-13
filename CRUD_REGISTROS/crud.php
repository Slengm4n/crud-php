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
        $veihclemodel= $_POST['veihclemodel'];
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
                VALUES ('$clientname', '$veihclemodel', '$veihcleplate', '$veihclecolor', '$veihcleyear', '$indate', '$outdate', '$materiais', '$maodeobra', '$payment', '$description')";

        if (!mysqli_query($conn, $sql)) {
            die('Erro ao inserir os dados: ' . mysqli_error($conn));
        } else {
            echo "<script language='javascript' type='text/javascript'>
            alert('Dados cadastrados com sucesso!')
            window.location.href='crud.php?acao=selecionar'</script> ";
        }
        break;
		
		

case 'deletar':
    $sql = "DELETE FROM tabela_registros WHERE registry_id = '" . $id . "'";
    
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
            $id = $_GET['id'];
            $sql = 'SELECT * FROM tabela_registros WHERE registry_id =' . $id;
            $resultado = mysqli_query($conn, $sql) or die('Erro ao retornar dados');
        
            echo "<form method='post' name='dados' action='crud.php?acao=atualizar' onSubmit='return enviados();'>";
            echo "<div class='container-pages'>";
            echo "<div class='header-pages'>";
            echo "<h2>Atualização de Registro</h2>";
            echo "</div>";
            echo "<div class='form'>";
        
            while ($registro = mysqli_fetch_array($resultado)) {
                echo "<div class='form-content'>";
                echo "<label for='id'>Código:</label>";
                echo "<input name='id' type='text' class='formbutton' id='id' value='" . $id . "' readonly>";
                echo "</div>";
        
                echo "<div class='form-content'>";
                echo "<label for='clientname'>Nome do cliente:</label>";
                echo "<input id='clientname' name='clientname' value='" . htmlspecialchars($registro['clientname']) . "'>";
                echo "</div>";
        
                echo "<div class='form-content'>";
                echo "<label for='veihclemodel'>Modelo do veículo:</label>";
                echo "<input id='veihclemodel' name='veihclemodel' value='" . $registro['veihclemodel'] . "'>";
                echo "</div>";
        
                echo "<div class='form-content'>";
                echo "<label for='veihcleplate'>Placa:</label>";
                echo "<input id='veihcleplate' name='veihcleplate' value='" . $registro['veihcleplate'] . "'>";
                echo "</div>";
        
                echo "<div class='form-content'>";
                echo "<label for='veihclecolor'>Cor:</label>";
                echo "<input id='veihclecolor' name='veihclecolor' value='" . $registro['veihclecolor'] . "'>";
                echo "</div>";
        
                echo "<div class='form-content'>";
                echo "<label for='veihcleyear'>Ano:</label>";
                echo "<input id='veihcleyear' name='veihcleyear' value='" . $registro['veihcleyear'] . "'>";
                echo "</div>";
        
                echo "<div class='form-content'>";
                echo "<label for='indate'>Data de entrada:</label>";
                echo "<input type='date' id='indate' name='indate' value='" . $registro['indate'] . "'>";
                echo "</div>";
        
                echo "<div class='form-content'>";
                echo "<label for='outdate'>Data de saída:</label>";
                echo "<input type='date' id='outdate' name='outdate' value='" . $registro['outdate'] . "'>";
                echo "</div>";
        
                echo "<div class='form-content'>";
                echo "<label for='materiais'>Custo de Materiais:</label>";
                echo "<input id='materiais' name='materiais' value='" . $registro['materiais'] . "'>";
                echo "</div>";
        
                echo "<div class='form-content'>";
                echo "<label for='maodeobra'>Valor mão de obra:</label>";
                echo "<input id='maodeobra' name='maodeobra' value='" . $registro['maodeobra'] . "'>";
                echo "</div>";
        
                echo "<div class='form-content'>";
                echo "<label for='payment'>Método de pagamento:</label>";
                echo "<input id='payment' name='payment' value='" . $registro['payment'] . "'>";
                echo "</div>";
        
                echo "<div class='form-content'>";
                echo "<label for='description'>Descrição:</label>";
                echo "<input id='description' name='description' value='" . $registro['description'] . "'>";
                echo "</div>";
        
                echo "<div class='form-content'>";
                echo "<button type='submit' class='formobjects'>Atualizar</button>";
                echo "</div>";
            }
        
            echo "</div>";
            echo "</div>";
            echo "</form>";
        
            mysqli_close($conn);
            break;
        
    case 'atualizar':
        $codigo = $_POST['id']; 
        $clientname = $_POST['clientname'];
        $veihclemodel= $_POST['veihclemodel'];
        $veihcleplate = $_POST['veihcleplate'];
        $veihclecolor = $_POST['veihclecolor'];
        $veihcleyear = $_POST['veihcleyear'];
        $indate = $_POST['indate'];
        $outdate = $_POST['outdate'];
        $materiais = $_POST['materiais'];
        $maodeobra = $_POST['maodeobra'];
        $payment = $_POST['payment'];
        $description = $_POST['description'];
    
    
    
        $sql = "UPDATE tabela_registros SET clientname = '" . $clientname . "', veihclemodel = '" . $veihclemodel . "', veihcleplate = '" . $veihcleplate . "', veihclecolor = '" . $veihclcolor . "', veihcleyear = '" . $veihcleyear . "', indate = '" . $indate . "', outdate = '" . $outdate . "', materiais = '" . $materiais . "', maodeobra = '" . $maodeobra . "', payment = '" . $payment . "', description = '" . $description . "' WHERE registry_id = '$codigo'";
    
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
    echo "<th> Modelo do veículo: </th>";
    echo "<th> Placa: </th>";
    echo "<th> Cor: </th>";
    echo "<th> Ano: </th>";
    echo "<th> Data de entrada: </th>";
    echo "<th> Custo de materiais:</th>";
    echo "<th> Custo mão de obra: </th>";
    echo "<th> Método de pagamento: </th>";
    echo "<th> Descrição: </th>";
    echo "<th> Ação </th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";


    $sql = "SELECT * FROM tabela_registros"; 
    $resultado = mysqli_query($conn, $sql) or die("Erro ao retornar dados");

    echo "<CENTER> Registro cadastrados na base de dados. <br/></CENTER> ";
    echo "</br>";

    while ($registro = mysqli_fetch_array($resultado)) {
 
        $id = $registro['registry_id']; 
        $clientname = $registro['clientname'];
        $veihclemodel = $registro['veihclemodel'];
        $veihcleplate = $registro['veihcleplate'];
        $veihclcolor = $registro['veihclecolor'];
        $veihcleyear = $registro['veihcleyear'];
        $indate = $registro['indate'];
        $outdate = $registro['outdate'];
        $materiais = $registro['materiais'];
        $maodeobra = $registro['maodeobra'];
        $payment = $registro['payment'];
        $description = $registro['description'];


        echo "<tr>";
        echo "<td>" . $clientname . "</td>";
        echo "<td>" . $veihclemodel . "</td>";
        echo "<td>" . $veihcleplate . "</td>";
        echo "<td>" . $veihclcolor . "</td>";
        echo "<td>" . $veihcleyear . "</td>";
        echo "<td>" . $indate . "</td>";
        echo "<td>" . $materiais . "</td>";
        echo "<td>" . $maodeobra . "</td>";
        echo "<td>" . $payment . "</td>";
        echo "<td>" . $description . "</td>";
        echo "           
            <td>
                <a href='crud.php?acao=deletar&id=$id'><img src='delete_crud.png' alt='Deletar' title='Deletar registro'></a>
                <a href='crud.php?acao=montar&id=$id'><img src='update_crud.png' alt='Atualizar' title='Atualizar registro'></a>
                <a href='index.php'><img src='insert_crud.png' alt='Inserir' registro'></a>
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