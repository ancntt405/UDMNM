<?php get_header(); ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>
                    <!-- Post Title -->
                    <header class="text-center mb-4">
                        <h1 class="display-4 fw-bold text-dark"><?php the_title(); ?></h1>
                    </header>

                    <!-- Post Meta: Author and Date -->
                    <div class="d-flex justify-content-between align-items-center mb-4 text-muted">
                        <span class="small">
                            <i class="bi bi-person-circle me-1"></i>
                            Đăng bởi <?php the_author_posts_link(); ?>
                        </span>
                        <span class="small">
                            <i class="bi bi-calendar me-1"></i>
                            <?php echo get_the_date('d/m/Y'); ?>
                        </span>
                    </div>

                    <!-- Post Content -->
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; endif; ?>
        </div>
    </div>
</div>

<!-- Related Posts Section -->
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <h2 class="text-center mb-4 fw-bold text-dark">Bài viết liên quan</h2>
            <div class="row">
                <?php
                // Get related posts based on tags (limit to 3)
                $tags = wp_get_post_tags($post->ID);
                if ($tags) {
                    $tag_ids = array();
                    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                    $args = array(
                        'tag__in' => $tag_ids,
                        'post__not_in' => array($post->ID),
                        'showposts' => 3,
                        'caller_get_posts' => 1
                    );
                    $my_query = new wp_query($args);
                    if ($my_query->have_posts()) :
                        while ($my_query->have_posts()) : $my_query->the_post(); ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm border-0">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="card-img-top" style="height: 200px; background-image: url('<?php the_post_thumbnail_url('medium'); ?>'); background-size: cover; background-position: center;"></div>
                                    <?php endif; ?>
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title fw-bold"><?php the_title(); ?></h5>
                                        <p class="card-text flex-grow-1 text-muted small"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary mt-auto">Đọc thêm</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                    endif;
                    wp_reset_query();
                } else {
                    // Fallback: get posts from same category
                    $categories = get_the_category($post->ID);
                    if ($categories) {
                        $cat_ids = array();
                        foreach($categories as $individual_category) $cat_ids[] = $individual_category->term_id;
                        $args = array(
                            'category__in' => $cat_ids,
                            'post__not_in' => array($post->ID),
                            'showposts' => 3,
                            'caller_get_posts' => 1
                        );
                        $my_query = new wp_query($args);
                        if ($my_query->have_posts()) :
                            while ($my_query->have_posts()) : $my_query->the_post(); ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 shadow-sm border-0">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="card-img-top" style="height: 200px; background-image: url('<?php the_post_thumbnail_url('medium'); ?>'); background-size: cover; background-position: center;"></div>
                                        <?php endif; ?>
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title fw-bold"><?php the_title(); ?></h5>
                                            <p class="card-text flex-grow-1 text-muted small"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary mt-auto">Đọc thêm</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                        endif;
                        wp_reset_query();
                    }
                }
                ?>
            </div>
            <?php if (!isset($my_query) || !$my_query->have_posts()) : ?>
                <div class="text-center text-muted">Không có bài viết liên quan.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>