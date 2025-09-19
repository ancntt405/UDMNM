<?php
/*
Template Name: Liên Hệ
*/
get_header(); ?>

<section class="contact py-5 bg-light">
    <div class="container">
        <!-- Page Title -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-dark d-inline-block border-bottom border-3 border-primary pb-2">
                <?php the_title(); ?>
            </h1>
        </div>

        <!-- Contact Information -->
        <div class="row justify-content-center text-center mb-5">
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm border-0 p-3">
                    <i class="bi bi-house-door-fill text-primary fs-2 mb-2"></i>
                    <h5 class="fw-bold">Địa chỉ</h5>
                    <p class="text-muted"><?php the_field('address'); ?></p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm border-0 p-3">
                    <i class="bi bi-envelope-at-fill text-primary fs-2 mb-2"></i>
                    <h5 class="fw-bold">Email</h5>
                    <p class="text-muted"><?php the_field('email2'); ?></p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm border-0 p-3">
                    <i class="bi bi-telephone-fill text-primary fs-2 mb-2"></i>
                    <h5 class="fw-bold">Số điện thoại</h5>
                    <p class="text-muted"><?php the_field('phone'); ?></p>
                </div>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="row justify-content-center text-center mb-5">
            <div class="col-auto">
                <?php if (get_field('facebook')) : ?>
                    <a href="<?php the_field('facebook'); ?>" target="_blank" class="me-4 text-primary fs-3"><i class="bi bi-facebook"></i></a>
                <?php endif; ?>
                <?php if (get_field('twitter')) : ?>
                    <a href="<?php the_field('twitter'); ?>" target="_blank" class="me-4 text-dark fs-3"><i class="bi bi-twitter-x"></i></a>
                <?php endif; ?>
                <?php if (get_field('tiktok')) : ?>
                    <a href="<?php the_field('tiktok'); ?>" target="_blank" class="me-4 text-dark fs-3"><i class="bi bi-tiktok"></i></a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Page Content -->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="content text-center">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>