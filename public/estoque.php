<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
            <li><a href="../models/stock.php?acao=selecionar">ESTOQUE</a></li>
        </ul>
    </nav>
    <!--FIM HEADER-->
<div class="body-pages">
    <div class="container-pages">
      <section class="header-pages">
      <h2>NOVO PRODUTO</h2>
    </section>
    
    <form method="post" action="../models/stock.php?acao=inserir" form class="form">
      <div class="form-content">
        <label for="productname">Nome do produto:</label>
        <input type="text" name="productname" placeholder="Nome do produto." required>
      </div>

      <div class="form-content">
        <label for="productdescription">Descrição do produto:</label>
        <input type="textarea" name="productdescription" placeholder="Descrição do produto." required>
      </div>

      <div class="form-content">
        <label for="productbarcode">Código da barras:</label>
        <input type="number" name="productbarcode" placeholder="Código de barras do produto." required>
      </div>

      <div class="form-content">
        <label for="productcategory">Categoria:</label>
        <input type="text" name="productcategory" placeholder="Categoria do produto." required>
      </div>

      <div class="form-content">
        <label for="productquantity">Quantidade:</label>
        <input type="number" name="productquantity" placeholder="Quantidade disponível." required>
      </div>

      <div class="form-content">
        <label for="productvalor">Valor:</label>
        <input type="int" name="productvalor" placeholder="Valor do produto." required>
      </div>

      <button type="submit">Cadastrar</button>

    </form>

  </div>
  <div>

  <script src="./script.js"></script>
</body>
</html>