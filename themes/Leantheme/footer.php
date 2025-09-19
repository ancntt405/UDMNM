<!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted mt-5 shadow-sm">
  <!-- Social media section -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Theo dõi mạng xã hội:</span>
    </div>
    <!-- Right -->
    <div>
    <a href="<?php echo get_theme_mod('social_facebook', '#'); ?>" target="_blank" class="me-3 text-muted link-primary text-decoration-none">
      <i class="bi bi-facebook fs-5"></i>
    </a>
    <a href="<?php echo get_theme_mod('social_twitter', '#'); ?>" target="_blank" class="me-3 text-muted link-primary text-decoration-none">
      <i class="bi bi-twitter-x fs-5"></i>
    </a>
    <a href="<?php echo get_theme_mod('social_tiktok', '#'); ?>" target="_blank" class="me-3 text-muted link-primary text-decoration-none">
      <i class="bi bi-tiktok fs-5"></i>
    </a>
    </div>
  </section>
  
  <!-- Links & contact section -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <div class="row mt-3">
        <!-- Company info -->
        <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            <?php the_custom_logo(); ?>
          </h6>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit explicabo saepe laudantium, harum sapiente dolorem facere iusto est dolore.
          </p>
        </div>

        <!-- Products -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4 text-danger">Tin mới nhất</h6>
          <?php
            // Lấy 3 bài viết mới nhất
            $latest_posts = new WP_Query(array(
                'posts_per_page' => 3,
                'post_status' => 'publish'
            ));

            if ( $latest_posts->have_posts() ) :
                while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
                    <p> <i class="bi bi-caret-right"></i>
                      <a href="<?php the_permalink(); ?>" class="text-muted text-decoration-none">
                        <?php the_title(); ?>
                      </a>
                    </p>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p class="text-muted">Chưa có bài viết nào.</p>
            <?php endif; ?>
        </div>

        <!-- Contact -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="text-uppercase fw-bold mb-4 text-danger">Liên hệ</h6>
          <p><i class="bi bi-house-door-fill me-2"></i> <?php echo get_theme_mod('contact_address'); ?></p>
          <p><i class="bi bi-envelope-at-fill me-2"></i> <?php echo get_theme_mod('contact_email'); ?></p>
          <p><i class="bi bi-telephone-fill me-2"></i> <?php echo get_theme_mod('contact_phone'); ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: #b2cffbff">
    © <?php echo date('Y'); ?> Bản quyền:
    <a class="text-muted fw-bold text-decoration-none">Hồng Ân</a>
  </div>
</footer>
<!-- Footer -->

<?php wp_footer(); ?>
</body>
</html>