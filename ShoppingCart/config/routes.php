<?php
// A way to define a namespace
$config['admin']['namespace'] = 'Controllers\Admin';

// A way to override a controller
$config['admin']['controllers']['index']['to'] = 'index2';
//A way to override a method
$config['admin']['controllers']['index']['methods']['new'] = '_new';

$config['admin']['controllers']['new']['to'] = 'test';

// The most common case is last
$config['*']['namespace'] = 'Controllers';

return $config;