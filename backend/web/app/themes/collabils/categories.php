<?php
/**
 * Template Name: archive_categories
 * Description: Page pour afficher toutes les catégories
 */

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
  <h1>Catégories</h1>
  <div class="display-signs-container">
    <?php
    // récupérer toutes les catégories
    $args = array(
      'taxonomy' => 'category',
      'orderby' => 'name',
      'order' => 'ASC',
      'hide_empty' => 1,
    );
    $categories = get_categories($args);

    if (!empty($categories)) :
      foreach ($categories as $category) :
    ?>
        <div class="sign-item">
          <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
            <h3><?php echo esc_html($category->name); ?></h3>
          </a>
        </div>
    <?php
      endforeach;
    else :
      echo '<p>Aucune catégorie trouvée.</p>';
    endif;
    ?>
  </div>
</div>


<?php
get_footer();
?>
