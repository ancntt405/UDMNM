<?php
get_header(); ?>

<section class="search-results py-5 bg-light">
    <div class="container">
        <!-- Search Title -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-dark d-inline-block border-bottom border-3 border-primary pb-2">
                <?php printf(__('Kết quả tìm kiếm cho: %s', 'textdomain'), '<span class="text-primary">' . get_search_query() . '</span>'); ?>
            </h1>
        </div>

        <!-- Search Results -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
                    <?php endwhile; else : ?>
                        <div class="col-12 text-center">
                            <p class="text-muted">Không tìm thấy bài viết nào phù hợp với từ khóa "<strong><?php echo get_search_query(); ?></strong>".</p>
                            <p class="text-muted">Hãy thử tìm kiếm với từ khóa khác.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <?php if (have_posts()) : ?>
                    <div class="d-flex justify-content-center mt-4">
                        <?php
                        the_posts_pagination(array(
                            'prev_text' => __('« Trước', 'textdomain'),
                            'next_text' => __('Tiếp »', 'textdomain'),
                            'mid_size'  => 2,
                        ));
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>