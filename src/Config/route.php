<?php

return [
  'api' => [
      'prefix' => '/api',
      'namespace' => 'IziDev\Controllers\Api',
      'routes' => include __DIR__ . "/../Routes/api.php"
  ]
];