<?php
$config['default_controller'] = 'Index';
$config['default_method'] = 'index';

$config['namespaces']['Controllers'] =
    'C:/xampp/htdocs/WebDevelopmentBasics/MVCFramework_ShoppingCart_EducationProject/trunk/ShoppingCart/Controllers';

$config['session']['autostart'] = true;
$config['session']['type'] = 'native';
$config['session']['name'] = '_sess';
$config['session']['lifetime'] = 3600;
$config['session']['path'] = '/';
$config['session']['domain'] = '';
$config['session']['secure'] = false;

return $config;
// or return array();