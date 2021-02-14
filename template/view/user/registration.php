<?php include_once(TEMPLATE . '/view/parts/head.php'); ?>
<section class="login-block">
  <div class="wrapper">
    <div class="login-wrp">
      <?php if (!$isRegistered): ?>
        <h1 class="title-main text-center">Registration</h1>
        <form class="form-main" action="#" method="post">
          <fieldset>
            <span class="label">Your login</span>
            <label>
              <input type="text" name="user_login" value="<?php echo $options['user_login']; ?>" autocomplete="username" minlength="<?php echo $loginAllowedLength; ?>" required tabindex="1">
            </label>
          </fieldset>
          <fieldset>
            <span class="label">Password</span>
            <label>
              <input type="password" name="user_password" autocomplete="new-password" value="<?php echo $options['user_password']; ?>" minlength="<?php echo $passwordAllowedLength; ?>" required tabindex="2">
            </label>
          </fieldset>
          <fieldset>
            <span class="label">Phone number</span>
            <label>
              <input type="tel" autocomplete="tel" name="user_phone" value="<?php echo $options['user_phone'] ?>" required tabindex="3" minlength="<?php echo $phoneAllowedLength; ?>" maxlength="<?php echo $phoneAllowedLength; ?>"
              pattern="[+380\s][0-9\s]+">
            </label>
          </fieldset>
          <fieldset>
            <span class="label">Your email <small>(optional)</small> </span>
            <label>
              <input type="email" autocomplete="email" name="user_email" value="<?php echo $options['user_email']; ?>" tabindex="4">
            </label>
          </fieldset>
          <fieldset>
            <button type="submit" name="submit" class="btn" tabindex="6" >Send</button>
          </fieldset>
          <fieldset>
            <label class="hidden-input">
              <input type="checkbox" name="user_agreement" value="1" tabindex="5" <?php Functions::isChecked($options['user_agreement']); ?> required>
              <span class="checkmark"></span>
              <span class="label">I agree to send my data</span>
            </label>
          </fieldset>
        </form>
        <a href="/login" class="link-text block f-center">Go to login</a>
        <?php if (isset($errors) && !empty($errors)): ?>
          <?php foreach ($errors as $error): ?>
            <p class="error"><?php echo $error; ?></p>
          <?php endforeach; ?>
        <?php endif; ?>
        <?php else: ?>
        <h1 class="title-main text-center">Thank you! You registration is done</h1>
        <a href="/login" class="btn block">Log in</a>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php include_once(TEMPLATE . '/view/parts/footer.php'); ?>
