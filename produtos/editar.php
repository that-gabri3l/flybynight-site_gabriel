<?php
//produtos/editar.php

/*Exercicios */

//PARTE 1

// 1) Importar os arquivos de função de fornecedores e produtos 
require_once "../src/fornecedor_crud.php";
require_once "../src/produto_crud.php";

// 2) Capturar e guardar o id do produto que será carregado/atualizado
$id = $_GET['id'];

// 3) Chamar a função buscarProdutoPorId e receber os dados do produto (guarde em uma variavel chamada $fornecedores)
$fornecedores = buscarFornecedores($conexao);

// 4) Chamar a função buscarProdutoPorId e receber os dados do produto (guarde em uma variavel chamada $produto)
$produto = buscarProdutoPorId($conexao, $id);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $fornecedor = $_POST['fornecedor'];
    atualizarProduto($conexao, $id, $nome, $descricao, $preco, $quantidade, $fornecedor);
    header("location:listar.php");
    exit;
}

//Parte 2

// 1) Detectar o acionamento do formulario de atualização

// 2) Capturar os dados do formulario

// 3) Chamar a função atualizarProduto e passar os dados pra ela

// 4) Redirecionar para a pagina listar produtos

// 5) Testar: tente atualizar dados de pelo menos 3 produtos
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar produto - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Editar produto</h2>
        <!-- PARTE 1
        5) Exibir os dados do produto em cada campo do formulario, No caso dos campos input, use o atributo value.
        No caso do campo textarea, coloque o valor dentro da tag. -->
        <form action="" method="post">
            <div>
                <label for="nome">Nome:</label>
                <input value="<?= htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8') ?>" type="text" name="nome" id="nome" maxlength="100" require      d>
            </div>
            <div>
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="5"><?= htmlspecialchars($produto['descricao'], ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>
            <div>
                <label for="preco">Preço:</label>
                <input value="<?= htmlspecialchars($produto['preco'], ENT_QUOTES, 'UTF-8') ?>" type="number" name="preco" id="preco" min="0" step="0.01" required>
            </div>
            <div>
                <label for="quantidade">Quantidade:</label>
                <input value="<?= htmlspecialchars($produto['quantidade'], ENT_QUOTES, 'UTF-8') ?>" type="number" name="quantidade" id="quantidade" min="0" step="1" required>
            </div>
            <div>
                <label for="fornecedor">Fornecedor:</label>
                <select name="fornecedor" id="fornecedor" required>
                    <option value="">Selecione</option>

                <!-- PARTE 1 -->
                <!-- 6) DESAFIO
                
                6.1) Usando foreach, acessa os $fornecedores e mostre na tag <option> os nomes da cada fornecedor. No atributo value, coloque o id de cada fornecedor.

                6.2) O fornecedor daquele produto que esta sendo exibido, ja deve VIR SELECIONADO. Programe os recursos pra isso acontecer. -->
                
                    <?php foreach ($fornecedores as $fornecedor): ?>
                        <option value="<?= htmlspecialchars($fornecedor['id'], ENT_QUOTES, 'UTF-8') ?>" <?= $fornecedor['id'] == $produto['fornecedor_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($fornecedor['nome'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Atualizar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>