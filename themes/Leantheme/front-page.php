<?php
/* Template Name: Front Page */
get_header();
?>

<!-- 1. Banner -->
<?php 
$banner_bg   = get_field('banner');
$banner_title = get_field('chu1');
$banner_sub   = get_field('chu2');
?>

<section class="banner position-relative text-center text-white mb-5" 
    style="background: url('<?php echo esc_url($banner_bg['url']); ?>') no-repeat center center/cover; height: 450px;">
    
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" 
         style="background: rgba(0,0,0,0.4);"></div>
    
    <div class="container position-relative h-100 d-flex flex-column justify-content-center align-items-center">
        <?php if( $banner_title ): ?>
            <h1 class="display-4 fw-bold"><?php echo esc_html($banner_title); ?></h1>
        <?php endif; ?>
        
        <?php if( $banner_sub ): ?>
            <p class="lead"><?php echo esc_html($banner_sub); ?></p>
        <?php endif; ?>
    </div>
</section>

<!-- 2. Tin Tức Mới Nhất -->
<section id="latest-news" class="latest-news py-5 bg-light">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="d-inline-block border-bottom border-3 border-primary pb-2">
                Tin Tức Mới Nhất
            </h2>
        </div>
        <div class="row">
            <?php
            $latest_posts = new WP_Query(array(
                'posts_per_page' => 3,
                'post_status' => 'publish'
            ));
            if ($latest_posts->have_posts()) :
                while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <!-- Ảnh bài viết cân đối -->
                            <?php if (has_post_thumbnail()) : ?>
                                <div style="width:100%; height:220px; overflow:hidden;">
                                    <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" class="w-100 h-100 object-fit-cover">
                                </div>
                            <?php else: ?>
                                <div style="width:100%; height:220px; overflow:hidden;">
                                    <img src="https://brandcom.vn/wp-content/uploads/2025/03/logo-share-02.jpg" alt="Demo" class="w-100 h-100 object-fit-cover">
                                </div>
                            <?php endif; ?>
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php the_title(); ?></h5>
                                <!-- Trích đoạn bài viết -->
                                <p class="card-text text-truncate"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm mt-auto stretched-link">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p>Chưa có bài viết nào.</p>
            <?php endif; ?>
        </div>
    </div>
</section>


<!-- 3. Liên Hệ -->
<section class="contact py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="d-inline-block border-bottom border-3 border-primary pb-2">
                Liên Hệ
            </h2>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-md-3 mb-3">
                <p><i class="bi bi-house-door-fill me-2 text-danger"></i> <?php the_field('address'); ?></p>
            </div>
            <div class="col-md-3 mb-3">
                <p><i class="bi bi-envelope-at-fill me-2 text-danger"></i> <?php the_field('email2'); ?></p>
            </div>
            <div class="col-md-3 mb-3">
                <p><i class="bi bi-telephone-fill me-2 text-danger"></i> <?php the_field('phone'); ?></p>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-auto">
                <a href="<?php the_field('facebook'); ?>" target="_blank" class="me-3 text-primary fs-4"><i class="bi bi-facebook"></i></a>
                <a href="<?php the_field('twitter'); ?>" target="_blank" class="me-3 text-dark fs-4"><i class="bi bi-twitter-x"></i></a>
                <a href="<?php the_field('tiktok'); ?>" target="_blank" class="text-dark fs-4"><i class="bi bi-tiktok"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- 4. Blog cá nhân -->
<section class="blog py-5 bg-light">
    <div class="container">
    <div class="text-center mb-4">
        <h2 class="d-inline-block border-bottom border-3 border-primary pb-2">
            Blog Cá Nhân
        </h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10 mb-4 mx-auto">
            <div class="card h-100 shadow-sm p-4 text-center">
                <!-- Avatar -->
                <?php 
                $avatar_img  = get_field('avatar2');
                ?>
                <?php if( $avatar_img ): ?>
                <div class="mx-auto mb-3" style="width: 140px; height: 140px;">
                    <img src="<?php echo esc_url($avatar_img['url']); ?>" class="rounded-circle w-100 h-100 object-fit-cover" alt="Ảnh đại diện">
                </div>
                <?php endif; ?>

                <!-- Thông tin -->
                <h5 class="card-title text-danger"><?php the_field('name'); ?></h5>
                <p class="card-text mb-1"><i class="bi bi-dot"></i><strong>Ngày sinh:</strong> <?php the_field('birthday'); ?></p>
                <p class="card-text mb-1"><i class="bi bi-dot"></i><strong>Số điện thoại:</strong> <?php the_field('phone2'); ?></p>
                <p class="card-text mb-0"><i class="bi bi-dot"></i><strong>Đang học tại:</strong> <?php the_field('school'); ?></p>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>
