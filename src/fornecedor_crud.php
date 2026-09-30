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

//Sera usada me forncedores/inserir.php
function inserirForncedor(PDO $conexao, string $nome):void {
    /* Sobre o recebimento de dados para o comando SQL No PDO, visando minimizar a chance de injeção de código SQL nocivo à partir de entradas de dados (no caso, formulario),devemos passar no comando SQL "parâmetros nomeados"(Named Parameter).
    Esse tipo de pratica permite receber de forma segura/controlada 
    os dados para a consulta. NUNCA passe os dados de forma direta */
    
    //Passo 1: definir os parâmetros nomeados
    $sql = "INSERT INTO fornecedores (nome) VALUES(:nome)";

    //Passo 2: preparar o comando para execução
    $consulta = $conexao->prepare($sql);

    //Passo 3: vincular o valor ao parâmetro nomeado
    $consulta->bindValue(":nome", $nome);

    //Passo 4: Executar a consulta/comando no banco
    $consulta->execute();
}

//Usada em fornecedores/editar.php

function buscarFornecedoresPorId(PDO $conexao, int $id){

    //Comando SQL (atenção ao uso do parâmetro nomeado)
    $sql = "SELECT * FROM fornecedores WHERE id = :id_fornecedor";
    
    //Preparação da consulta
    $consulta = $conexao->prepare($sql);
    
    //Atribuição do valor recebido (em $id) ao parâmetro nomeado (:id)
    $consulta->bindValue(":id", $id);

    //Execução da consulta
    $consulta->execute();

    //Retorno dos dados como array associativo
    //ATENÇÃO: aqui usamos fetch() por se tratar de UM UNICO array (vetor)
    return $consulta->fetch();
}