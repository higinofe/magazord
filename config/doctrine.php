<?php

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . '/../vendor/autoload.php';

$isDevMode = true;

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/../src/Entity'],
    isDevMode: $isDevMode
);

$conn = [
    'dbname' => 'magazord',
    'user' => 'Developers',
    'password' => 'Developer@1',
    'host' => '192.168.0.45',
    'driver' => 'pdo_mysql',
];

$entityManager = EntityManager::create($conn, $config);

// 👇 Adicione isso para retornar o EntityManager corretamente
return $entityManager;
