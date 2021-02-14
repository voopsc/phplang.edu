<?php

  // namespace Voopsc;
  spl_autoload_register(function($class){

    // core prefix
    $prefix = "Core";

    // base directory for namespace prefix
    // $base_dir = '/core/models/Core';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    $namespace_exist = strncmp($prefix, $class, $len);
    // if no namespace
    if ($namespace_exist !== 0) {
      $pathArr = [
        '/models/',
        '/models/Core/',
        '/components/',
        '/controllers/',
      ];
      foreach ($pathArr as $path) {
        $filePath = ROOT . '/core' . $path . $class . '.php';
        $file = &$filePath;
        if (file_exists($filePath)) {
          require($file);
          return;
        }
      }
    }
    // if exist namespace
    if ($namespace_exist == 0) {
      $filePathArr = explode('\\', $class);
      $fileName = array_pop($filePathArr);

      $filePath = ROOT . '/core/models/';
      foreach ($filePathArr as $path) {
        $filePath .= $path . '/';
      }
      $filePath .= $fileName . '.php';
      $file = &$filePath;

      if (file_exists($filePath)) {
        require($file);
        return;
      }
    }
    // if exist namespace




    // if (strncmp($prefix, $class, $len) !== 0) {
    //
    //   echo "<br>";
    //   echo $prefix;
    //   echo "<br>";
    //   echo $class;
    //   echo "<br>";
    //   echo $len;
    // }
    //
    // echo $test;

    // if (strncmp($prefix, $class, $len) !== 0) {
    //
    //   // $classPath = str_replace($prefix, '/', $class);
    //   // $path = '/models/Core' . '/';
    //   echo $class;
    // }


    //
    // echo $class;
    // $array_paths = array(
    //     '/models/',
    //     '/models/Voopsc',
    //     '/components/',
    //     '/controllers/',
    // );
    //


  });
