<?php include_once(TEMPLATE . '/view/parts/head.php'); ?>
<?php include_once(TEMPLATE . '/view/parts/header.php'); ?>
<main>
  <section>
    <div class="wrapper">
      <div class="full">
        <h1 class="title-main">Latest news</h1>
      </div>
        <?php if (!empty($publications)): ?>
          <ul class="post-list list-three-items list">
          <?php foreach ($publications as $post): ?>
            <li>
              <div class="box">
                <div class="img-wrp">
                  <img src="/template/files/img/poster.jpg" alt="picture">
                </div>
                <div class="title-box">
                  <h2 class="title"><a href="/<?php echo $post['url']; ?>"><?php echo $post['post_title']; ?></a></h2>
                  <p>
                    <?php echo $post['post_description']; ?>
                  </p>
                    <a href="/<?php echo $post['url']; ?>" class="link-text"><?php echo $post['post_button_text']; ?></a>
                  </div>
                </div>
              </li>
          <?php endforeach; ?>
          </ul>
          <?php else: ?>
            <h2 class="title">There is no publications yet</h2>
        <?php endif; ?>

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
        </li> -->

    </div>
  </section>
</main>
<?php include_once(TEMPLATE . '/view/parts/footer.php'); ?>
