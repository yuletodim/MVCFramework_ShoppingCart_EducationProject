<?php
// A way to define a namespace
$config['user']['namespace'] = 'Controllers\Admin';

// A way to override a controller
$config['user']['controllers']['home']['to'] = 'home2';
//A way to override a method
$config['user']['controllers']['home']['methods']['new'] = '_new';

$config['user']['controllers']['new']['to'] = 'test';

// The most common case is last
$config['*']['namespace'] = 'Controllers';

return $config;