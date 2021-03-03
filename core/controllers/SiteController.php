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

        $blog = new BlogMapper;
        $publications = $blog->getUserPostList();

        require_once(TEMPLATE . '/view/home.php');
        return true;
      }

      public function actionRegistration()
      {
        $isRegistered = false;
        $errors = [];
        $user = new User;

        $userLogged = $user->getLoggedUserData();
        if (!empty($userLogged)) {
          header("Location: /");
        }

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

        $userLogged = $user->getLoggedUserData();
        if (!empty($userLogged)) {
          header("Location: /");
        }

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
          // check phone valid
          // Check lenth of user phone number
          if (!$user->checkRequiredLength($options['user_phone'], $phoneAllowedLength)) {
            $errors[] = "Your phone number must not be less than {$phoneAllowedLength} symbols";
          }
          if (!$user->isValidPhoneMask($options['user_phone'])) {
            $errors[] = 'Please enter phone number in valid format: +38 0__ ___ __ __';
          }

          $options['user_password'] = $_POST['user_password'];
          if (array_key_exists('remember_me', $_POST)) {
            $options['remember_me'] = $_POST['remember_me'];
          }

          if (empty($errors)) {
            $userData = $db->read($options['user_phone']);
            if (empty($userData)) {
              $errors[] = 'There is no user with this data';
            } else {
              $result = password_verify($options['user_password'], $userData['user_password']);
              if (!$result) {
                $errors[] = 'Incorrect password';
              }
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

      public function actionProfile()
      {
        $user = new User;
        $userData = $user->getLoggedUserData();
        $userAvatar = $user->getImage($userData['id']);
        $errors = [];
        $notices = [];

        if ($userData && is_array($userData)) {

          if (isset($_POST['submit'])) {
            $options['id'] = $userData['id'];
            $options['user_login'] = $_POST['user_login'];
            $options['user_phone'] = $_POST['user_phone'];
            $options['user_email'] = $_POST['user_email'];

            $updating = new UserMapper;
            $result = $updating->update($options);

            if ($result) {
              $notices[] = 'Data was succesfully changed';
            }

            // change password block
            {
              if (!empty($_POST['user_password'])) {
                $userPassword = password_verify($_POST['user_password'], $userData['user_password']);
                if ($userPassword) {
                  if ($_POST['new_password'] === $_POST['new_pass_repeat']) {
                    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                    $updPassord = $updating->updatePassword($userData['id'], $newPassword);
                    $_SESSION['isLogged'] = $newPassword;
                    if ($updPassord) {
                      $notices[] = 'Password was succesfully changed';
                    }
                  } else {
                    $errors[] = 'Repeated password doesn`t match new password';
                  }
                } else {
                  $errors[] = 'Error password';
                }
              }
            }

            // сhange user profile avatar
            {

              if (isset($_FILES) && !empty($_FILES)) {

                if (is_uploaded_file($_FILES['image']["tmp_name"])) {
                  if ($_FILES['image']['error'] === 0) {

                    $fileName = $_FILES["image"]["name"];
                    $result = explode('.', $fileName);
                    $allowedTypes = include(ROOT . '/core/config/file_types.php');
                    $type = array_pop($result);

                    if (in_array('.'.$type, $allowedTypes)) {
                      $user->deleteImage($userData['id']);
                      $uploadedImg = move_uploaded_file($_FILES["image"]["tmp_name"], TEMPLATE . "/upload/user/" . $userData['id'] . '.' . $type);
                      $notices[] = 'Image was succesfully uploaded';
                    }
                  } else {
                    $errors[] = 'There is some error with uploading photo';
                  }
                }

              }

            }

            header("Location: /profile/");
          }

          require_once(TEMPLATE . '/view/user/profile.php');
          return true;
        }
        else {
          header("Location: /login");
        }
      }

      public function actionDeleteImage()
      {
        $user = new User;
        $userData = $user->getLoggedUserData();

        $user->deleteImage($userData['id']);
        header("Location: /profile");
      }
      // end of class
    }
