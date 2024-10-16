<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas dos Alunos</title>
</head>
<body>
    <form method="post">
        <?php for ($numeroAluno = 1; $numeroAluno <= 10; $numeroAluno++): ?>
            <label for="nome_aluno_<?= $numeroAluno ?>">Nome do Aluno <?= $numeroAluno ?>:</label>
            <input type="text" name="nome_aluno_<?= $numeroAluno ?>" required>
            <label for="nota_aluno_<?= $numeroAluno ?>">Nota:</label>
            <input type="number" name="nota_aluno_<?= $numeroAluno ?>" step="0.01" required>
            <br>
        <?php endfor; ?>
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $listaNomesAlunos = [];
        $listaNotasAlunos = [];

        for ($numeroAluno = 1; $numeroAluno <= 10; $numeroAluno++) {
            if (isset($_POST['nome_aluno_' . $numeroAluno]) && !empty($_POST['nome_aluno_' . $numeroAluno])) {
                $listaNomesAlunos[] = $_POST['nome_aluno_' . $numeroAluno];
            }
            if (isset($_POST['nota_aluno_' . $numeroAluno]) && !empty($_POST['nota_aluno_' . $numeroAluno])) {
                $listaNotasAlunos[] = (float)$_POST['nota_aluno_' . $numeroAluno];
            }
        }

        function calcularMediaNotasClasse($listaNotasAlunos) {
            return array_sum($listaNotasAlunos) / count($listaNotasAlunos);
        }

        function encontrarAlunoComMaiorNota($listaNomesAlunos, $listaNotasAlunos) {
            $maiorNotaAluno = max($listaNotasAlunos);
            $indiceAlunoComMaiorNota = array_search($maiorNotaAluno, $listaNotasAlunos);
            return $listaNomesAlunos[$indiceAlunoComMaiorNota];
        }

        $mediaNotasClasse = calcularMediaNotasClasse($listaNotasAlunos);
        $alunoComMaiorNota = encontrarAlunoComMaiorNota($listaNomesAlunos, $listaNotasAlunos);
    ?>
    <h2>Resultados:</h2>
    <p>Média das notas da classe: <?= number_format($mediaNotasClasse, 2) ?></p>
    <p>Aluno com a maior nota: <?= $alunoComMaiorNota ?></p>
    <?php } ?>
</body>
</html>