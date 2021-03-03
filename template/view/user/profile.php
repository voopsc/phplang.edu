<?php include_once(TEMPLATE . '/view/parts/head.php'); ?>
<?php include_once(TEMPLATE . '/view/parts/header.php'); ?>
<main>
  <section class="profile">
    <div class="wrapper">
      <div class="full">
        <h1 class="title-main">Profile</h1>
      </div>
      <div class="full-width">
        <form class="profile-form form-main flex" action="#" method="post" enctype="multipart/form-data">
          <div class="one-of-three">
            <fieldset>
              <span class="label">You avatar</span>
              <div class="img-wrp user-avatar" style="background: url('<?php echo $userAvatar; ?>') no-repeat center center; background-size: cover;">
              </div>
              <label class="picture-select hidden-input">
                <input type="file" name="image" value="">
                <span class="label">Select photo</span>
              </label>
            </fieldset>
            <p class="error">
              <a href="/profile/delete-image">Delete image</a>
            </p>
          </div>
          <div class="two-of-three">
            <fieldset>
              <span class="label">Your login</span>
              <label>
                <input type="text" name="user_login" value="<?php echo $userData['user_login']; ?>" minlength="2" required>
              </label>
            </fieldset>
            <fieldset>
              <span class="label">Phone number</span>
              <label>
                <input type="tel" name="user_phone" value="<?php echo $userData['user_phone']; ?>" required maxlength="17" placeholder="+38 0__ ___ __ __">
              </label>
            </fieldset>
            <fieldset>
              <span class="label">Your email <small>(optional)</small> </span>
              <label>
                <input type="email" name="user_email" value="<?php echo $userData['user_email']; ?>" >
              </label>
            </fieldset>
            <h2 class="title">Change password</h2>
            <fieldset>
              <span class="label">You password</span>
              <label>
                <input type="password" name="user_password" value="" minlength="3" required>
              </label>
            </fieldset>
            <fieldset>
              <span class="label">New password</span>
              <label>
                <input type="password" name="new_password" value="" minlength="3" required>
              </label>
            </fieldset>
            <fieldset>
              <span class="label">Repeat new password</span>
              <label>
                <input type="password" name="new_pass_repeat" value="" minlength="3" required>
              </label>
            </fieldset>
            <?php if (isset($notices) && !empty($notices)): ?>
              <?php foreach ($notices as $notice): ?>
                <p class="done"><?php echo $notice; ?></p>
              <?php endforeach; ?>
            <?php endif; ?>
            <?php if (isset($errors) && !empty($errors)): ?>
              <?php foreach ($errors as $error): ?>
                <p class="error"><?php echo $error; ?></p>
              <?php endforeach; ?>
            <?php endif; ?>
            <fieldset>
              <button type="submit" name="submit" class="btn">Send</button>
            </fieldset>
          </div>
        </form>
      </div>
    </div>
  </section>
</main>
<?php include_once(TEMPLATE . '/view/parts/footer.php'); ?>
