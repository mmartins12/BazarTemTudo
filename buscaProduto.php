<?php
session_start();

// Primeira coisa do arquivo: sem usuário autenticado, nenhum dado é retornado
if (!isset($_SESSION["usuario"])) {
    http_response_code(401); // UNAUTHORIZED
    exit;
}

$banco_em_memoria = [
    1 => [
        "descricao" => "Marreta Para Quebrar Concreto",
        "preco" => 123.45
    ],
    // imagine centenas de produtos aqui!
];

$codigo = filter_input(INPUT_GET, "codigo", FILTER_VALIDATE_INT);

$produto = $banco_em_memoria[$codigo] ?? null;

if ($produto === null) {
    http_response_code(404); // NOT FOUND
} else {
    header("Content-Type: application/json");
    echo json_encode($produto);
}
