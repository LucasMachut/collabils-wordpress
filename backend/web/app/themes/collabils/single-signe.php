<?php
/* Template Name: single_signe*/

get_header();
?>
<?php get_template_part('template_parts/header_menu.php') ?>


<div class="single-signe-container">
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

    <div class="tag-container">
      <?php 
          $tags = get_the_tags();
          if ( ! empty( $tags ) ) {
              echo esc_html( $tags[0]->name );
          }
      ?>
    </div>

    <div class="video-container">
        <?php
            // Récupérer l'URL de la vidéo YouTube stockée dans la meta box
            $video_url = get_post_meta( get_the_ID(), '_signe_video', true );
            
            // Extraire l'ID de la vidéo à partir de l'URL
            parse_str( parse_url( $video_url, PHP_URL_QUERY ), $video_params );
            $video_id = $video_params['v'];
            
            // Générer le code d'intégration de la vidéo
            $video_embed = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            
            // Afficher le code d'intégration
            echo $video_embed;
        ?>
    </div>

    <div class="definition-container">
        <h3>Définition</h3>
      <?php the_content(); ?>
    </div>

    <div class="contexte-container">
      <h3>Contexte d'utilisation:</h3>
     <?php echo get_post_meta( get_the_ID(), '_signe_context', true ); ?>
    </div>

  <?php endwhile; else: ?>
    <p>Aucun signe trouvé.</p>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
