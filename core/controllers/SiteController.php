<?php
    /**
     *
     */
    class SiteController
    {

      public function actionHome()
      {
        $user = new User;
        $userData = $user->getLoggedUserData();

        require_once(TEMPLATE . '/view/home.php');
        return true;
      }

      public function actionRegistration()
      {
        $isRegistered = false;
        $errors = [];
        $user = new User;

        // $userLogged = $user->checkLogged();
        // if (!empty($userLogged)) {
        //   header("Location: /news");
        // }


        $loginAllowedLength = (int) 2;
        $passwordAllowedLength = (int) 6;
        $phoneAllowedLength = (int) 17;

        $options = [
          'user_login' => '',
          'user_password' => '',
          'user_phone' => '+38',
          'user_email' => '',
          'user_role' => 1,
          'user_agreement' => 0,
        ];

        if (isset($_POST['submit'])) {
          $db = new UserMapper;

          // check post data for allowed options
          foreach ($options as $option => $value) {
            if (array_key_exists($option, $_POST)) {
              $options[$option] = $_POST[$option];
            }
          }

          $userData = $db->read($options['user_phone']);
          if (!empty($userData['user_phone'])) {
            $errors[] = 'User with this phone is already exist';
          }

          // Check agre of data processing
          if (!$user->checkUserAgreement($options['user_agreement'])) {
            $errors[] = 'Please agree with processing of personal data';
          }
          // Check lenth of user login
          if (!$user->checkRequiredLength($options['user_login'], $loginAllowedLength)) {
            $errors[] = "Your login must be more than {$loginAllowedLength} symbols";
          }
          // Check lenth of user password
          if (!$user->checkRequiredLength($options['user_password'], $passwordAllowedLength)) {
            $errors[] = "Your password must not be less than {$passwordAllowedLength} symbols";
          }
          // Check lenth of user phone number
          if (!$user->checkRequiredLength($options['user_phone'], $phoneAllowedLength)) {
            $errors[] = "Your phone number must not be less than {$phoneAllowedLength} symbols";
          }
          // Check allowed symbols of phone number
          // $options['user_phone'] = ltrim($options['user_phone'], '+');
          // if (!ctype_digit($options['user_phone'])) {
          //   $errors[] = 'Your phone number must contain only numbers';
          // }

          // Check allowed symbols of login & pass
          if (!ctype_alnum($options['user_login'])) {
            $errors[] = 'Your login must contain only letters and numbers';
          }
          if (!ctype_alnum($options['user_password'])) {
            $errors[] = 'Your password must contain only letters and numbers';
          }

          // Register action
          if (empty($errors)) {
            $options['user_password'] = password_hash($options['user_password'], PASSWORD_DEFAULT);
            $isRegistered = $db->save($options);
            $errors[] = 'Registration is already done';
          }

        }

        require_once(TEMPLATE . '/view/user/registration.php');
        return true;
      }

      public function actionLogin()
      {
        $user = new User;

        // $userLogged = $user->checkLogged();
        // if (!empty($userLogged)) {
        //   header("Location: /news");
        // }

        $errors = [];

        $phoneAllowedLength = (int) 17;
        $passwordAllowedLength = (int) 6;

        $options = [
          'user_phone' => '+38',
          'user_password' => '',
          'remember_me' => 0
        ];

        if (isset($_POST['submit'])) {
          $user = new User;
          $db = new UserMapper;

          $options['user_phone'] = $_POST['user_phone'];
          $options['user_password'] = $_POST['user_password'];
          if (array_key_exists('remember_me', $_POST)) {
            $options['remember_me'] = $_POST['remember_me'];
          }

          $userData = $db->read($options['user_phone']);
          if (empty($userData)) {
            $errors[] = 'There is no user with this data';
          } else {
            $result = password_verify($options['user_password'], $userData['user_password']);
            if (!$result) {
              $errors[] = 'Incorrect password';
            }
          }
          if (empty($errors)) {
            switch ($options['remember_me']) {
              case 0: $_SESSION['isLogged'] = $userData['user_password']; break;
              case 1: setcookie('isLogged', $userData['user_password'], time() + 60 * 60 * 24 * 7); break;
            }
            header("Location: /");
          }

        }

        require_once(TEMPLATE . '/view/user/login.php');
        return true;
      }

      public function actionLogout()
      {
        if (!empty($_SERVER['HTTP_REFERER'])) {
          $referrer = $_SERVER['HTTP_REFERER'];
        } else {
          $referrer = '/';
        }
        unset($_SESSION['isLogged']);
        setcookie('isLogged', $options['user_phone'], time() - 3600);

        header("Location: $referrer");
      }
      // end of class
    }
