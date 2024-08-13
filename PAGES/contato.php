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
            <li><a href="../CRUD_CONTATO/crud.php?acao=selecionar">Mensagens</a></li>
        </ul>
    </nav>
    <!--FIM HEADER-->
<div class="body-pages">
    <div class="container-pages">
      <section class="header-pages">
      <h2>CONTATO</h2>
    </section>
    
    <form method="post" action="../CRUD_CONTATO/crud.php?acao=inserir"  form class="form">
      <div class="form-content">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" placeholder="Digite seu nome." required>
      </div>

      <div class="form-content">
        <label for="sobrenome">Sobrenome:</label>
        <input type="text" name="sobrenome" placeholder="Digite seu sobrenome." required>
      </div>

      <div class="form-content">
        <label for="tell">Telefone:</label>
        <input type="number" name="tell" placeholder="Digite seu telefone." required>
      </div>

      <div class="form-content">
        <label for="email">Email:</label>
        <input type="text" name="email" placeholder="Digite o seu endereço de e-mail." required>
      </div>

      <div class="form-content">
        <label for="mesage">Mensagem:</label>
        <input type="textarea" name="mesage" rows="4" cols="50" placeholder="Escreva uma breve mensagem." required>
      </div>

      <div class="form-content">
        <label for="nregistro">N° de registro</label>
        <input type="textarea" name="nregistro" rows="4" cols="50" placeholder="Escreva uma breve mensagem." required>
      </div>

      <button type="submit">Cadastrar</button>

    </form>

  </div>
  <div>

  <script src="./script.js"></script>
</body>
</html>