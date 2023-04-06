<?php
/* Template Name: single_demande*/

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
<div class="single-demande-container">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <h2><?php the_title(); ?></h2>

    <div class="categorie-container">
      <?php 
          $categories = get_the_category();
          if ( ! empty( $categories ) ) {
              echo esc_html( $categories[0]->name );
          }
      ?>
    </div>

    <div class="date-container">
      <?php echo get_post_meta( get_the_ID(), '_demande_date', true ); ?>
    </div>

    <div class="contexte-container">
      <h3>Contexte d'utilisation :</h3>
      <?php echo get_post_meta( get_the_ID(), '_demande_context', true ); ?>
    </div>

    <div class="definition-container">
      <h3>Définition :</h3>
      <?php echo get_post_meta( get_the_ID(), '_demande_definition', true ); ?>
    </div>

  <?php endwhile; else: ?>
    <p>Aucune demande trouvée.</p>
  <?php endif; ?>

  <button class="button1"><a href="/soumettre-un-signe">Soumettre un signe</a></button>

</div>

<?php get_footer(); ?>
