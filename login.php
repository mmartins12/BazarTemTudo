<?php
session_start();

// Já está logado -> vai direto para a consulta
if (isset($_SESSION["usuario"])) {
    header("Location: /bazar/index.php");
    exit;
}

$erro = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["usuario"] ?? "";
    $senha = $_POST["senha"] ?? "";

    // Único usuário permitido
    if ($usuario === "mbelo" && $senha === "patasdegalinha") {
        session_regenerate_id(true); // evita fixação de sessão
        $_SESSION["usuario"] = $usuario;
        header("Location: /bazar/index.php");
        exit;
    }

    $erro = true;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bazar - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="max-width: 400px;">
        <h1 class="mt-5 mb-4">Login</h1>

        <?php if ($erro): ?>
            <div class="alert alert-danger" role="alert">
                Usuário ou senha inválidos.
            </div>
        <?php endif; ?>

        <form method="post" action="/bazar/login.php">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required autofocus>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>
</body>
</html>
