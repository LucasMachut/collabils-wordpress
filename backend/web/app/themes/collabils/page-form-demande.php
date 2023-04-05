<?php
/**
 * Template Name: Formulaire de demande
 *
 * Template pour créer une demande à partir du CPT "demande" et des meta boxes définies
 */

// Vérifier si l'utilisateur est connecté
if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

// Récupérer les informations du formulaire de demande
$demande_title = '';
$demande_date = '';
$demande_context = '';
$demande_definition = '';
$demande_category = '';
if (isset($_POST['demande_title']) && isset($_POST['demande_date']) && isset($_POST['demande_context']) && isset($_POST['demande_definition']) && isset($_POST['demande_categorie'])) {
    $demande_title = sanitize_text_field($_POST['demande_title']);
    $demande_date = sanitize_text_field($_POST['demande_date']);
    $demande_context = sanitize_text_field($_POST['demande_context']);
    $demande_definition = sanitize_text_field($_POST['demande_definition']);
    $demande_category = sanitize_text_field($_POST['demande_categorie']);
 
    // Créer un nouvel objet demande
    $demande = array(
        'post_title'    => $demande_title,
        'post_type'     => 'demande',
        'post_status'   => 'publish'
    );
 
    // Insérer la demande dans la base de données
    $demande_id = wp_insert_post($demande);
 
    // Enregistrer les métadonnées de la demande
    update_post_meta($demande_id, '_demande_date', $demande_date);
    update_post_meta($demande_id, '_demande_context', $demande_context);
    update_post_meta($demande_id, '_demande_definition', $demande_definition);
    wp_set_post_terms($demande_id, $demande_category, 'category');
 
    // Rediriger l'utilisateur vers la page de la demande créée
    wp_redirect(get_permalink($demande_id));
    exit;
}

// Afficher le formulaire de demande
get_header(); ?>
<?php get_template_part('template_parts/header_menu.php') ?>


<h1>Demander un signe</h1>

<div class="content-area">
  <form id="demande-form" method="post">
    <div class="form-item">
      <label for="demande-title">Titre de la demande :</label>
      <input type="text" id="demande-title" name="demande_title" value="<?php echo esc_attr($demande_title); ?>" />
    </div>

    <div class="form-item">
      <label for="demande-date">Date de la demande :</label>
      <input type="date" id="demande-date" name="demande_date" value="<?php echo esc_attr($demande_date); ?>" />
    </div>

    <div class="form-item">
      <label for="demande-context">Contexte d'utilisation de la demande :</label>
      <textarea id="demande-context" name="demande_context"><?php echo esc_attr($demande_context); ?></textarea>
    </div>

    <div class="form-item">
      <label for="demande-definition">Définition de la demande :</label>
      <textarea id="demande-definition" name="demande_definition"><?php echo esc_attr($demande_definition); ?></textarea>
    </div>

    <div class="form-item">
      <label for="demande-categorie">Catégorie de la demande :</label>
      <select id="demande-categorie" name="demande_categorie">
<?php
// Récupérer toutes les catégories du CPT "demande"
$categories = get_terms(array(
'taxonomy' => 'category',
'hide_empty' => false,
));

    // Afficher chaque catégorie dans une option de select
    foreach ($categories as $category) {
      // Vérifier si la catégorie sélectionnée correspond à la catégorie en cours de traitement
      $selected = '';
      if ($category->term_id == $demande_category) {
        $selected = 'selected="selected"';
      }

      // Afficher l'option de la catégorie
      echo '<option value="' . $category->term_id . '" ' . $selected . '>' . $category->name . '</option>';
    }
    ?>
  </select>
</div>


  <input class="bouton1" type="submit" value="Créer la demande" />

  </form>
</div>
<?php get_footer(); ?>





