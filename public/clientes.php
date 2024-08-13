<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/styles/style.css">
    <title>LS CUSTOMS</title>
</head>
<body>
      <!--HEADER-->
      <nav class="Header">
        </label>
        <label class="logo">LS CUSTOMS</label>
        <ul>
            <li><a href="../index.html">Home</a></li>
            <li><a href="../models/user.php?acao=selecionar">CLIENTES</a></li>
        </ul>
    </nav>
    <!--FIM HEADER-->
<div class="body-pages">
    <div class="container-pages">
      <section class="header-pages">
      <h2>NOVO CLIENTE</h2>
      </section>
    
      <form method="post" action="../models/user.php?acao=inserir" class="form">
      <div class="form-content">
        <label for="clientname">Nome do cliente:</label>
        <input type="text" id="clientName" name="clientname" placeholder="Digite o nome do cliente." required>
      </div>

      <div class="form-content">
        <label for="clientcpf">CPF do cliente:</label>
        <input type="text" id="clientcpf" name="clientcpf" placeholder="Digite o CPF do cliente." required>
      </div>

      <div class="form-content">
        <label for="clientadress">Endereço do cliente:</label>
        <input type="text" id="clientadress" name="clientadress" placeholder="Digite o endereço do cliente." required>
      </div>

      <div class="form-content">
        <label for="clientcep">CEP:</label>
        <input type="text" id="clientcep" name="clientcep" placeholder="Digite o CEP do cliente." required>
      </div>

      <div class="form-content">
        <label for="clientnumber">Telefone do cliente:</label>
        <input type="number" id="clientnumber" name="clientnumber" placeholder="Digite o telefone do cliente." required>
      </div>

      <div class="form-content">
        <label for="clientemail">E-mail do cliente:</label>
        <input type="text" id="clientemail" name="clientemail" placeholder="Digite o e-mail do cliente." required>
      </div>

      <button type="submit">Cadastrar</button>

    </form>

  </div>
  <div>

  <script src="./script.js"></script>
</body>
</html>