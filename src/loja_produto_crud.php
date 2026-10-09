<?php
//src/loja_produto_crud.php

require_once "conecta.php";

function buscarLojasProdutos(PDO $conexao): array
{
    $sql = "SELECT
                lojas_produtos.loja_id,
                lojas.nome AS nome_loja,
                lojas_produtos.produto_id,
                produtos.nome AS nome_produto,
                lojas_produtos.estoque
            FROM lojas_produtos
            JOIN lojas ON lojas.id = lojas_produtos.loja_id
            JOIN produtos ON produtos.id = lojas_produtos.produto_id
            ORDER BY lojas.nome, produtos.nome";
    $consulta = $conexao->query($sql);
    return $consulta->fetchAll();
}

function inserirLojaProduto(
    PDO $conexao,
    int $lojaId,
    int $produtoId,
    int $estoque
) : void {
    $sql = "INSERT INTO lojas_produtos (loja_id, produto_id, estoque) 
    VALUES (:loja_id, :produto_id, :estoque)";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":loja_id", $lojaId, PDO::PARAM_INT);
    $consulta->bindValue(":produto_id", $produtoId,PDO::PARAM_INT);
    $consulta->bindValue(":estoque", $estoque, PDO::PARAM_INT);
    $consulta->execute();
}

function buscarLojaProdutoPorIds(PDO $conexao, int $lojaId, int $produtoId): ?array
{
    $sql = "SELECT
                lojas_produtos.loja_id,
                lojas.nome AS nome_loja,
                lojas_produtos.produto_id,
                produtos.nome AS nome_produto,
                lojas_produtos.estoque
            FROM lojas_produtos
            JOIN lojas ON lojas.id = lojas_produtos.loja_id
            JOIN produtos ON produtos.id = lojas_produtos.produto_id
            WHERE lojas_produtos.loja_id = :loja_id
                AND lojas_produtos.produto_id = :produto_id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":loja_id", $lojaId, PDO::PARAM_INT);
    $consulta->bindValue(":produto_id", $produtoId, PDO::PARAM_INT);
    $consulta->execute();

    return $consulta->fetch() ?: null;
}



