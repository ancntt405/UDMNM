<?php
/*
Template Name: Blog Cá Nhân
*/
get_header(); ?>

<section class="blog py-5 bg-light">
    <div class="container">
        <!-- Page Title -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-dark d-inline-block border-bottom border-3 border-primary pb-2">
                <?php the_title(); ?>
            </h1>
        </div>

        <!-- Personal Information -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10 mb-5 mx-auto">
                <div class="card h-100 shadow-sm p-4 text-center">
                    <!-- Avatar -->
                    <?php 
                    $avatar_img = get_field('avatar2');
                    ?>
                    <?php if ($avatar_img) : ?>
                        <div class="mx-auto mb-3" style="width: 140px; height: 140px;">
                            <img src="<?php echo esc_url($avatar_img['url']); ?>" class="rounded-circle w-100 h-100 object-fit-cover" alt="Ảnh đại diện">
                        </div>
                    <?php endif; ?>

                    <!-- Information -->
                    <h5 class="card-title text-primary fw-bold"><?php the_field('name'); ?></h5>
                    <p class="card-text mb-1"><i class="bi bi-dot"></i><strong>Ngày sinh:</strong> <?php the_field('birthday'); ?></p>
                    <p class="card-text mb-1"><i class="bi bi-dot"></i><strong>Số điện thoại:</strong> <?php the_field('phone2'); ?></p>
                    <p class="card-text mb-0"><i class="bi bi-dot"></i><strong>Đang học tại:</strong> <?php the_field('school'); ?></p>
                </div>
            </div>
        </div>

        <!-- Blog Posts -->
        <div class="row justify-content-center mt-4">
            <div class="col-lg-10">
                <h2 class="text-center mb-4 fw-bold text-dark">Bài viết gần đây</h2>
                <div class="row">
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'post_status' => 'publish',
                    );
                    $blog_query = new WP_Query($args);
                    if ($blog_query->have_posts()) :
                        while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm border-0">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="card-img-top" style="height: 200px; background-image: url('<?php the_post_thumbnail_url('medium'); ?>'); background-size: cover; background-position: center;"></div>
                                    <?php endif; ?>
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title fw-bold"><?php the_title(); ?></h5>
                                        <p class="card-text flex-grow-1 text-muted small"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                        <div class="d-flex justify-content-between align-items-center text-muted small mb-2">
                                            <span><i class="bi bi-person-circle me-1"></i><?php the_author(); ?></span>
                                            <span><i class="bi bi-calendar me-1"></i><?php echo get_the_date('d/m/Y'); ?></span>
                                        </div>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary mt-auto">Đọc thêm</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata();
                    else : ?>
                        <div class="col-12 text-center">
                            <p class="text-muted">Chưa có bài viết nào.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <?php
                    the_posts_pagination(array(
                        'prev_text' => __('« Trước', 'textdomain'),
                        'next_text' => __('Tiếp »', 'textdomain'),
                        'mid_size'  => 2,
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>