<?php
// produtos/listar.php
require_once "../src/produto_crud.php";
$produtos = buscarProdutos($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Produtos</h2>
        <div class="barra-acoes"><a class="botao" href="inserir.php">+ Novo produto</a></div>
        <!-- Os registros serão carregados dinamicamente quando o back-end for implementado. -->
        <div class="area-tabela" tabindex="0">
            <table>
                <caption>Relação de Produtos</caption>
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Fornecedor</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($produtos as $produto): ?>
                    <tr>
                        <td> <?= $produto['nome_produto'] ?> </td>
                        <td> <?= $produto['preco'] ?> </td>
                        <td> <?= $produto['quantidade'] ?> </td>
                        <td> <?= $produto['nome_fornecedor'] ?> </td>
                        <td>
                            <a href="editar.php?id=<?= $produto['id'] ?>">Editar</a>
                            <a href="excluir.php?id=<?= $produto['id'] ?>" class="excluir">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </main>
    <dialog id="dialogoExclusao">
        <p>Tem certeza que deseja excluir este registro?</p>
        <div>
            <button id="cancelarExclusao" type="button">Cancelar</button>
            <button id="confirmarExclusao" type="button">Confirmar</button>
        </div>
    </dialog>

    <script>
        //O botão de confirmar fecha o modal e, em seguida, executa o redirecionamento manual (window.location.href = hrefExclusao) para a URL que foi salva lá em cima, efetivando a exclusão.
        const dialogoExclusao = document.getElementById('dialogoExclusao');
        const cancelarExclusao = document.getElementById('cancelarExclusao');
        const confirmarExclusao = document.getElementById('confirmarExclusao');
        let hrefExclusao = '';

        document.querySelectorAll('a.excluir').forEach((link) => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                hrefExclusao = link.href;
                dialogoExclusao.showModal();
            });
        });

        confirmarExclusao.addEventListener('click', () => {
            dialogoExclusao.close();
            if (hrefExclusao) {
                window.location.href = hrefExclusao;
            }
        });

        cancelarExclusao.addEventListener('click', () => {
            dialogoExclusao.close();
        });

        
        //Ela calcula as dimensões do modal na tela (getBoundingClientRect). Se o usuário clicar em uma coordenada (event.clientY e event.clientX) que esteja fora dessas dimensões (ou seja, no fundo escuro), o modal é fechado.
        dialogoExclusao.addEventListener('click', (event) => {
            const rect = dialogoExclusao.getBoundingClientRect();
            const isInside = (
                rect.top <= event.clientY &&
                event.clientY <= rect.bottom &&
                rect.left <= event.clientX &&
                event.clientX <= rect.right
            );

            if (!isInside) {
                dialogoExclusao.close();
            }
        });
    </script>
</body>

</html>