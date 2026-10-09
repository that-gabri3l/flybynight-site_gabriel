<?php
require_once "../src/loja_crud.php";
require_once "../src/produto_crud.php";
require_once "../src/loja_produto_crud.php";

$lojas = buscarLojas($conexao);
$produtos = buscarProdutos($conexao);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lojaId = filter_input(INPUT_POST, "loja", FILTER_VALIDATE_INT);
    $produtoId = filter_input(INPUT_POST, "produto", FILTER_VALIDATE_INT);
    $estoque = filter_input(INPUT_POST, "estoque", FILTER_VALIDATE_INT);

    if (
        $lojaId === false || $lojaId === null || $lojaId < 1
        || $produtoId === false || $produtoId === null || $produtoId < 1
        || $estoque === false || $estoque === null || $estoque < 0
    ) {
        http_response_code(400);
        exit("Dados inválidos para cadastrar o produto na loja.");
    }

    inserirLojaProduto($conexao, $lojaId, $produtoId, $estoque);
    header("Location: listar.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar produto a uma loja - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'lojas_produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Adicionar produto a uma loja</h2>
        <form action="" method="post">

            <div>
                <label for="loja">Loja:</label>
                <select name="loja" id="loja" required>
                    <option value="">Selecione</option>
                    <?php foreach ($lojas as $loja): ?>
                        <option value="<?= (int) $loja["id"] ?>">
                            <?= htmlspecialchars($loja["nome"], ENT_QUOTES, "UTF-8") ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="produto">Produto:</label>
                <select name="produto" id="produto" required>
                    <option value="">Selecione</option>
                    <?php foreach ($produtos as $produto): ?>
                        <option value="<?= (int) $produto["id"] ?>">
                            <?= htmlspecialchars($produto["nome_produto"], ENT_QUOTES, "UTF-8") ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="estoque">Estoque:</label>
                <input type="number" name="estoque" id="estoque" min="0" step="1" required>
            </div>
            <button type="submit">Salvar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>