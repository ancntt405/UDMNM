<?php get_header(); ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Archive Title -->
            <header class="text-center mb-4">
                <?php
                if (is_category()) {
                    printf('<h1 class="display-5 fw-bold text-dark">%s %s</h1>', single_cat_title('', false), get_the_archive_description() ? '<small class="d-block text-muted mt-2">' . get_the_archive_description() . '</small>' : '');
                } elseif (is_tag()) {
                    printf('<h1 class="display-5 fw-bold text-dark">%s %s</h1>', single_tag_title('', false), get_the_archive_description() ? '<small class="d-block text-muted mt-2">' . get_the_archive_description() . '</small>' : '');
                } elseif (is_author()) {
                    printf('<h1 class="display-5 fw-bold text-dark">%s %s</h1>', __('Bài viết của tác giả: ', 'textdomain'), get_the_author_meta('display_name', $post->post_author));
                } elseif (is_date()) {
                    if (is_day()) {
                        printf('<h1 class="display-5 fw-bold text-dark">%s %s</h1>', __('Lưu trữ hàng ngày: ', 'textdomain'), get_the_date());
                    } elseif (is_month()) {
                        printf('<h1 class="display-5 fw-bold text-dark">%s %s</h1>', __('Lưu trữ hàng tháng: ', 'textdomain'), get_the_date('F Y'));
                    } elseif (is_year()) {
                        printf('<h1 class="display-5 fw-bold text-dark">%s %s</h1>', __('Lưu trữ hàng năm: ', 'textdomain'), get_the_date('Y'));
                    }
                } else {
                    echo '<h1 class="display-5 fw-bold text-dark">Lưu trữ</h1>';
                }
                ?>
            </header>

            <!-- Posts Loop -->
            <div class="row">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="col-md-6 col-lg-4 mb-4">
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
                <?php endwhile; else : ?>
                    <div class="col-12 text-center">
                        <p class="text-muted">Không có bài viết nào.</p>
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

<?php get_footer(); ?>