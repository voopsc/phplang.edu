    <header class="header">
      <div class="wrapper v-center f-between">
        <a href="/" class="logo" title="logo">
          <img src="#" alt="company logo">
        </a>
        <div class="action-box">
          <?php if (isset($userData) && !empty($userData)): ?>
            <a href="/profile" title="My profile"><?php echo $userData['user_login']; ?></a>
            <a href="/logout" title="logout">Logout</a>
            <?php else: ?>
            <a href="/login" title="logout">Login</a>
          <?php endif; ?>
        </div>
      </div>
    </header>
