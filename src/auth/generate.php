<?php

require_once 'key.php';
require_once 'JWT.php';



// On crée le header
function createHeader(): array{
    $header = [
        'typ' => 'JWT',
        'alg' => 'HS256'
    ];
    return $header;
}

// On crée le contenu (payload)
function createPayload(string $email): array{
    $payload = [
        'email' => $email
    ];
    return $payload;
}

function generateUserInfosArraysJWT(string $email): string{
    $jwt = new JWT();
    return $jwt->generateJWT(createHeader(), createPayload($email), SECRET);
}