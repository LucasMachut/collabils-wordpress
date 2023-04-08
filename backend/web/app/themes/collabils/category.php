<?php
get_header();
?>

<div class="nav-container">
  <div class="nav-toggle">
    <span>&#9776;</span>
  </div>
  <?php
    wp_nav_menu([
        'theme_location' => "menu_light",
        'container' => 'nav',
        'menu_class' => 'menu__list',
        'menu_id' => 'menuList',
    ]);
  ?>
</div>

<div class="main-container">
  <h1><?php single_cat_title(); ?></h1>
  <div class="display-signs-container">
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();
    ?>
        <div class="sign-item">
          <a href="<?php the_permalink(); ?>">
            <h3><?php the_title(); ?></h3>
          </a>
        </div>
    <?php
      endwhile;
    else :
      echo '<p>Aucun article trouvé dans cette catégorie.</p>';
    endif;
    ?>
  </div>
</div>

<?php
get_footer();
?>
