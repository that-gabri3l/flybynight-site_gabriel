<?php
require_once "../src/loja_crud.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    header('Location: listar.php');
    exit;
}

$loja = buscarLojaPorId($conexao, $id);
if (!$loja) {
    header('Location: listar.php');
    exit;
}

$nome = $loja['nome'];
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $nome = trim($_POST['nome'] ?? '');
    $nome = trim(
        filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
        );

    if ($nome === '') {
        $erro = 'Informe o nome da loja.';
    } else {
        atualizarLoja($conexao, $id, $nome);
        header('Location: listar.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar loja - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'lojas';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Editar loja</h2>
        <form action="" method="post">
            <?php if ($erro !== ''): ?>
                <p role="alert"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>
            <div>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" maxlength="100" value="<?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <button type="submit">Atualizar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>