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

     /** Get user avatar
     * @param int $id with user id
     * @return string with path to user image
     */
     public function getImage($id)
     {
       $image = '/template/files/img/user.jpg';
       $types = include(ROOT . '/core/config/file_types.php');

       $path = '/template/upload/user/' . $id;

       foreach ($types as $type) {
         if (file_exists(ROOT . $path . $type)) {
           return $path . $type;
         }
       }
       return $image;
     }

     /** Clear user avatar
     * @param int $id with user id
     * @return void and delete exist image
     */
     public function deleteImage($id)
     {
       $image = '/template/files/img/user.jpg';
       $types = include(ROOT . '/core/config/file_types.php');

       $path = '/template/upload/user/' . $id;

       foreach ($types as $type) {
         if (file_exists(ROOT . $path . $type)) {
           unlink(ROOT . $path . $type);
         }
       }
       return ;
     }

     /** Check user phone mask
     * @param string with phone number
     */
     public function isValidPhoneMask($string)
     {
       (string) $string;

       $validation = preg_match('~[+38] [0]([1-9]{2}) ([0-9]{3}) ([0-9]{2}) ([0-9]{2})~', $string);

       return $validation ? true : false;
     }

     // end of class
   }
