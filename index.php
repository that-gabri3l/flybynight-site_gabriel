<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fly By Night - Gerenciamento</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '';
    $secaoAtual = 'inicio';
    require 'componentes/cabecalho.php';
    ?>
    <main>
        <h2>Gerenciamento</h2>
        <h3>Gerenciar</h3>
        <ul class="menu">
            <li><a href="fornecedores/listar.php">Fornecedores</a></li>
            <li><a href="produtos/listar.php">Produtos</a></li>
            <li><a href="lojas/listar.php">Lojas</a></li>
            <li><a href="lojas_produtos/listar.php">Produtos por loja</a></li>
            <li>
                <dialog id="meuDialogo">
                    <p>Olá! Esta é uma janela modal nativa.</p>
                    <button id="fecharBtn">Fechar</button>
                </dialog>
                <button id="abrirBtn">Abrir Diálogo</button>
            </li>
        </ul>
    </main>



<script>
    // EXEMPLO PRA FAZER OS LISTAR
    const dialogo = document.getElementById('meuDialogo');
const abrirBtn = document.getElementById('abrirBtn');
const fecharBtn = document.getElementById('fecharBtn');

// Abrir como modal
abrirBtn.addEventListener('click', () => {
  dialogo.showModal();
});

// Fechar
fecharBtn.addEventListener('click', () => {
  dialogo.close();
});

// Fechar ao clicar no fundo escurecido (backdrop)
dialogo.addEventListener('click', (event) => {
  const rect = dialogo.getBoundingClientRect();
  const isInDialog = (
    rect.top <= event.clientY &&
    event.clientY <= rect.bottom &&
    rect.left <= event.clientX &&
    event.clientX <= rect.right
  );
  if (!isInDialog) {
    dialogo.close();
  }
});

</script>
</body>

</html>