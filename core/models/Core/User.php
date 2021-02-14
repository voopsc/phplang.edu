<?php
   class User
   {

     /** Check is user in system if false redirect to $link value -
     * by defaul redirect to home page
     *
     * @param string $link
     */
     public function getLoggedUserData($link = '/login')
     {
       $userData = false;
       $db = new UserMapper;
       if (isset($_COOKIE['isLogged'])) {
         $userData = $db->getUserByPassword($_COOKIE['isLogged']);
       } elseif (isset($_SESSION['isLogged'])) {
         $userData = $db->getUserByPassword($_SESSION['isLogged']);
       }
       return $userData;
     }

     /** Check if user agree with processing his personal data $int - integer
     * @param integer $int
     * @return boolean
     */
     public function checkUserAgreement($int)
     {

       if (isset($int) && $int !== 0) {
         return true;
       }
       return false;
     }

     /** Check if string length ($string) is equal or more then param ($int)
     * @param string | @param int
     * @return boolean
     */
     public function checkRequiredLength($string, $int)
     {
       if (strlen($string) >= $int) {
         return true;
       }
       return false;
     }
     // end of class
   }
