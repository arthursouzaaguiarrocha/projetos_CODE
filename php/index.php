<?php
// Define que a resposta será em formato JSON
header("Content-Type: application/json; charset=UTF-8");

// Pega o método HTTP usado (GET, POST, etc.)
$method = $_SERVER['REQUEST_METHOD'];

// Identifica a ação ou rota simples
$rota = isset($_GET['rota']) ? $_GET['rota'] : '';

// Controla as ações baseadas no método
switch ($method) {
    case 'GET':
        if ($rota === 'usuarios') {
            $dados = [["id" => 1, "nome" => "Ana"], ["id" => 2, "nome" => "Carlos"]];
            echo json_encode($dados);
        } else {
            http_response_code(404);
            echo json_encode(["erro" => "Rota não encontrada"]);
        }
        break;

    case 'POST':
        // Lê o corpo da requisição em JSON
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (isset($input['nome'])) {
            http_response_code(201);
            echo json_encode(["sucesso" => "Usuário criado", "nome" => $input['nome']]);
        } else {
            http_response_code(400);
            echo json_encode(["erro" => "Dados incompletos"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["erro" => "Método não permitido"]);
        break;
}
?>
