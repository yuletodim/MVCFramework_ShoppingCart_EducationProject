<?php
$config['default']['connection_url'] = 'mysql:host=localhost;dbname=application';
$config['default']['username'] = 'root';
$config['default']['password'] = '';
$config['default']['pdo_options'][PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES 'UTF8'";
$config['default']['pdo_options'][PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

return $config;
