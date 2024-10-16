<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Números</title>
</head>
<body>
    <form method="post">
        <?php for ($indiceNumero = 1; $indiceNumero <= 10; $indiceNumero++): ?>
            <label for="campo_numero_<?= $indiceNumero ?>">Número <?= $indiceNumero ?>:</label>
            <input type="number" name="campo_numero_<?= $indiceNumero ?>" required>
            <br>
        <?php endfor; ?>
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $listaNumerosInseridos = [];

        for ($indiceNumero = 1; $indiceNumero <= 10; $indiceNumero++) {
            $listaNumerosInseridos[] = (int)$_POST["campo_numero_$indiceNumero"];
        }

        $quantidadeNumerosNegativos = 0;
        $quantidadeNumerosPositivos = 0;
        $quantidadeNumerosPares = 0;
        $quantidadeNumerosImpares = 0;

        foreach ($listaNumerosInseridos as $numeroAtual) {
            if ($numeroAtual < 0) {
                $quantidadeNumerosNegativos++;
            } else {
                $quantidadeNumerosPositivos++;
            }

            if ($numeroAtual % 2 == 0) {
                $quantidadeNumerosPares++;
            } else {
                $quantidadeNumerosImpares++;
            }
        }

        ?>
        <h2>Resultados:</h2>
        <p>Quantidade de números negativos: <?= $quantidadeNumerosNegativos ?></p>
        <p>Quantidade de números positivos: <?= $quantidadeNumerosPositivos ?></p>
        <p>Quantidade de números pares: <?= $quantidadeNumerosPares ?></p>
        <p>Quantidade de números ímpares: <?= $quantidadeNumerosImpares ?></p>
    <?php } ?>
</body>
</html>