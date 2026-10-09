<?php
require_once "../src/loja_produto_crud.php";
$lojasProdutos = buscarLojasProdutos($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos por loja - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'lojas_produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Produtos por loja</h2>
        <p>Gerencie os vínculos e o estoque de cada produto nas lojas. A exclusão remove somente o vínculo.</p>
        <div class="barra-acoes"><a class="botao" href="inserir.php">+ Novo vínculo</a></div>
        <div class="area-tabela" tabindex="0">
            <table>
                <caption>Relação de Produtos por loja</caption>
                <thead>
                    <tr>
                        <th scope="col">Loja</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Estoque</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lojasProdutos as $lojaProduto): ?>
                        <tr>
                            <td><?= htmlspecialchars($lojaProduto["nome_loja"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars($lojaProduto["nome_produto"], ENT_QUOTES, "UTF-8") ?></td>
                            <td><?= htmlspecialchars((string) $lojaProduto["estoque"], ENT_QUOTES, "UTF-8") ?></td>
                            <td>
                                <a href="editar.php?loja_id=<?= (int) $lojaProduto["loja_id"] ?>&amp;produto_id=<?= (int) $lojaProduto["produto_id"] ?>">Editar</a>
                                <a href="excluir.php?loja_id=<?= (int) $lojaProduto["loja_id"] ?>&amp;produto_id=<?= (int) $lojaProduto["produto_id"] ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>