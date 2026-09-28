<?php
// src/fornecedor_crud.php

//Todos as funções neste arquivo precisarão do script de conexão
require_once "conecta.php";

//Usada em fornecedores/listar.php
function buscarFornecedores(PDO $conexao): array {
    //montando comando SQL para a consulta
    $sql = "SELECT * FROM fornecedores ORDER BY nome";

    //Executar o comando e guardando o resultado da consulta
    $consulta = $conexao->query($sql);

    //Retornando o resultado como um array associativo
    return $consulta->fetchAll();
}