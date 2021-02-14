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
                    <img src="/template/img/<?php echo  $postItem['post_img']; ?>" alt="picture">
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

      </ul>
    </div>
  </section>
</main>
