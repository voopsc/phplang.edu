<?php
  $postList = [];
  if (file_exists(ROOT . '/config/posts-data.php')) {
    $postList = include_once(ROOT . '/config/posts-data.php');
  }
?>
<main>
  <section>
    <div class="wrapper">
      <div class="full">
        <h1 class="title-main">Latest news</h1>
      </div>
      <ul class="post-list list-three-items list">
        <?php foreach ($postList as $postItem): ?>
          <?php if ($postItem['status'] == 1): ?>
            <li>
              <div class="box">
                <?php if (!empty($postItem['post_preview_img'])): ?>
                  <div class="img-wrp">
                    <img src="img/poster.jpg" alt="picture">
                  </div>
                <?php endif; ?>
                <?php if (!empty($postItem['post_title']) && !empty($postItem['post_description'])): ?>
                  <div class="title-box">
                    <h2 class="title"><a href="<?php echo $postItem['url']; ?>"><?php echo $postItem['post_title']; ?></a></h2>
                    <p><?php echo $postItem['post_description']; ?></p>
                      <a href="<?php echo $postItem['url']; ?>" class="link-text"><?php echo $postItem['post_button_text']; ?></a>
                    </div>
                  </div>
                <?php endif; ?>
              </li>
          <?php endif; ?>
        <?php endforeach; ?>

        <!-- <li>
          <div class="box">
            <div class="img-wrp">
              <img src="img/poster.jpg" alt="picture">
            </div>
            <div class="title-box ">
              <h2 class="title"><a href="#">Post one</a></h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna
                aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                ullamco laboris nisi ut aliquip ex ea commodo consequat.
                 Duis aute irure dolor in reprehenderit in voluptate velit
                 esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
                 occaecat cupidatat non proident, sunt in culpa qui officia
                 deserunt mollit anim id est laborum.</p>
              <a href="#" class="link-text">More...</a>
            </div>
          </div>
        </li>

        <li>
          <div class="box">
            <div class="img-wrp">
              <img src="img/poster.jpg" alt="picture">
            </div>
            <div class="title-box ">
              <h2 class="title"><a href="#">Post one</a></h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna
                aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                ullamco laboris nisi ut aliquip ex ea commodo consequat.
                 Duis aute irure dolor in reprehenderit in voluptate velit
                 esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
                 occaecat cupidatat non proident, sunt in culpa qui officia
                 deserunt mollit anim id est laborum.</p>
              <a href="#" class="link-text">More...</a>
            </div>
          </div>
        </li>
 -->
      </ul>
    </div>
  </section>
</main>
