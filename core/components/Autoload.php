<?php

  namespace Voopsc;
  spl_autoload_register(function($className){
    $array_paths = array(
        '/models/',
        '/models/Voopsc',
        '/components/',
        '/controllers/',
    );

    foreach ($array_paths as $path) {
      $path = ROOT . '/core/' . $path . $className . '.php';
      if (file_exists($path)) {
        include_once $path;
      }
    }

  });
