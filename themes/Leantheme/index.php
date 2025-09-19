<?php get_header(); ?>

<div class="container">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article class="mb-4">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div><?php the_content(); ?></div>
        </article>
    <?php endwhile; else: ?>
        <p>Chưa có bài viết nào.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
