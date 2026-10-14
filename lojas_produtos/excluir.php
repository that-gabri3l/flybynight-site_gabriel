<?php
require_once "../src/loja_produto_crud.php";

$lojaId = filter_input(INPUT_GET, "loja_id", FILTER_VALIDATE_INT);
$produtoId = filter_input(INPUT_GET, "produto_id", FILTER_VALIDATE_INT);

if ($lojaId !== false && $lojaId !== null && $lojaId > 0 && $produtoId !== false && $produtoId !== null && $produtoId > 0) {
    excluirLojaProduto($conexao, $lojaId, $produtoId);
}

header("Location: listar.php");
exit;
