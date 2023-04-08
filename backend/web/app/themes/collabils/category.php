<?php
/**
 * Template Name: single-categorie
 * Description: Page pour afficher les signes d'une catégorie
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
  <h1><?php single_cat_title(); ?></h1>
    
  <div class="display-signs-container">
    <?php
      $category_id = get_queried_object_id(); // Récupérer l'ID de la catégorie sélectionnée

      // Récupérer tous les CPT 'signe' appartenant à la catégorie sélectionnée
      $args = array(
        'post_type' => 'signe',
        'posts_per_page' => -1,
        'tax_query' => array(
          array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $category_id,
          ),
        ),
      );
      $query = new WP_Query($args);

      if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
    ?>
          <div class="sign-item">
            <a href="<?php the_permalink(); ?>">
              <h3><?php the_title(); ?></h3>
            </a>
          </div>
    <?php
        endwhile;
        wp_reset_postdata();
      else :
        echo '<p>Aucun signe trouvé pour cette catégorie.</p>';
      endif;
    ?>
  </div>
</div>

<?php
get_footer();
?>
