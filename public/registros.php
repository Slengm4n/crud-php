<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../STYLES/style.css">
    <title>LS CUSTOMS</title>
</head>
<body>
      <!--HEADER-->
      <nav class="Header">
        </label>
        <label class="logo">LS CUSTOMS</label>
        <ul>
            <li><a href="../index.html">Home</a></li>
            <li><a href="../PAGES/opcoes.php">OPÇÕES</a></li>
            <li><a href="../CRUD_REGISTROS/crud.php?acao=selecionar">REGISTROS</a></li>
        </ul>
    </nav>
    <!--FIM HEADER-->
<div class="body-pages">
    <div class="container-pages">
      <section class="header-pages">
      <h2>Registro de serviços</h2>
    </section>
    
    <form method="post" action="../models/registry.php?acao=inserir" form class="form">
      <div class="form-content">
        <label for="clientname">Nome do cliente:</label>
        <input type="text" name="clientname" placeholder="Digite o nome do cliente." required>
      </div>

      <div class="form-content">
        <label for="veihclemodel">Modelo do veículo:</label>
        <input type="text" name="veihclemodel" placeholder="Modelo do veículo." required>
      </div>

      <div class="form-content">
        <label for="veihcleplate">Placa do veículo:</label>
        <input type="text" name="veihcleplate" placeholder="Placa do veículo" required>
      </div>

      <div class="form-content">
        <label for="veihclecolor">Cor do veículo:</label>
        <input type="text" name="veihclecolor" placeholder="Cor do veículo." required>
      </div>

      <div class="form-content">
        <label for="veihcleyear">Ano do veículo:</label>
        <input type="text" name="veihcleyear" placeholder="Ano do veículo." required>
      </div>

      <div class="form-content">
        <label for="indate">Data de entrada:</label>
        <input type="date" name="indate" placeholder="Data de entrada." required>
      </div>

      <div class="form-content">
        <label for="outdate">Data de saída:</label>
        <input type="date" name="outdate" placeholder="Data de saída." required>
      </div>

      <div class="form-content">
        <label for="materiais">Custo de materiais:</label>
        <input type="text" name="materiais" placeholder="Custo de materiais." required>
      </div>

      <div class="form-content">
        <label for="maodeobra">Mão de obra:</label>
        <input type="text" name="maodeobra" placeholder="Mão de obra." required>
      </div>

      <div class="form-content">
        <label for="payment">Forma de pagamento:</label>
        <input type="text" name="payment" placeholder="Forma de pagamento." required>
      </div>

      <div class="form-content">
        <label for="description">Descrição:</label>
        <textarea name="description" placeholder="Descrição do serviço." required></textarea>
      </div>

      <button type="submit">Cadastrar</button>

    </form>

  </div>
  <div>

  <script src="./script.js"></script>
</body>
</html>