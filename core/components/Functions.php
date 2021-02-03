<?php


      /** Custom functions for framework
       *
       */
      class Functions
      {

        /** Show value in normalize view with type
        *
        * @return mixed
        */
        public static function debug($value)
        {
          if (!empty($value)) {
            echo "<pre>";
            print_r($value);
            echo "</pre>";
            echo "<br>";
            var_dump($value);
          }
        }
        // end of class
      }
