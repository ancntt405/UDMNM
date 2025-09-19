<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<nav class="navbar navbar-expand-lg bg-body-tertiary mb-4 shadow-sm">
  <div class="container-fluid">

    <!-- Bên trái: Logo hoặc Tiêu đề + Mô tả -->
    <a class="navbar-brand d-flex align-items-center" href="<?php echo home_url(); ?>">
      <?php 
      if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
          the_custom_logo();
      } else { ?>
          <div>
              <h1 class="h5 mb-0"><?php bloginfo('name'); ?></h1>
              <small class="text-muted"><?php bloginfo('description'); ?></small>
          </div>
      <?php } ?>
    </a>

    <!-- Nút toggle menu khi màn hình nhỏ -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu và tìm kiếm trong navbar-collapse -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- Giữa: Menu WordPress -->
      <?php
        wp_nav_menu(array(
          'theme_location' => 'primary', // khai báo trong functions.php
          'container'      => false,
          'menu_class'     => 'navbar-nav mx-auto mb-2 mb-lg-0', // mx-auto để căn giữa
          'fallback_cb'    => false,
          'depth'          => 2,
          'walker'         => new Bootstrap_Navwalker() // có thể custom walker
        ));
      ?>
      <!-- Thanh tìm kiếm cho mobile -->
      <form class="d-flex ms-auto d-lg-none" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <input class="form-control form-control-sm me-2" type="search" placeholder="Tìm kiếm..." aria-label="Search" name="s">
        <button class="btn btn-outline-primary btn-sm" type="submit"><i class="bi bi-search"></i></button>
      </form>
      
    </div>

    <!-- Thanh tìm kiếm cho desktop -->
    <form class="d-flex ms-auto d-none d-lg-flex align-items-center flex-shrink-0" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
      <input class="form-control form-control-sm w-100 me-2" type="search" placeholder="Tìm kiếm..." aria-label="Search" name="s">
      <button class="btn btn-outline-primary btn-sm" type="submit"><i class="bi bi-search"></i></button>
    </form>

  </div>
</nav>