<?php
$config['default_controller'] = 'Home';
$config['default_method'] = 'home';

$config['namespaces']['Controllers'] =
    'C:/xampp/htdocs/WebDevelopmentBasics/MVCFramework_ShoppingCart_EducationProject/trunk/ShoppingCart/Controllers';

$config['namespaces']['Models'] =
    'C:/xampp/htdocs/WebDevelopmentBasics/MVCFramework_ShoppingCart_EducationProject/trunk/ShoppingCart/Models';

$config['session']['autostart'] = true;
$config['session']['type'] = 'database';
$config['session']['name'] = '_sess';
$config['session']['lifetime'] = 3600;
$config['session']['path'] = '/';
$config['session']['domain'] = '';
$config['session']['secure'] = false;
$config['session']['db_connection'] = 'default';
$config['session']['db_table'] = 'session';

$config['display_exceptions'] = false;

return $config;
// or return array();