<?php
echo "Tentando incluir...\n";
$em = require realpath(__DIR__ . '/config/doctrine.php');
echo "Incluído com sucesso!";
