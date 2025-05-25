<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once __DIR__ . '/config/doctrine.php';

return ConsoleRunner::createHelperSet($entityManager);
