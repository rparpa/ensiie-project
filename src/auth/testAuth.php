<?php
require_once './vendor/autoload.php';
include_once 'generate.php';
require_once '../Bootstrap.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Ci-desous une liste de fonctions à utliser pour les fichiers API pour autoriser la réception de certaines méthodes d'appel aux endpoints.
function authorizeOnlyPost(): void
{
// On interdit toute méthode qui n'est pas POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['message' => 'Méthode non autorisée']);
        exit;
    }
}

function authorizeOnlyGet(): void
{
// On interdit toute méthode qui n'est pas POST
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        http_response_code(405);
        echo json_encode(['message' => 'Méthode non autorisée']);
        exit;
    }
}

function authorizeOnlyDelete(): void
{
// On interdit toute méthode qui n'est pas POST
    if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
        http_response_code(405);
        echo json_encode(['message' => 'Méthode non autorisée']);
        exit;
    }
}

function authorizeGetPost(): void
{
// On interdit toute méthode qui n'est pas POST ou GET
    if ($_SERVER['REQUEST_METHOD'] !== 'GET' || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['message' => 'Méthode non autorisée']);
        exit;
    }
}

function authorizeGetPostDelete(): void
{
    // On interdit toute méthode qui n'est pas POST ou GET ou DELETE
    if ($_SERVER['REQUEST_METHOD'] !== 'GET' || $_SERVER['REQUEST_METHOD'] !== 'POST' || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['message' => 'Méthode non autorisée']);
        exit;
    }
}

function checkIfTokenReceived(): string|null
{
    $token = null;
    // On vérifie si on reçoit un token
    if (isset($_SERVER['Authorization'])) {
        $token = trim($_SERVER['Authorization']);
    } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $token = trim($_SERVER['HTTP_AUTHORIZATION']);
    }
    return $token;
}

function checkIfBearerExists(): void
{
// On vérifie si la chaine commence par "Bearer "
    if (!isset($token) || !preg_match('/Bearer\s(\S+)/', $token, $matches)) {
        http_response_code(400);
        echo json_encode(['message' => 'Token introuvable']);
        exit;
    }
}

function extractTokenFromBearerToken(string $token): string
{
// On extrait le token
    return str_replace('Bearer ', '', $token);
}

require_once '../src/auth/key.php';
require_once '../src/auth/JWT.php';

function everyCheckOnToken(string $token)
{
    $jwt = new JWT();
    // On vérifie que le token est bien une string bien formatée
    if (!$jwt->isValid($token)) {
        http_response_code(400);
        echo json_encode(['message' => 'Token invalide']);
        exit;
    }

    // On vérifie la signature
    if (!$jwt->check($token, SECRET)) {
        http_response_code(403);
        echo json_encode(['message' => 'Le token est invalide']);
        exit;
    }

    // On vérifie l'expiration
    if ($jwt->isExpired($token)) {
        http_response_code(403);
        echo json_encode(['message' => 'Le token a expiré']);
        exit;
    }
}

//echo json_encode($jwt->getPayload($token));
