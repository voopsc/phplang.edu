<?php

    namespace Voopsc;

    /** Class which get different data as config, data array and other from files
     *
     */
    class DataReciver
    {

      // function __construct()
      // {
      //   // code...
      // }


      /** Get data from file by $filepath and return it as array
      *
      * @param string $filepath
      * @return array
      */
      public function getDataAsArray($filepath)
      {
        if (isset($filepath) && !empty($filepath)) {
          $data = [];
          if (file_exists($filepath)) {
            $data = [];
            $data = include_once($filepath);
          }
          return $data;
        }
      }
      // end of class
    }
