<?php
/* Template Name: single_demande*/

get_header();
?>

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

  <button class="button1"><a href="{% url 'soumission-signe' %}">Répondre à la demande</a></button>

</div>

<?php get_footer(); ?>
