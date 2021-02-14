<?php
      /**
       *
       */
      class UserMapper
      {

        /** Get user data by user id - $id integer
        *
        * @param string
        *
        * @return array
        */
        public function read($userPhone)
        {
          $db = new Db;
          $connection = $db->getConnection();

          $sql = 'SELECT id, user_login, user_password, user_phone, user_email FROM user WHERE user_phone = :user_phone';

          $result = $connection->prepare($sql);
          $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
          $result->execute();
          return $result->fetch();
        }


        /** Get user data by password - $password string
        *
        * @param string
        *
        * @return array
        */
        public function getUserByPassword($password)
        {
          $db = new Db;
          $connection = $db->getConnection();

          $sql = 'SELECT id, user_login, user_password, user_phone, user_email FROM user WHERE user_password = :user_password';

          $result = $connection->prepare($sql);
          $result->bindParam(':user_password', $password, PDO::PARAM_LOB);
          $result->execute();
          return $result->fetch();
        }

        /** Save user in database $options is array with user register data
        * @param array $options
        */
        public function save($options)
        {
        $db = new Db;
        $connection = $db->getConnection();

        $sql = 'INSERT INTO user'
             . '(user_login, user_password, user_phone, user_email, user_role)'
             . 'VALUES '
             . '(:user_login, :user_password, :user_phone, :user_email, :user_role)';

        $result = $connection->prepare($sql);
        // \Functions::debug($connection);
         $result->bindParam(':user_login', $options['user_login'], PDO::PARAM_STR);
         $result->bindParam(':user_password', $options['user_password'], PDO::PARAM_STR);
         $result->bindParam(':user_phone', $options['user_phone'], PDO::PARAM_STR);
         $result->bindParam(':user_email', $options['user_email'], PDO::PARAM_STR);
         $result->bindParam(':user_role', $options['user_role'], PDO::PARAM_INT);
         return $result->execute();
        }
        // end of class
      }
