Aqui está o código reescrito com variáveis mais descritivas e legíveis:

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>
    <form method="post">
        <?php for ($numeroProduto = 1; $numeroProduto <= 5; $numeroProduto++): ?>
            <label for="nome_produto_<?= $numeroProduto ?>">Produto <?= $numeroProduto ?>:</label>
            <input type="text" name="nome_produto_<?= $numeroProduto ?>" required>
            <label for="preco_produto_<?= $numeroProduto ?>">Preço:</label>
            <input type="number" name="preco_produto_<?= $numeroProduto ?>" step="0.01" required>
            <br>
        <?php endfor; ?>
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $listaNomesProdutos = [];
        $listaPrecosProdutos = [];

        for ($numeroProduto = 1; $numeroProduto <= 5; $numeroProduto++) {
            $listaNomesProdutos[] = $_POST["nome_produto_$numeroProduto"];
            $listaPrecosProdutos[] = (float)$_POST["preco_produto_$numeroProduto"];
        }

        function contarProdutosComPrecoAbaixoDe($listaPrecosProdutos, $valorLimite) {
            return count(array_filter($listaPrecosProdutos, function ($precoProduto) use ($valorLimite) {
                return $precoProduto < $valorLimite;
            }));
        }

        function filtrarProdutosEntrePrecos($listaNomesProdutos, $listaPrecosProdutos, $precoMinimo, $precoMaximo) {
            return array_filter($listaNomesProdutos, function ($nomeProduto, $indice) use ($listaPrecosProdutos, $precoMinimo, $precoMaximo) {
                return $listaPrecosProdutos[$indice] >= $precoMinimo && $listaPrecosProdutos[$indice] <= $precoMaximo;
            }, ARRAY_FILTER_USE_BOTH);
        }

        function calcularMediaPrecosAcimaDe($listaPrecosProdutos, $valorLimite) {
            $precosFiltrados = array_filter($listaPrecosProdutos, function ($precoProduto) use ($valorLimite) {
                return $precoProduto > $valorLimite;
            });
            return array_sum($precosFiltrados) / count($precosFiltrados);
        }

        $quantidadeProdutosPrecoAbaixoDe50 = contarProdutosComPrecoAbaixoDe($listaPrecosProdutos, 50);
        $produtosEntre50e100Reais = filtrarProdutosEntrePrecos($listaNomesProdutos, $listaPrecosProdutos, 50, 100);
        $mediaPrecosAcimaDe100 = calcularMediaPrecosAcimaDe($listaPrecosProdutos, 100);
    ?>

    <h2>Resultados:</h2>
    <p>Quantidade de produtos com preço inferior a R$50,00: <?= $quantidadeProdutosPrecoAbaixoDe50 ?></p>
    <p>Produtos com preço entre R$50,00 e R$100,00:
        <ul>
            <?php foreach ($produtosEntre50e100Reais as $produto): ?>
                <li><?= $produto ?></li>
            <?php endforeach; ?>
        </ul>
    </p>
    <p>Média dos preços dos produtos com preço superior a R$100,00: <?= number_format($mediaPrecosAcimaDe100, 2) ?></p>

    <?php
    }
    ?>
</body>
</html>
