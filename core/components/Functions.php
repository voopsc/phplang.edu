<?php


      /** Custom functions for framework
       *
       */
      class Functions
      {

        /** Check required length of string $count - integer, $string - string
        * @param integer $count
        * @param string $string
        *
        * @return boolval
        */
        public static function checkStringLength($count, $string)
        {
          if (strlen($string) >= $count) {
            return true;
          }
          return false;
        }

        /** Show value in normalize view with type
        *
        * @return mixed
        */
        public static function debug($value = '')
        {
          if (!empty($value)) {
            echo "<pre>";
            print_r($value);
            echo "</pre>";
            echo "<br>";
            var_dump($value);
          }
        }

        /** Check value of checkbox/radio elements
        *
        */
        public static function isChecked($int)
        {
          if ($int == '1') {
            echo "checked";
          }
        }
        // end of class
      }
