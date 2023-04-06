<?php
/**
 * Template Name: archive_categories
 * Description: Page pour afficher toutes les catégories
 */

get_header();
?>
<div class="nav-container">
    <?php 
    wp_nav_menu([
        'theme_location' => "menu_light",
        'container' => 'nav',
        'container_class' => 'menu navbar-expand-sm navbar-dark fixed-top',
        'menu_class' => 'menu__list'
    ]);
    ?>
  </div>
<div class="main-container">
  <h1>Toutes les catégories</h1>
  <div class="display-demandes-container">
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
        <div class="demande-item">
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

<script src="<?php echo get_template_directory_uri() . '/assets/js/search.js' ?>"></script>

<?php
get_footer();
?>
