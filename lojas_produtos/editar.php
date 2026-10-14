<?php
require_once "../src/loja_produto_crud.php";
require_once "../src/loja_crud.php";
require_once "../src/produto_crud.php";

$lojaId = filter_input(INPUT_GET, "loja_id", FILTER_VALIDATE_INT);
$produtoId = filter_input(INPUT_GET, "produto_id", FILTER_VALIDATE_INT);

$lojas = buscarLojas($conexao);
$produtos = buscarProdutos($conexao);

if ($lojaId === false || $lojaId === null || $produtoId === false || $produtoId === null) {
    header("Location: listar.php");
    exit;
}

$lojaProduto = buscarLojaProdutoPorIds($conexao, $lojaId, $produtoId);

if ($lojaProduto === null) {
    header("Location: listar.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $novaLojaId = filter_input(INPUT_POST, "loja_id", FILTER_VALIDATE_INT);
    $novoProdutoId = filter_input(INPUT_POST, "produto_id", FILTER_VALIDATE_INT);
    $estoque = filter_input(INPUT_POST, "estoque", FILTER_VALIDATE_INT);

    if (
        $novaLojaId === false || $novaLojaId === null || $novaLojaId < 1
        || $novoProdutoId === false || $novoProdutoId === null || $novoProdutoId < 1
        || $estoque === false || $estoque === null || $estoque < 0
    ) {
        http_response_code(400);
        exit("Dados inválidos para atualizar o vínculo.");
    }

    atualizarLojaProduto($conexao, $novaLojaId, $novoProdutoId, $estoque);
    header("Location: listar.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar produto em uma loja - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'lojas_produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Editar produto em uma loja</h2>
        <form action="" method="post">

            <div>
                <label for="loja">Loja:</label>
                <select name="loja_id" id="loja" required>
                    <option value="">Selecione</option>
                    <?php foreach ($lojas as $loja): ?>
                        <option value="<?= (int) $loja["id"] ?>" <?= (int) $loja["id"] === (int) $lojaProduto["loja_id"] ? "selected" : "" ?>>
                            <?= htmlspecialchars($loja["nome"], ENT_QUOTES, "UTF-8") ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="produto">Produto:</label>
                <select name="produto_id" id="produto" required>
                    <option value="">Selecione</option>
                    <?php foreach ($produtos as $produto): ?>
                        <option value="<?= (int) $produto["id"] ?>" <?= (int) $produto["id"] === (int) $lojaProduto["produto_id"] ? "selected" : "" ?>>
                            <?= htmlspecialchars($produto["nome_produto"], ENT_QUOTES, "UTF-8") ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="estoque">Estoque:</label>
                <input type="number" name="estoque" id="estoque" min="0" step="1" value="<?= (int) $lojaProduto["estoque"] ?>" required>
            </div>
            <button type="submit">Atualizar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>