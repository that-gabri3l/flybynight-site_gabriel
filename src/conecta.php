<?php
// src/conecta.php

//Parâmetros de conexão ao servidor MySQL
$servidor = "localhost";
$banco = "flybynight_completo";
$usuario = "root";
$senha = "senacpenha";

/* Usamos o try/catch para realizar as operações de  conexão ao servidor*/
try {
    //Criando um objeto a partir da classe PDO
    //PDO é uma classe de recursos para manipulação de bancos de dados
    $conexao = new PDO(
        "mysql:host=$servidor;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha
    );
    //Garantindo que erros/exceções serão lançados/exibidas em qualquer falhe na conexão
    $conexao->setAttribute(PDO:: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);

    //Garantindo que resultados de operações SELECT sejam retornados como a array associativo
    $conexao->setAttribute(PDO:: ATTR_DEFAULT_FETCH_MODE, PDO ::FETCH_ASSOC);
} catch (PDOException $erro) {
    //Logar/registrar o erro e exibir no terminal
    error_log($erro->getMessage());

    //Na interface publica, exibimos uma mensagem genérica para o usuario
    exit("Não foi possivel conectar ao banco.");
}

//Teste provisorio
var_dump($conexao);