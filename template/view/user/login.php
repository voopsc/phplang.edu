<?php include_once(TEMPLATE . '/view/parts/head.php'); ?>
<section class="login-block">
  <div class="wrapper">
    <div class="login-wrp">
        <h1 class="title-main text-center">Login</h1>
        <form class="form-main" action="#" method="post">
          <fieldset>
            <span class="label">Phone number</span>
            <label>
              <input type="tel" autocomplete="tel" name="user_phone" value="<?php echo $options['user_phone'] ?>" required tabindex="1" minlength="<?php echo $phoneAllowedLength; ?>" maxlength="<?php echo $phoneAllowedLength; ?>"
              pattern="[+380\s][0-9\s]+">
            </label>
          </fieldset>
          <fieldset>
            <span class="label">Password</span>
            <label>
              <input type="password" name="user_password" autocomplete="new-password" value="<?php echo $options['user_password']; ?>" minlength="<?php echo $passwordAllowedLength; ?>" required tabindex="2">
            </label>
          </fieldset>
          <fieldset>
            <button type="submit" name="submit" class="btn" tabindex="4">Login</button>
          </fieldset>
          <fieldset>
            <label class="hidden-input">
              <input type="checkbox" name="remember_me" value="1" tabindex="3" <?php Functions::isChecked($options['remember_me']); ?>>
              <span class="checkmark"></span>
              <span class="label">Remeber me</span>
            </label>
          </fieldset>
        </form>
        <a href="/registration" class="link-text block f-center">Go to registration</a>
        <?php if (isset($errors) && !empty($errors)): ?>
          <?php foreach ($errors as $error): ?>
            <p class="error"><?php echo $error; ?></p>
          <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <!-- <?php echo Functions::debug($result); ?> -->
  </div>
</section>
<?php include_once(TEMPLATE . '/view/parts/footer.php'); ?>
